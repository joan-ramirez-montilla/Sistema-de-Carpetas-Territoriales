<?php

namespace App\Livewire\TerritorialFolders;

use App\Models\Person;
use App\Models\Region;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use Barryvdh\DomPDF\PDF;
use App\Models\Municipality;
use App\Models\Organization;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selectedProvince = null;
    public $selectedMunicipality = null;
    public $selectedDistrict = null;
    public $selectedRegion = null;
    public $selectedFolder = null;

    public function updatedSelectedRegion()
    {
        $this->selectedProvince = null;
        $this->selectedMunicipality = null;
        $this->selectedDistrict = null;
        $this->selectedFolder = null;
        $this->resetPage();
    }

    public function updatedSelectedMunicipality()
    {
        $this->selectedDistrict = null;
        $this->selectedFolder = null;
        $this->resetPage();
    }

    public function updatedSelectedProvince()
    {
        $this->selectedMunicipality = null;
        $this->selectedDistrict = null;
        $this->selectedFolder = null;
        $this->resetPage();
    }

    public function updatedSelectedDistrict()
    {
        $this->selectedFolder = null;
        $this->resetPage();
    }

    public function selectFolder($folderId)
    {
        $this->selectedFolder = $folderId;
    }

    public function exportPdf($folder)
    {
        $membersQuery = Person::where('organization_id', $folder);

        if ($this->selectedProvince) {
            $membersQuery->where('province_id', $this->selectedProvince);
        }

        if ($this->selectedMunicipality) {
            $membersQuery->where('municipality_id', $this->selectedMunicipality);
        }

        if ($this->selectedDistrict) {
            $membersQuery->where('district_id', $this->selectedDistrict);
        }

        $members = $membersQuery
            ->orderBy('full_name')
            ->get(['full_name', 'national_id', 'position_id'])
            ->map(function ($person) {
                return [
                    'position' => $person->position->name ?? 'Sin cargo',
                    'full_name' => $person->full_name,
                    'national_id' => $person->national_id,
                ];
            });

        $data = [
            'folder' => Organization::find($folder)->name ?? 'Sin organización',
            'filters' => [
                'region' => $this->selectedRegion ? Region::find($this->selectedRegion)->name : 'Todas',
                'province' => $this->selectedProvince ? Province::find($this->selectedProvince)->name : 'Todas',
                'municipality' => $this->selectedMunicipality ? Municipality::find($this->selectedMunicipality)->name : 'Todos',
                'district' => $this->selectedDistrict ? District::find($this->selectedDistrict)->name : 'Todos',
            ],
            'members' => $members,
            'date' => now()->format('Y-m-d'),
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('report', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'carpeta_' . $folder . '.pdf');
    }

    public function render()
    {
        // Obtener regiones
        $regions = Region::where('is_active', true)
            ->orderBy('name')
            ->get();

        // Obtener provincias según región seleccionada
        $provinces = collect();
        if ($this->selectedRegion) {
            $provinces = Province::where('region_id', $this->selectedRegion)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();
        }

        // Obtener municipios según provincia seleccionada
        $municipalities = collect();
        if ($this->selectedProvince) {
            $municipalities = Municipality::where('province_id', $this->selectedProvince)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();
        }

        // Obtener distritos según municipio seleccionado
        $districts = collect();
        if ($this->selectedMunicipality) {
            $districts = District::where('municipality_id', $this->selectedMunicipality)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();
        }

        // Calcular estadísticas
        $totalMembers = Person::count();
        $activeProvinces = Province::where('is_active', true)->count();
        $activeMunicipalities = Municipality::where('is_active', true)->count();

        // Obtener carpetas con filtros
        $foldersQuery = Person::query()
            ->selectRaw('organization_id, COUNT(*) as members_count');

        // Aplicar filtros a las carpetas SIN usar whereHas (que da error)
        if ($this->selectedRegion) {
            $foldersQuery->whereIn('province_id',
                Province::where('region_id', $this->selectedRegion)->pluck('id')
            );
        }

        if ($this->selectedProvince) {
            $foldersQuery->where('province_id', $this->selectedProvince);
        }

        if ($this->selectedMunicipality) {
            $foldersQuery->where('municipality_id', $this->selectedMunicipality);
        }

        if ($this->selectedDistrict) {
            $foldersQuery->where('district_id', $this->selectedDistrict);
        }

        $folders = $foldersQuery
            ->groupBy('organization_id')
            ->orderBy('members_count', 'desc')
            ->get()
            ->map(function ($item) {
                // Para obtener los datos de ubicación, necesitas consultar una persona del grupo
                $samplePerson = Person::where('organization_id', $item->organization_id)
                    ->when($this->selectedRegion, function ($q) {
                        $q->whereIn('province_id',
                            Province::where('region_id', $this->selectedRegion)->pluck('id')
                        );
                    })
                    ->when($this->selectedProvince, fn($q) => $q->where('province_id', $this->selectedProvince))
                    ->when($this->selectedMunicipality, fn($q) => $q->where('municipality_id', $this->selectedMunicipality))
                    ->when($this->selectedDistrict, fn($q) => $q->where('district_id', $this->selectedDistrict))
                    ->first();

                return [
                    'id' => $item->organization_id,
                    'name' => Organization::find($item->organization_id)->name ?? 'Sin organización',
                    'province' => $samplePerson ? (Province::find($samplePerson->province_id)?->name ?? null) : null,
                    'municipality' => $samplePerson ? (Municipality::find($samplePerson->municipality_id)?->name ?? null) : null,
                    'district' => $samplePerson ? (District::find($samplePerson->district_id)?->name ?? null) : null,
                    'region' => $samplePerson && $samplePerson->province_id ?
                        (Region::find(Province::find($samplePerson->province_id)?->region_id)?->name ?? null) : null,
                    'members_count' => $item->members_count,
                ];
            });

        $totalFolders = $folders->count();

        // Obtener miembros de la carpeta seleccionada CON LOS MISMOS FILTROS
        $members = collect();
        if ($this->selectedFolder) {
            $membersQuery = Person::where('organization_id', $this->selectedFolder);

            // Aplicar los mismos filtros que en el reporte PDF SIN usar whereHas
            if ($this->selectedRegion) {
                $membersQuery->whereIn('province_id',
                    Province::where('region_id', $this->selectedRegion)->pluck('id')
                );
            }

            if ($this->selectedProvince) {
                $membersQuery->where('province_id', $this->selectedProvince);
            }

            if ($this->selectedMunicipality) {
                $membersQuery->where('municipality_id', $this->selectedMunicipality);
            }

            if ($this->selectedDistrict) {
                $membersQuery->where('district_id', $this->selectedDistrict);
            }

            $members = $membersQuery
                ->orderBy('full_name')
                ->get(['full_name', 'national_id', 'position_id'])
                ->map(function ($person) {
                    return [
                        'position' => $person->position->name ?? 'Sin cargo',
                        'full_name' => $person->full_name,
                        'national_id' => $person->national_id,
                    ];
                });
        }

        return view('livewire.territorial-folders.index', [
            'regions' => $regions,
            'provinces' => $provinces,
            'municipalities' => $municipalities,
            'districts' => $districts,
            'totalFolders' => $totalFolders,
            'totalMembers' => $totalMembers,
            'activeProvinces' => $activeProvinces,
            'activeMunicipalities' => $activeMunicipalities,
            'folders' => $folders,
            'members' => $members,
        ]);
    }
}

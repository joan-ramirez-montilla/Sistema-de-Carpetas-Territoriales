<?php

namespace App\Livewire\TerritorialFolders;

use App\Models\Person;
use App\Models\Region;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
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

    public function updatedSelectedProvince()
    {
        $this->selectedMunicipality = null;
        $this->selectedDistrict = null;
        $this->selectedRegion = null;
        $this->selectedFolder = null;
        $this->resetPage();
    }

    public function updatedSelectedMunicipality()
    {
        $this->selectedDistrict = null;
        $this->selectedRegion = null;
        $this->selectedFolder = null;
        $this->resetPage();
    }

    public function updatedSelectedDistrict()
    {
        $this->selectedRegion = null;
        $this->selectedFolder = null;
        $this->resetPage();
    }

    public function updatedselectedRegion()
    {
        $this->selectedFolder = null;
        $this->resetPage();
    }

    public function selectFolder($folderId)
    {
        $this->selectedFolder = $folderId;
    }

    public function exportExcel()
    {
        // TODO: Implementar exportación a Excel
        $this->dispatch('notify', message: 'Exportación a Excel en desarrollo');
    }

    public function exportPdf()
    {
        // TODO: Implementar exportación a PDF
        $this->dispatch('notify', message: 'Exportación a PDF en desarrollo');
    }

    public function render()
    {

     // Obtener regiones
        $regions = Region::where('is_active', true)
            ->orderBy('name')
            ->get();

        // Obtener provincias segun region seleccionada
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
        $totalFolders = 8; // TODO: Calcular desde modelo de carpetas
        $totalMembers = Person::count();
        $activeProvinces = Province::where('is_active', true)->count();
        $activeMunicipalities = Municipality::where('is_active', true)->count();

        $folders = Person::query()
            ->selectRaw('organization_id, COUNT(*) as members_count')
            ->when($this->selectedProvince, fn($q) => $q->where('province_id', $this->selectedProvince))
            ->when($this->selectedMunicipality, fn($q) => $q->where('municipality_id', $this->selectedMunicipality))
            ->when($this->selectedDistrict, fn($q) => $q->where('district_id', $this->selectedDistrict))
            ->groupBy('organization_id')
            ->orderBy('members_count', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->organization_id,
                    'name' => Organization::find($item->organization_id)->name ?? 'Sin organización',
                    'province' => Province::find($item->province_id)?->name ?? null,
                    'municipality' => Municipality::find($item->municipality_id)?->name ?? null,
                    'district' => District::find($item->district_id)?->name ?? null,
                    'region' => Region::find($item->region_id)?->name ?? null,
                    'members_count' => $item->members_count,
                ];
            });

        // Filtrar carpetas según filtros seleccionados

        if ($this->selectedProvince) {
            $folders = $folders->filter(function ($folder) {
                return $folder['province'] === Province::find($this->selectedProvince)?->name;
            });
        }

        if ($this->selectedMunicipality) {
            $folders = $folders->filter(function ($folder) {
                return $folder['municipality'] === Municipality::find($this->selectedMunicipality)?->name;
            });
        }

        if ($this->selectedDistrict) {
            $folders = $folders->filter(function ($folder) {
                return $folder['district'] === District::find($this->selectedDistrict)?->name;
            });
        }

        // Obtener miembros de la carpeta seleccionada
        $members = collect();
        if ($this->selectedFolder) {
            $members = Person::where('organization_id', $this->selectedFolder)
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

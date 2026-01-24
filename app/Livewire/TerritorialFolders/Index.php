<?php

namespace App\Livewire\TerritorialFolders;

use App\Models\Province;
use App\Models\Municipality;
use App\Models\District;
use App\Models\Region;
use App\Models\Person;
use Livewire\Component;
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

        // Simular carpetas (esto debería venir de un modelo TerritorialFolder)
        $folders = collect([
            [
                'id' => 1,
                'name' => 'Carpeta Provincial Zonificada',
                'province' => 'Azua',
                'municipality' => 'Azua',
                'district' => '54956',
                'region' => 'Cibao noroeste',
                'members_count' => 8,
            ],
            [
                'id' => 2,
                'name' => 'Carpeta Provincial Zonificada',
                'province' => 'Azua',
                'municipality' => 'Azua',
                'district' => '54956',
                'region' => 'Cibao noroeste',
                'members_count' => 1,
            ],
        ]);

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
            // TODO: Obtener miembros reales de la carpeta seleccionada
            $members = collect([
                [
                    'position' => 'Presidente(a)',
                    'full_name' => 'CARLOS A RAMIREZ',
                    'national_id' => '010-0006672-8',
                ],
                [
                    'position' => '1er. Vice-presidente(a)',
                    'full_name' => 'ROSA NUÑEZ',
                    'national_id' => '010-0008641-1',
                ],
                [
                    'position' => '2do. Vice-presidente(a)',
                    'full_name' => 'ELVIN ANT PERALTA',
                    'national_id' => '010-0065567-8',
                ],
                [
                    'position' => '3er. Vice-presidente(a)',
                    'full_name' => 'ANGEL BLADIMIR MP.',
                    'national_id' => '010-0084299-5',
                ],
                [
                    'position' => 'Secretario(a) General',
                    'full_name' => 'BRENDA OGANDO',
                    'national_id' => '010-0100405-8',
                ],
                [
                    'position' => '1er. Secretario(a) General',
                    'full_name' => 'RAFAEL PEREZ',
                    'national_id' => '019-0051095-6',
                ],
            ]);
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

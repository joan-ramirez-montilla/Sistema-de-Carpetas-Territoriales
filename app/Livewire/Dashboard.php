<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\{Province, Municipality, District, Person, Position, Organization, Region};

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'totalPeople'          => Person::count(),
            'activeProvinces'      => Province::where('is_active', true)->count(),
            'activeMunicipalities' => Municipality::where('is_active', true)->count(),
            'activeDistricts'      => District::where('is_active', true)->count(),
            'totalProvinces'       => Province::count(),
            'totalMunicipalities'  => Municipality::count(),
            'totalDistricts'       => District::count(),
            'totalPositions'       => Position::where('is_active', true)->count(),
            'totalOrganizations'   => Organization::where('is_active', true)->count(),
            'totalRegions'         => Region::where('is_active', true)->count(),
        ]);
    }
}

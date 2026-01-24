<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\{Province, Municipality, Employee, Appointment, Person};

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'totalPeople'          => Person::count(),
            'activeProvinces'      => Province::where('is_active', true)->count(),
            'activeMunicipalities' => Municipality::where('is_active', true)->count(),
        ]);
    }
}

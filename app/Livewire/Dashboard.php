<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{Employee, Appointment};
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }
}

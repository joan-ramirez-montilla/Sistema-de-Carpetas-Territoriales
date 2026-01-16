<?php

namespace App\Livewire\Appointments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Appointment;

class Index extends Component
{
    use WithPagination;

    public $filterEmployee = '';
    public $filterDate = '';
    public $filterStatus = '';

    public function render()
    {
        return view('livewire.appointments.index', [
            'appointments' => Appointment::latest()->paginate(1)
        ]);
    }
}

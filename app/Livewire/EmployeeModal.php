<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;

class EmployeeModal extends Component
{
    public $showModal = false;
    public $employee = null;
    public $primaryColor;

    protected $listeners = ['openEmployeeModal' => 'openModal'];

    public function mount($primaryColor)
    {
        $this->primaryColor = $primaryColor;
    }

    public function openModal($employeeId)
    {
        $this->employee = Employee::find($employeeId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->employee = null;
    }

    public function render()
    {
        return view('livewire.employee-modal');
    }
}

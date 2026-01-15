<?php

namespace App\Livewire\Employees;

use Livewire\Component;
use App\Models\Employee;

class Create extends Component
{
    public $name, $phone, $email, $position, $status = 'active';

    protected $rules = [
        'name' => 'required|min:3',
        'phone' => 'required',
        'email' => 'nullable|email',
        'position' => 'required',
        'status' => 'required',
    ];

    public function save()
    {
        $this->validate();

        Employee::create($this->all());

        return redirect()->route('employees.index')
        ->with('success', 'Empleado creado con exito.');
    }

    public function render()
    {
        return view('livewire.employees.create');
    }
}

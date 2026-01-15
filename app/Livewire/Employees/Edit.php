<?php

namespace App\Livewire\Employees;

use Livewire\Component;
use App\Models\Employee;

class Edit extends Component
{
    public Employee $employee;

    public $name;
    public $phone;
    public $email;
    public $position;
    public $status;

    protected function rules()
    {
        return [
            'name'     => 'required|string|min:3',
            'phone'    => 'required|string',
            'email'    => 'nullable|email',
            'position' => 'required|string',
            'status'   => 'required|in:active,inactive',
        ];
    }

    public function mount(Employee $employee)
    {
        $this->employee = $employee;

        $this->fill(
            $employee->only([
                'name',
                'phone',
                'email',
                'position',
                'status',
            ])
        );
    }

    public function save()
    {
        $validated = $this->validate();

        $this->employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Empleado actualizado con exito.');
    }

    public function render()
    {
        return view('livewire.employees.edit');
    }
}

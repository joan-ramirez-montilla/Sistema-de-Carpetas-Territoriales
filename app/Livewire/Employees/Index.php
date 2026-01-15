<?php

namespace App\Livewire\Employees;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class Index extends Component
{
    use WithPagination;

    public function delete(Employee $employee)
    {
        $employee->delete();
         $this->resetPage();
    }

    public function render()
    {
        return view('livewire.employees.index', [
            'employees' => Employee::latest()->paginate(1)
        ]);
    }
}

<?php

namespace App\Livewire\Appointments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Appointment;
use App\Models\Employee;

class Index extends Component
{
    use WithPagination;

    public $filterEmployee = '';
    public $filterDate = '';
    public $filterStatus = '';

    protected $updatesQueryString = [
        'filterEmployee',
        'filterDate',
        'filterStatus',
    ];

    // 🔄 Reset pagination on filter change
    public function updatedFilterEmployee()
    {
        $this->resetPage();
    }

    public function updatedFilterDate()
    {
        $this->resetPage();
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Appointment::findOrFail($id)->delete();
    }
public function updated($property)
{
    if (in_array($property, [
        'filterEmployee',
        'filterDate',
        'filterStatus'
    ])) {
        $this->resetPage();
    }
}

public function render()
{
    $appointments = Appointment::where(function ($query) {

          if (auth()->user()->role === 'employee') {

            $employee = Employee::where('user_id', auth()->id())->first();

            if ($employee) {
                $query->where('employee_id', $employee->id);
            } else {
                // Si por alguna razón no existe empleado, no mostrar nada
                $query->whereRaw('1 = 0');
            }
        }

        // 🔹 FILTRO EMPLEADO (SOLO ADMIN)
        if (auth()->user()->role === 'admin' && $this->filterEmployee !== '') {
            $query->where('employee_id', $this->filterEmployee);
        }

        if ($this->filterDate !== '') {
            $query->whereDate('appointment_date', $this->filterDate);
        }

        if ($this->filterStatus !== '') {
            $query->where('status', $this->filterStatus);
        }

    })
    ->orderBy('appointment_date')
    ->orderBy('appointment_time')
    ->paginate(1);

    return view('livewire.appointments.index', [
        'appointments' => $appointments,
        'employees' => auth()->user()->role === 'admin'
            ? Employee::with('user')->get()
            : collect(),
    ]);
}

}

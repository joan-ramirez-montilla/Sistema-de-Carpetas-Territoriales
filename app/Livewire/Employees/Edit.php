<?php

namespace App\Livewire\Employees;

use App\Models\User;
use Livewire\Component;
use App\Traits\HasSchedule;
use App\Models\{CompanySetting, Employee};
use Illuminate\Support\Facades\Hash;

class Edit extends Component
{
    use HasSchedule;

    public Employee $employee;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $status;
    public $schedule;
    public $companySetting;

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->employee->user_id,
            'password' => 'nullable|string',
            'phone'    => 'required|string',
            'status'   => 'required|in:active,inactive',
            'schedule' => 'nullable|array'
        ];
    }

    public function mount(Employee $employee)
    {
        $this->companySetting = CompanySetting::first() ?? new CompanySetting();

        $this->employee = $employee;

        $this->schedule = $this->mergeSchedule($this->employee->schedule);

        $this->fill([
            'name' => $this->employee->user->name,
            'email' => $this->employee->user->email,
            'phone' => $this->employee->phone,
            'status' => $this->employee->status,
            'schedule' => $this->mergeSchedule($this->employee->schedule),
        ]);
    }

    public function save()
    {
        $validated = $this->validate();

        $this->schedule = $this->mergeSchedule($this->schedule);

        $this->validateSchedule($this->schedule);

        $this->validateScheduleWithinCompany($this->schedule, $this->companySetting->schedule);

        if ($this->getErrorBag()->any()) {
            return;
        }

        // Preparar datos para actualizar el usuario
        $userData = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        // Solo actualizar la contraseña si se ingresó
        if (!empty($this->password)) {
            $userData['password'] = Hash::make($this->password);
        }

        $this->employee->user->update($userData);

        // Actualizar datos del empleado
        $this->employee->update([
            'phone' => $this->phone,
            'status' => $this->status,
            'schedule' => $this->schedule,
        ]);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Empleado actualizado con éxito.');
    }

    public function render()
    {
        return view('livewire.employees.edit');
    }
}

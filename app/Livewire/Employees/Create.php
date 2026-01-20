<?php

namespace App\Livewire\Employees;

use App\Models\User;
use Livewire\Component;
use App\Traits\HasSchedule;
use App\Traits\HasAvailableHours;
use Illuminate\Support\Facades\Hash;
use App\Models\{CompanySetting, Employee};

class Create extends Component
{
    use HasSchedule, HasAvailableHours;

    public $companySetting, $name, $phone, $email, $schedule = [], $password, $status = 'active';

    public function mount()
    {
        $this->companySetting = CompanySetting::first() ?? new CompanySetting();
        $this->schedule = $this->mergeSchedule($this->companySetting->schedule);
    }

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',

        'phone' => 'required',
        'status' => 'required',
        'schedule' => 'nullable|array',
    ];

    public function save()
    {
        $this->validate();

        $this->schedule = $this->mergeSchedule($this->schedule);

        $this->validateSchedule();

        $this->validateScheduleWithinCompany($this->companySetting->schedule);

        if ($this->getErrorBag()->any()) {
            return;
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        Employee::create([
            'phone' => $this->phone,
            'status' => $this->status,
            'schedule' => $this->schedule,
            'user_id' => $user->id
        ]);

        return redirect()->route('employees.index')
        ->with('success', 'Empleado creado con exito.');
    }

    public function render()
    {
        return view('livewire.employees.create',[
            'availableHours' => $this->availableHours
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{Employee, Appointment};
use Carbon\Carbon;

class Dashboard extends Component
{
    public $registeredEmployees;
    public $todayAppointments;
    public $monthlyAppointments;
    public $monthlyAppointmentsChart = [];
    public $pendingAppointments;

    public function mount()
    {
        $this->registeredEmployees = Employee::count();

        $this->todayAppointments = Appointment::whereDate('created_at', Carbon::today())->count();

        $this->monthlyAppointments = Appointment::whereMonth('created_at', Carbon::now()->month)->count();

        $this->pendingAppointments = Appointment::where('status', 'pending')->count();

        // Datos para el gráfico mensual
        $this->monthlyAppointmentsChart = [];
        for ($m = 1; $m <= 12; $m++) {
            $this->monthlyAppointmentsChart[] = Appointment::whereMonth('created_at', $m)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

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

        // Hoy (año actual)
        $this->todayAppointments = Appointment::whereDate('appointment_date', Carbon::today())
            ->whereYear('appointment_date', Carbon::now()->year)
            ->count();

        // Mes actual (año actual)
        $this->monthlyAppointments = Appointment::whereMonth('appointment_date', Carbon::now()->month)
            ->whereYear('appointment_date', Carbon::now()->year)
            ->count();

        // Pendientes (año actual)
        $this->pendingAppointments = Appointment::where('status', 'pending')
            ->whereYear('appointment_date', Carbon::now()->year)
            ->count();

        // Datos para el gráfico mensual (año actual)
        $this->monthlyAppointmentsChart = [];
        for ($m = 1; $m <= 12; $m++) {
            $this->monthlyAppointmentsChart[] = Appointment::whereMonth('appointment_date', $m)
                ->whereYear('appointment_date', Carbon::now()->year)
                ->count();
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

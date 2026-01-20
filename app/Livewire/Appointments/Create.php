<?php

namespace App\Livewire\Appointments;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Appointment;
use App\Models\CompanySetting;
use App\Models\Service;

class Create extends Component
{
    public CompanySetting $companySetting;
    public $employees;

    public $selectedEmployee = null;
    public $selectedDate = null;
    public $selectedTime = null;

    public $customer_name = '';
    public $customer_phone = '';

    public $availableMonths = [];
    public $currentMonthIndex = 0;

    public $services;
    public $selectedService = null;

    private const DAYS_RANGE = 15;
    private const TIME_SLOTS = [
        '10:00', '10:30', '11:00', '11:30', '12:00', '12:30',
        '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
        '16:00', '16:20', '16:40', '17:00'
    ];

    public function mount(): void
    {
        $this->initializeCompanySettings();
        $this->loadActiveEmployees();
        $this->loadActiveServices();
        $this->generateAvailableDates();
    }

    private function initializeCompanySettings(): void
    {
        $this->companySetting = CompanySetting::first() ?? new CompanySetting();
    }

    private function loadActiveEmployees(): void
    {
        $this->employees = Employee::where('status', 'active')->get();
    }

    private function loadActiveServices(): void
    {
        $this->services = Service::all();
    }

    public function selectBarber(int $id): void
    {
        $this->selectedEmployee = Employee::find($id);
    }

    public function selectService(int $id): void
    {
        $this->selectedService = Service::find($id);
    }

    public function previousMonth(): void
    {
        if ($this->currentMonthIndex > 0) {
            $this->currentMonthIndex--;
            $this->selectedDate = null;
        }
    }

    public function nextMonth(): void
    {
        if ($this->currentMonthIndex < count($this->availableMonths) - 1) {
            $this->currentMonthIndex++;
            $this->selectedDate = null;
        }
    }

    private function generateAvailableDates(): void
    {
        $startDate = Carbon::today();
        $months = [];

        for ($i = 0; $i < self::DAYS_RANGE; $i++) {
            $date = $startDate->copy()->addDays($i);
            $monthKey = $date->format('Y-m');

            if (!isset($months[$monthKey])) {
                $months[$monthKey] = $this->createMonthStructure($date);
            }

            $months[$monthKey]['dates'][] = $this->createDateStructure($date);
        }

        $this->availableMonths = array_values($months);
        $this->currentMonthIndex = 0;
    }

    private function createMonthStructure(Carbon $date): array
    {
        return [
            'monthName' => $this->getSpanishMonthName($date->format('m')),
            'year' => $date->format('Y'),
            'dates' => [],
        ];
    }

    private function createDateStructure(Carbon $date): array
    {
        return [
            'value' => $date->format('Y-m-d'),
            'day' => $this->getSpanishDayName($date->format('D')),
            'number' => $date->format('d'),
        ];
    }

    private function getSpanishMonthName(string $monthNumber): string
    {
        $months = [
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo',
            '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio',
            '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre',
            '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre',
        ];

        return $months[$monthNumber];
    }

    private function getSpanishDayName(string $englishDay): string
    {
        $days = [
            'Mon' => 'Lun', 'Tue' => 'Mar', 'Wed' => 'Mié',
            'Thu' => 'Jue', 'Fri' => 'Vie', 'Sat' => 'Sáb',
            'Sun' => 'Dom',
        ];

        return $days[$englishDay];
    }

    public function getTimeSlots(): array
    {
        return self::TIME_SLOTS;
    }

    public function getCurrentMonth(): ?array
    {
        return $this->availableMonths[$this->currentMonthIndex] ?? null;
    }

    protected $rules = [
        'customer_name'   => 'required|string|min:3',
        'customer_phone'  => 'required|string|min:10',
        'selectedEmployee'=> 'required',
        'selectedService'  => 'required',
        'selectedDate'    => 'required|date',
        'selectedTime'    => 'required',
    ];

    public function storeAppointment()
    {
        $this->validate();

        Appointment::create([
            'client_name'       => $this->customer_name,
            'phone'             => $this->customer_phone,
            'service_id'        => $this->selectedService->id,
            'employee_id'       => $this->selectedEmployee->id,
            'appointment_date'  => $this->selectedDate,
            'appointment_time'  => $this->selectedTime,
            'notes'             => null,
        ]);

        // Resetear formulario
        $this->reset([
            'customer_name',
            'customer_phone',
            'selectedEmployee',
            'selectedDate',
            'selectedTime',
            'selectedService',
        ]);

        // Opcional: volver al primer mes
        $this->currentMonthIndex = 0;

        // Mensaje de éxito
        session()->flash('success', '✅ Cita agendada correctamente');
    }

    public function render()
    {
        return view('livewire.appointments.create', [
            'timeSlots' => $this->getTimeSlots(),
            'currentMonth' => $this->getCurrentMonth(),
        ]);
    }
}

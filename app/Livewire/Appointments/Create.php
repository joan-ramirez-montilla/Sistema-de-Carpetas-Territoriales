<?php

namespace App\Livewire\Appointments;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\{CompanySetting, Service, Appointment, Employee};

class Create extends Component
{
    public CompanySetting $companySetting;

    public $employees;
    public $services;

    public $selectedEmployee = null;
    public $selectedService = null;

    public $selectedDate = null;
    public $selectedTime = null;

    public $customer_name = '';
    public $customer_phone = '';

    public array $timeSlots = [];

    public array $availableMonths = [];
    public int $currentMonthIndex = 0;

    private const DAYS_RANGE = 15;
    private const INTERVAL = 45;

    /* ===================== MOUNT ===================== */

    public function mount(): void
    {
        $this->companySetting = CompanySetting::first() ?? new CompanySetting();
        $this->employees = Employee::where('status', 'active')->get();
        $this->services = Service::all();
        $this->generateAvailableDates();
    }

    /* ===================== WATCHERS ===================== */

    public function updatedSelectedEmployee()
    {
        $this->selectedDate = null;
        $this->selectedTime = null;
        $this->timeSlots = [];
    }

    public function updatedSelectedDate()
    {
        $this->selectedTime = null;
        $this->loadAvailableTimeSlots();
    }

    /* ===================== SELECTION ===================== */

    public function selectBarber(int $id)
    {
        $this->selectedEmployee = Employee::find($id);

        // Limpieza forzada
        $this->selectedDate = null;
        $this->selectedTime = null;
        $this->timeSlots = [];
    }

    public function selectService(int $id)
    {
        $this->selectedService = Service::find($id);
    }

    /* ===================== CALENDAR ===================== */

    private function generateAvailableDates(): void
    {
        $start = Carbon::today();
        $months = [];

        for ($i = 0; $i < self::DAYS_RANGE; $i++) {
            $date = $start->copy()->addDays($i);
            $key = $date->format('Y-m');

            if (!isset($months[$key])) {
                $months[$key] = [
                    'monthName' => $this->spanishMonth($date->format('m')),
                    'year' => $date->format('Y'),
                    'dates' => [],
                ];
            }

            $months[$key]['dates'][] = [
                'value' => $date->format('Y-m-d'),
                'number' => $date->format('d'),
                'day' => $this->spanishShortDay($date->format('D')),
            ];
        }

        $this->availableMonths = array_values($months);
    }

    public function previousMonth()
    {
        if ($this->currentMonthIndex > 0) {
            $this->currentMonthIndex--;
            $this->selectedDate = null;
        }
    }

    public function nextMonth()
    {
        if ($this->currentMonthIndex < count($this->availableMonths) - 1) {
            $this->currentMonthIndex++;
            $this->selectedDate = null;
        }
    }

    /* ===================== TIME SLOTS CORE ===================== */
    private function loadAvailableTimeSlots(): void
    {
        if (!$this->selectedEmployee || !$this->selectedDate) {
            $this->timeSlots = [];
            return;
        }

        $employee = $this->selectedEmployee;
        $date = Carbon::parse($this->selectedDate);

        $dayName = $this->spanishFullDay($date->format('D'));
        $schedule = $employee->schedule[$dayName] ?? null;

        if (!$schedule || !$schedule['active']) {
            $this->timeSlots = [];
            return;
        }

        $start = Carbon::createFromFormat('H:i', $schedule['start']);
        $end   = Carbon::createFromFormat('H:i', $schedule['end']);

        $takenTimes = Appointment::where('employee_id', $employee->id)
            ->whereDate('appointment_date', $this->selectedDate)
            ->pluck('appointment_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            })
            ->toArray();

        $slots = [];

        while ($start->lt($end)) {
            $time24 = $start->format('H:i'); // valor real para comparar
            $timeAMPM = $start->format('g:i A'); // formato para mostrar

            // excluir horas pasadas si es hoy
            if ($date->isToday() && $start->lt(now())) {
                $start->addMinutes(self::INTERVAL);
                continue;
            }

            // excluir horas ya tomadas
            if (!in_array($time24, $takenTimes)) {
                $slots[] = [
                    'value' => $time24,
                    'label' => $timeAMPM,
                ];
            }

            $start->addMinutes(self::INTERVAL);
        }

        $this->timeSlots = $slots;
    }

    /* ===================== STORE ===================== */

    protected $rules = [
        'customer_name' => 'required|min:3',
        'customer_phone' => 'required|min:10',
        'selectedService' => 'required',
        'selectedEmployee' => 'required',
        'selectedDate' => 'required|date',
        'selectedTime' => 'required',
    ];

    public function storeAppointment()
    {
        $this->validate();

        // Seguridad: evitar doble reserva
        $exists = Appointment::where('employee_id', $this->selectedEmployee->id)
            ->whereDate('appointment_date', $this->selectedDate)
            ->where('appointment_time', $this->selectedTime)
            ->exists();

        if ($exists) {
            $this->addError('selectedTime', 'Este horario ya fue tomado.');
            return;
        }

        Appointment::create([
            'client_name' => $this->customer_name,
            'phone' => $this->customer_phone,
            'service_id' => $this->selectedService->id,
            'employee_id' => $this->selectedEmployee->id,
            'appointment_date' => $this->selectedDate,
            'appointment_time' => $this->selectedTime,
        ]);

        dd('Hacer una pantalla de reserva (o verificar si hacer un redirect).');
    }

    /* ===================== HELPERS ===================== */

    private function spanishMonth($m)
    {
        return [
            '01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril',
            '05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto',
            '09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'
        ][$m];
    }

    private function spanishShortDay($d)
    {
        return [
            'Mon'=>'Lun','Tue'=>'Mar','Wed'=>'Mié',
            'Thu'=>'Jue','Fri'=>'Vie','Sat'=>'Sáb','Sun'=>'Dom'
        ][$d];
    }

    private function spanishFullDay($d)
    {
        return [
            'Mon'=>'Lunes','Tue'=>'Martes','Wed'=>'Miércoles',
            'Thu'=>'Jueves','Fri'=>'Viernes','Sat'=>'Sábado','Sun'=>'Domingo'
        ][$d];
    }

    public function render()
    {
        return view('livewire.appointments.create', [
            'currentMonth' => $this->availableMonths[$this->currentMonthIndex] ?? null,
        ]);
    }
}

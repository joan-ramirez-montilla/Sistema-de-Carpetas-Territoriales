<?php

namespace App\Traits;

trait HasSchedule
{
    private function defaultSchedule()
    {
        return [
            'Lunes'    => ['active' => false, 'start' => '08:00', 'end' => '18:00'],
            'Martes'   => ['active' => false, 'start' => '08:00', 'end' => '18:00'],
            'Miércoles'=> ['active' => false, 'start' => '08:00', 'end' => '18:00'],
            'Jueves'   => ['active' => false, 'start' => '08:00', 'end' => '18:00'],
            'Viernes'  => ['active' => false, 'start' => '08:00', 'end' => '18:00'],
            'Sábado'   => ['active' => false, 'start' => '08:00', 'end' => '18:00'],
            'Domingo'  => ['active' => false, 'start' => '08:00', 'end' => '18:00'],
        ];
    }

    /**
     * Combina el schedule por defecto con el guardado en DB
     */
    protected function mergeSchedule($existingSchedule = [])
    {
        return array_merge($this->defaultSchedule(), $existingSchedule ?? []);
    }

    /**
     * Valida que end sea mayor que start usando $this->schedule
     */
    protected function validateSchedule()
    {
        foreach ($this->schedule as $day => $data) {

            if (empty($data['active']) || !$data['active']) {
                continue;
            }

            $start = $data['start'] ?? '00:00';
            $end   = $data['end'] ?? '00:00';

            if (strtotime($end) <= strtotime($start)) {
                $this->addError("schedule.$day.end", "La hora de cierre debe ser mayor que la hora de inicio en $day.");
            }
        }
    }

    /**
     * Valida que el schedule del empleado esté dentro del horario de la empresa
     */
    protected function validateScheduleWithinCompany($companySchedule)
    {
        foreach ($this->schedule as $day => $data) {

            // Si el empleado no activó el día, no validar
            if (empty($data['active']) || !$data['active']) {
                continue;
            }

            // Si la empresa no tiene activo ese día
            if (empty($companySchedule[$day]['active']) || !$companySchedule[$day]['active']) {
                $this->addError("schedule.$day.active", "La empresa no tiene habilitado este día ($day).");
                continue;
            }

            $empStart = strtotime($data['start'] ?? '00:00');
            $empEnd   = strtotime($data['end'] ?? '00:00');

            $companyStart = strtotime($companySchedule[$day]['start'] ?? '00:00');
            $companyEnd   = strtotime($companySchedule[$day]['end'] ?? '00:00');

            if ($empStart < $companyStart) {
                $this->addError("schedule.$day.start", "El horario de inicio del empleado no puede ser antes del horario de la empresa ($day).");
            }

            if ($empEnd > $companyEnd) {
                $this->addError("schedule.$day.end", "El horario de cierre del empleado no puede ser después del horario de la empresa ($day).");
            }
        }
    }
}

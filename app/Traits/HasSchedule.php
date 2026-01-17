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
    private function mergeSchedule($existingSchedule = [])
    {
        return array_merge($this->defaultSchedule(), $existingSchedule ?? []);
    }

    private function validateSchedule($schedule)
    {
        foreach ($schedule as $day => $data) {

            // Si el día no está activo, no validar
            if (empty($data['active']) || !$data['active']) {
                continue;
            }

            $start = $data['start'] ?? '00:00';
            $end   = $data['end'] ?? '00:00';

            $startMinutes = strtotime($start);
            $endMinutes   = strtotime($end);

            if ($endMinutes <= $startMinutes) {
                $this->addError("schedule.$day.end", "La hora de cierre debe ser mayor que la hora de inicio en $day.");
            }
        }
    }

    private function validateScheduleWithinCompany($employeeSchedule, $companySchedule)
    {
        foreach ($employeeSchedule as $day => $data) {

            if (empty($data['active']) || !$data['active']) {
                continue;
            }

            $empStart = strtotime($data['start'] ?? '00:00');
            $empEnd   = strtotime($data['end'] ?? '00:00');

            $companyStart = strtotime($companySchedule[$day]['start'] ?? '00:00');
            $companyEnd   = strtotime($companySchedule[$day]['end'] ?? '00:00');

            // Si el empleado inicia antes que la empresa
            if ($empStart < $companyStart) {
                $this->addError("schedule.$day.start", "El horario de inicio del empleado no puede ser antes del horario de la empresa ($day).");
            }

            // Si el empleado termina después que la empresa
            if ($empEnd > $companyEnd) {
                $this->addError("schedule.$day.end", "El horario de cierre del empleado no puede ser después del horario de la empresa ($day).");
            }
        }
    }
}

<?php

namespace App\Traits;

trait HasAvailableHours
{
    public function getAvailableHoursProperty()
    {
        $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        $result = [];

        foreach ($days as $day) {

            $daySchedule = $this->companySetting->schedule[$day] ?? null;

            // Si la empresa no trabaja ese día, no hay horas disponibles
            if (!$daySchedule || !$daySchedule['active']) {
                $result[$day] = [];
                continue;
            }

            $start = $daySchedule['start']; // ejemplo: 06:00
            $end = $daySchedule['end'];     // ejemplo: 18:00

            $hours = [];
            $current = strtotime($start);
            $endTime = strtotime($end);

            while ($current <= $endTime) {
                $hours[] = date('H:i', $current);
                $current = strtotime('+30 minutes', $current);
            }

            $result[$day] = $hours;
        }

        return $result;
    }
}

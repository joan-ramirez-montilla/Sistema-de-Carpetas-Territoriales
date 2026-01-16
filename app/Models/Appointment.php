<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'client_name',
        'phone',
        'service_id',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',
    ];

    /**
     * Relación con el servicio
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

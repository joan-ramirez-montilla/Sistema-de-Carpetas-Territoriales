<?php

namespace App\Models;

use App\Models\{Service, Employee};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_name',
        'phone',
        'service_id',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',
        'employee_id'
    ];

    /**
     * Relación con el servicio
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

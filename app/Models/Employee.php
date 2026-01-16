<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'phone',
        'status',
        'schedule',
        'user_id'
    ];

     protected $casts = [
        'schedule' => 'array',
    ];

    /**
     * Obtener el usuario asociado al empleado.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

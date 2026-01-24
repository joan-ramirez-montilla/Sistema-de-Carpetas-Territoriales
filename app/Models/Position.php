<?php

namespace App\Models;

use App\Models\Person;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}

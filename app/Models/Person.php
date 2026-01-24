<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'full_name',
        'national_id',
        'phone',
        'mobile',
        'office_phone',
        'email',
        'address',
        'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function records()
    {
        return $this->hasMany(TerritorialFolderRecord::class);
    }
}

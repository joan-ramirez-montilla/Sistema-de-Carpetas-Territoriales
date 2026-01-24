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
        'position_id',
        'organization_id',
        'province_id',
        'municipality_id',
        'district_id',
        'circumscription'
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

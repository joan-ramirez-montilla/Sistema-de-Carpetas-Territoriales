<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }
}

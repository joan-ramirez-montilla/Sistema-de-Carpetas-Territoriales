<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'is_active'];

        public function provinces()
    {
        return $this->hasMany(Province::class);
    }
}

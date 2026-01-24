<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'municipality_id', 'is_active'];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    protected $fillable = ['code', 'municipality_id', 'is_active'];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}

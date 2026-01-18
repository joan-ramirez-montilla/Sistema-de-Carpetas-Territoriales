<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanySetting extends Model
{
    use SoftDeletes;

    protected $table = 'company_settings';

    protected $fillable = [
        'name', 'logo', 'phone', 'email', 'map_url',
        'primary_color', 'secondary_color', 'schedule',
        'facebook', 'instagram', 'twitter', 'whatsapp',
        'seo_title', 'seo_description', 'seo_keywords',
        'location_description'
    ];

    protected $casts = [
        'schedule' => 'array'
    ];
}

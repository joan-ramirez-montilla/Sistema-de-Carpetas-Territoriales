<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $table = 'company_settings';

    protected $fillable = [
        'name', 'logo', 'phone', 'email', 'map_url',
        'primary_color', 'secondary_color', 'schedule',
        'facebook', 'instagram', 'twitter', 'whatsapp',
        'seo_title', 'seo_description', 'seo_keywords'
    ];

    protected $casts = [
        'schedule' => 'array'
    ];
}

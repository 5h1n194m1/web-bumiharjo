<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'hero_headline',
        'hero_subheadline',
        'about_title',
        'about_content',
        'services_title',
        'services_intro',
        'footer_title',
        'address',
        'maps_embed_url',
        'opening_hours',
        'whatsapp_number',
        'whatsapp_message',
    ];
}
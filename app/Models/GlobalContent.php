<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalContent extends Model
{
    protected $fillable = [
        'header_cta_label',
        'header_cta_url',
        'footer_title_1',
        'footer_content_1',
        'footer_title_2',
        'footer_content_2',
        'footer_title_3',
        'footer_content_3',
        'footer_title_4',
        'footer_content_4',
        'contact_forms_title',
        'contact_forms_intro',
        'contact_form_1_label',
        'contact_form_1_embed',
        'contact_form_2_label',
        'contact_form_2_embed',
    ];

    public static function singleton(): self
    {
        return static::query()->first() ?? static::query()->create();
    }
}

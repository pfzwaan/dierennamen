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
        'footer_social_label',
        'footer_social_facebook_url',
        'footer_social_instagram_url',
        'footer_social_tiktok_url',
        'footer_social_youtube_url',
        'contact_forms_title',
        'contact_forms_intro',
        'name_ai_openai_api_key',
        'name_ai_model',
        'name_ai_prompt',
        'name_ai_keywords',
        'name_ai_temperature',
        'name_ai_max_tokens',
        'name_ai_targets',
        'name_ai_names_mode',
    ];

    protected $casts = [
        'name_ai_openai_api_key' => 'encrypted',
        'name_ai_temperature' => 'float',
        'name_ai_max_tokens' => 'integer',
        'name_ai_targets' => 'array',
    ];

    public static function singleton(): self
    {
        return static::query()->first() ?? static::query()->create();
    }
}

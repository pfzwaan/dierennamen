<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Name extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'gender',
        'name_category_id',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $name): void {
            if (blank($name->slug) || $name->isDirty('title')) {
                $name->slug = self::generateUniqueSlug($name->title, $name->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $base = $base !== '' ? $base : 'name';
        $slug = $base;
        $counter = 2;

        while (
            self::query()
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function nameCategory(): BelongsTo
    {
        return $this->belongsTo(NameCategory::class);
    }
}

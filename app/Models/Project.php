<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Tags\HasTags;

class Project extends Model
{
    use HasTags;
    use HasSEO;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'url',
        'github_url',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }
}
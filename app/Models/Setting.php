<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Helpers\Laravel\Concerns\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_description',
        'site_url',
        'email',
        'phone',
        'address',

        'github',
        'linkedin',
        'twitter',
        'instagram',
        'telegram',

        'logo',
        'favicon',

        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'is_indexed',
    ];

    protected $casts = [
        'is_indexed' => 'boolean',
    ];
}

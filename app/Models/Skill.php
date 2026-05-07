<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Skill extends Model
{
    use HasTags;
    protected $fillable = [
        'name',
        'percentage',
        'category',
        'sort_order',
    ];

    protected $casts = [
        'percentage' => 'integer',
    ];
}
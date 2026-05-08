<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'institution',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function getDurationAttribute(): string
    {
        $start = $this->start_date->format('Y/m');
        $end = $this->is_current ? 'Present' : $this->end_date?->format('Y/m');
        return "$start - $end";
    }
}
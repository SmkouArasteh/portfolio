<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class About extends Model
{
    use HasSEO;

    protected $table = 'about';

    protected $fillable = [
        'title',
        'bio',
        'image',
    ];
}
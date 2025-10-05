<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Programs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'status',
    ];

    // otomatis bikin slug
    protected static function booted()
    {
        static::creating(function ($program) {
            $program->slug = Str::slug($program->title);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklySchedules extends Model
{
    protected $fillable = ['day', 'start_time', 'end_time', 'activity', 'teacher'];

    protected $casts = [
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklySchedules extends Model
{
    protected $fillable = ['day'];

    public function items()
    {
        return $this->hasMany(DailyScheduleItem::class, 'weekly_schedule_id');
    }

    public function level()
    {
        return $this->belongsTo(UmmiLevel::class, 'ummi_level_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyScheduleItem extends Model
{
    protected $fillable = [
        'weekly_schedule_id',
        'ummi_level_id',
        'start_time',
        'end_time',
        'activity',
        'teacher_id',
    ];

    public function weeklySchedule()
    {
        return $this->belongsTo(WeeklySchedules::class, 'weekly_schedule_id');
    }

    public function ummiLevel()
    {
        return $this->belongsTo(UmmiLevel::class, 'ummi_level_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
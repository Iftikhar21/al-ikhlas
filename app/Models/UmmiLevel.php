<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmmiLevel extends Model
{
    protected $fillable = ['name', 'description'];

    public function scheduleItems()
    {
        return $this->hasMany(DailyScheduleItem::class);
    }
}

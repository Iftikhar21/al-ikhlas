<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSchedules extends Model
{
    protected $fillable = ['title', 'description', 'event_date', 'image'];
}

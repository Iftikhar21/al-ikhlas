<?php

use Carbon\Carbon;

if (!function_exists('formatTimeWithPeriod')) {
    function formatTimeWithPeriod($time)
    {
        $hour = Carbon::parse($time)->hour;
        $period = '';

        if ($hour >= 5 && $hour < 12)
            $period = 'Pagi';
        elseif ($hour >= 12 && $hour < 15)
            $period = 'Siang';
        elseif ($hour >= 15 && $hour < 18)
            $period = 'Sore';
        else
            $period = 'Malam';

        return Carbon::parse($time)->format('H:i') . ' ' . $period;
    }
}

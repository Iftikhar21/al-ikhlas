<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Programs;
use App\Models\EventSchedules;
use App\Models\WeeklySchedules;
use App\Models\QuoteSchedules;
use App\Models\RegisterOnline;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Data statistik utama
        $pendingRegistrations = RegisterOnline::where('is_approved', false)->count();
        $totalPrograms = Programs::count();
        $totalNews = News::count();

        // Event dalam 7 hari ke depan
        $upcomingEvents = EventSchedules::where('event_date', '>=', now())
            ->where('event_date', '<=', now()->addDays(7))
            ->count();

        // Pendaftaran baru (5 terbaru)
        $recentRegistrations = RegisterOnline::where('is_approved', false)
            ->latest()
            ->take(5)
            ->get();

        // Daftar event mendatang
        $upcomingEventsList = EventSchedules::where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        // Jadwal hari ini - konversi hari Indonesia ke Inggris
        $todayIndonesian = $this->getIndonesianDay();
        $todayEnglish = $this->convertToEnglishDay($todayIndonesian);
        $todaySchedules = WeeklySchedules::where('day', $todayEnglish)
            ->orderBy('start_time')
            ->get();

        // Quote harian acak
        $dailyQuote = QuoteSchedules::inRandomOrder()->first();

        // Berita terbaru
        $recentNews = News::latest()->take(3)->get();

        // Program aktif
        $activePrograms = Programs::where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'pendingRegistrations',
            'totalPrograms',
            'totalNews',
            'upcomingEvents',
            'recentRegistrations',
            'upcomingEventsList',
            'todaySchedules',
            'dailyQuote',
            'recentNews',
            'activePrograms'
        ));
    }

    /**
     * Get current day in Indonesian
     */
    private function getIndonesianDay()
    {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $englishDay = now()->englishDayOfWeek;
        return $days[$englishDay] ?? $englishDay;
    }

    /**
     * Convert Indonesian day to English for database query
     */
    private function convertToEnglishDay($indonesianDay)
    {
        $days = [
            'Minggu' => 'sunday',
            'Senin' => 'monday',
            'Selasa' => 'tuesday',
            'Rabu' => 'wednesday',
            'Kamis' => 'thursday',
            'Jumat' => 'friday',
            'Sabtu' => 'saturday'
        ];

        return $days[$indonesianDay] ?? strtolower($indonesianDay);
    }
}

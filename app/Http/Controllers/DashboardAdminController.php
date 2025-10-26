<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Programs;
use Illuminate\Http\Request;
use App\Models\EventSchedules;
use App\Models\QuoteSchedules;
use App\Models\RegisterOnline;
use App\Models\WeeklySchedules;
use App\Models\DailyScheduleItem;

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

        /**
         * ========================================
         * 🔁 BAGIAN JADWAL HARI INI (versi baru)
         * ========================================
         */
        $todayIndonesian = $this->getIndonesianDay();
        $todayEnglish = $this->convertToEnglishDay($todayIndonesian);

        // ambil WeeklySchedule untuk hari ini
        $weekly = WeeklySchedules::whereRaw('LOWER(day) = ?', [$todayEnglish])->first();


        // ambil daftar DailyScheduleItem yang terkait
        $todaySchedules = WeeklySchedules::with(['items.ummiLevel'])
            ->whereRaw('LOWER(day) = ?', [$todayEnglish])
            ->orderByRaw("FIELD(day, 'monday','tuesday','wednesday','thursday','friday','saturday','sunday')")
            ->first();

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

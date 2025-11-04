<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Footer;
use App\Models\History;
use App\Models\OrganizationStructure;
use App\Models\Programs;
use App\Models\Vision;
use Illuminate\Http\Request;
use App\Models\EventSchedules;
use App\Models\QuoteSchedules;
use App\Models\WeeklySchedules;

class ViewController extends Controller
{
    public function HomePage()
    {
        $heroSlides = News::latest()->take(5)->get();
        $newsList = News::latest()->take(6)->get();
        $programs = Programs::where('status', 'published')->take(3)->get();

        // Ambil data schedule
        $weeklySchedules = WeeklySchedules::with(['items' => function ($q) {
            $q->orderBy('start_time');
        }])
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->take(5)
            ->get();

        $eventSchedules = EventSchedules::where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        $footer = Footer::with('socials')->latest('id')->first();

        return view('home', compact(
            'heroSlides',
            'newsList',
            'programs',
            'weeklySchedules',
            'eventSchedules',
            'footer'
        ));
    }

    public function HistoryPage()
    {
        $history = History::first();
        $visions = Vision::all();
        return view('history', compact('history', 'visions'));
    }

    public function StructurePage()
    {
        $structure = OrganizationStructure::first();
        return view('structure', compact('structure'));
    }

    public function VisionMissionPage()
    {
        $visions = Vision::all();
        return view('vision', compact('visions'));
    }

    public function NewsPage()
    {
        $newsList = News::latest()->take(6)->get();
        return view('news', compact('newsList'));
    }

    public function NewsDetailPage($slug)
    {
        // cari berita berdasarkan slug, bukan id
        $news = News::with('photos')->where('slug', $slug)->firstOrFail();

        // ambil 6 berita terbaru lainnya, kecuali berita yang sedang dibuka
        $otherNews = News::where('id', '!=', $news->id)
            ->latest()
            ->take(6)
            ->get();

        return view('news-detail', compact('news', 'otherNews'));
    }

    public function ProgramPage()
    {
        // Ambil hanya program dengan status 'published'
        $programs = Programs::where('status', 'published')->get();
        return view('program', compact('programs'));
    }

    public function ProgramDetailPage($slug)
    {
        $program = Programs::where('slug', $slug)->firstOrFail();

        // Get 3 other programs excluding the current one
        $otherPrograms = Programs::where('id', '!=', $program->id)->take(3)->get();

        return view('program-detail', compact('program', 'otherPrograms'));
    }


    public function SchedulePage()
    {
        // Ambil data weekly schedules dengan urutan hari
        $weeklySchedules = WeeklySchedules::with(['items' => function ($q) {
            $q->orderBy('start_time');
        }])
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get();

        // Ambil data event schedules (upcoming events)
        $eventSchedules = EventSchedules::where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->get();

        // Ambil random quote untuk motivasi
        $quote = QuoteSchedules::inRandomOrder()->first();

        return view('schedule', compact('weeklySchedules', 'eventSchedules', 'quote'));
    }

    public function RegistrationPage() {
        return view('register-online');
    }

    public function ContactPage()
    {
        $footer = Footer::with('socials')->latest('id')->first();
        return view('contact', compact('footer'));
    }

    public function LoginPage() {
        return view('auth.login');
    }
}

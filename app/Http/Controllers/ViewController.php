<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Footer;
use App\Models\Kajian;
use App\Models\Vision;
use App\Models\History;
use App\Models\Programs;
use App\Models\TpaVision;
use App\Models\TpaHistory;
use App\Models\MasjidVision;
use Illuminate\Http\Request;
use App\Models\MasjidHistory;
use App\Models\EventSchedules;
use App\Models\KoperasiActivity;
use App\Models\KoperasiVision;
use App\Models\QuoteSchedules;
use App\Models\KoperasiHistory;
use App\Models\WeeklySchedules;
use App\Models\OrganizationStructure;
use App\Models\TpaOrganizationStructure;
use App\Models\MasjidOrganizationStructure;
use App\Models\KoperasiOrganizationStructure;
use App\Models\Teacher;

class ViewController extends Controller
{
    // ======================================================
    // 🌐 GLOBAL (HOME / NEWS / CONTACT)
    // ======================================================
    public function HomePage()
    {
        $heroSlides = News::latest()->take(5)->get();
        $newsList = News::latest()->take(6)->get();
        $programs = Programs::where('status', 'published')->take(3)->get();
        $upcomingKajians = Kajian::orderByRaw("FIELD(hari, 'sabtu', 'ahad')")
            ->take(3)
            ->get();

        $weeklySchedules = WeeklySchedules::with(['items' => fn($q) => $q->orderBy('start_time')])
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->take(5)
            ->get();

        $eventSchedules = EventSchedules::where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        $latestActivities = KoperasiActivity::with('koperasi_activity_photos')
            ->latest()
            ->take(3)
            ->get();

        $footer = Footer::with('socials')->latest('id')->first();

        return view('home', compact(
            'heroSlides',
            'newsList',
            'upcomingKajians',
            'programs',
            'weeklySchedules',
            'eventSchedules',
            'latestActivities',
            'footer'
        ));
    }

    public function NewsPage()
    {
        // Berita terbaru dengan pagination
        $newsList = News::latest()->paginate(6);

        // Berita populer (dilihat terbanyak)
        $popularNews = News::orderBy('views', 'desc')
            ->take(5)
            ->get();

        // Berita rekomendasi (random/berdasarkan kategori yang sama)
        $recommendedNews = News::inRandomOrder() // Atau logika rekomendasi sesuai kebutuhan
            ->take(6)
            ->get();

        return view('news', compact('newsList', 'popularNews', 'recommendedNews'));
    }

    public function NewsDetailPage($slug)
    {
        $news = News::with('photos')->where('slug', $slug)->firstOrFail();

        // Tambah view +1
        $news->increment('views');

        // Berita lainnya (rekomendasi)
        $otherNews = News::where('id', '!=', $news->id)
            ->latest()
            ->take(6)
            ->get();

        // Ambil berita populer untuk sidebar
        $popularNews = News::orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('news-detail', compact('news', 'otherNews', 'popularNews'));
    }

    public function ContactPage()
    {
        $footer = Footer::with('socials')->latest('id')->first();
        return view('contact', compact('footer'));
    }

    // ======================================================
    // 🕌 MASJID SECTION
    // ======================================================
    public function MasjidSejarah()
    {
        $history = MasjidHistory::first();
        $visions = MasjidVision::all();
        return view('masjid.history', compact('history', 'visions'));
    }

    public function MasjidStruktur()
    {
        $structure = MasjidOrganizationStructure::first();
        return view('masjid.structure', compact('structure'));
    }

    public function MasjidVisiMisi()
    {
        $visions = MasjidVision::all();
        return view('masjid.vision', compact('visions'));
    }

    public function MasjidKajian()
    {
        $today = Carbon::today();
        $kajians = Kajian::orderByRaw("FIELD(hari, 'sabtu', 'ahad')")
            ->take(3)
            ->get();

        return view('masjid.kajian', compact('kajians'));
    }

    // ======================================================
    // 📚 TPA SECTION
    // ======================================================

    public function TPAProgramPage()
    {
        $programs = Programs::where('status', 'published')->get();
        return view('tpa.program', compact('programs'));
    }

    public function TPAProgramDetailPage($slug)
    {
        $program = Programs::where('slug', $slug)->firstOrFail();
        $otherPrograms = Programs::where('id', '!=', $program->id)->take(3)->get();
        return view('tpa.program-detail', compact('program', 'otherPrograms'));
    }

    public function TPAHistory()
    {
        $history = TpaHistory::first();
        $visions = TpaVision::all();
        return view('tpa.history', compact('history', 'visions' ));
    }

    public function TPAStructure()
    {
        $structure = TpaOrganizationStructure::first();
        return view('tpa.structure', compact('structure'));
    }

    public function TPAVisionMission()
    {
        $visions = TpaVision::all();
        return view('tpa.vision', compact('visions'));
    }

    public function TPATeachers()
    {
        $pengajars = Teacher::all();
        return view('tpa.teacher', compact('pengajars'));
    }

    public function TPANews()
    {
        $newsList = News::latest()->take(6)->get();
        return view('tpa.berita', compact('newsList'));
    }

    public function TPASchedule()
    {
        $weeklySchedules = WeeklySchedules::with(['items' => fn($q) => $q->orderBy('start_time')])
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get();

        $eventSchedules = EventSchedules::where('event_date', '>=', now())->orderBy('event_date', 'asc')->get();
        $quote = QuoteSchedules::inRandomOrder()->first();

        return view('tpa.schedule', compact('weeklySchedules', 'eventSchedules', 'quote'));
    }

    public function TPARegister()
    {
        return view('tpa.register-online');
    }

    // ======================================================
    // 💼 KOPERASI SECTION
    // ======================================================
    public function KoperasiSejarah()
    {
        $history = KoperasiHistory::first();
        $visions = KoperasiVision::all();
        return view('koperasi.history', compact('history', 'visions'));
    }

    public function KoperasiStruktur()
    {
        $structure = KoperasiOrganizationStructure::first();
        return view('koperasi.structure', compact('structure'));
    }

    public function KoperasiVisiMisi()
    {
        $visions = KoperasiVision::all();
        return view('koperasi.vision', compact('visions'));
    }

    public function KoperasiKegiatan()
    {
        $activities = KoperasiActivity::with('koperasi_activity_photos')
            ->latest()
            ->paginate(9);
        return view('koperasi.activity', compact('activities'));
    }

    public function KoperasiKegiatanDetail($slug)
    {
        $activity = KoperasiActivity::with('koperasi_activity_photos')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('koperasi.activity-detail', compact('activity'));
    }
}
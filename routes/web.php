<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\KajianController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TpaVisionController;
use App\Http\Controllers\UmmiLevelController;
use App\Http\Controllers\TpaHistoryController;
use App\Http\Controllers\MasjidVisionController;
use App\Http\Controllers\MasjidHistoryController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\KoperasiVisionController;
use App\Http\Controllers\RegisterOnlineController;
use App\Http\Controllers\KoperasiHistoryController;
use App\Http\Controllers\KoperasiActivityController;
use App\Http\Controllers\OrganizationStructureController;
use App\Http\Controllers\TpaOrganizationStructureController;
use App\Http\Controllers\MasjidOrganizationStructureController;
use App\Http\Controllers\KoperasiOrganizationStructureController;

// ======================================================
// 🏠 ROUTE GLOBAL (UNTUK HALAMAN UTAMA / BERITA / KONTAK)
// ======================================================
Route::get('/', [ViewController::class, 'HomePage'])->name('home');
Route::get('/news', [ViewController::class, 'NewsPage'])->name('news');
Route::get('/news-detail/{slug}', [ViewController::class, 'NewsDetailPage'])->name('news-detail');
Route::get('/contact', [ViewController::class, 'ContactPage'])->name('contact');
Route::resource('footer', FooterController::class);


// ======================================================
// 🕌 MASJID SECTION
// ======================================================
Route::prefix('masjid')->group(function () {
    Route::get('/sejarah', [ViewController::class, 'MasjidSejarah'])->name('masjid.sejarah');
    Route::get('/struktur', [ViewController::class, 'MasjidStruktur'])->name('masjid.struktur');
    Route::get('/visi-misi', [ViewController::class, 'MasjidVisiMisi'])->name('masjid.visimisi');
    Route::get('/kajian', [ViewController::class, 'MasjidKajian'])->name('masjid.kajian');
});


// ======================================================
// 📚 TPA SECTION
// ======================================================
Route::prefix('tpa')->group(function () {
    Route::get('/', [ViewController::class, 'TPAHome'])->name('tpa.home');
    Route::get('/program', [ViewController::class, 'TPAProgramPage'])->name('tpa.program');
    Route::get('/program-detail/{slug}', [ViewController::class, 'TPAProgramDetailPage'])->name('tpa.program-detail');
    Route::get('/sejarah', [ViewController::class, 'TPAHistory'])->name('tpa.history');
    Route::get('/struktur', [ViewController::class, 'TPAStructure'])->name('tpa.structure');
    Route::get('/visi-misi', [ViewController::class, 'TPAVisionMission'])->name('tpa.visimisi');
    Route::get('/guru', [ViewController::class, 'TPATeachers'])->name('tpa.teachers');
    Route::get('/berita', [ViewController::class, 'TPANews'])->name('tpa.news');
    Route::get('/jadwal', [ViewController::class, 'TPASchedule'])->name('tpa.schedule');
    Route::get('/pendaftaran', [ViewController::class, 'TPARegister'])->name('tpa.register');
    Route::post('/pendaftaran', [RegisterOnlineController::class, 'store'])->name('tpa.register.store');
});


// ======================================================
// 💼 KOPERASI SECTION
// ======================================================
Route::prefix('koperasi')->group(function () {
    Route::get('/sejarah', [ViewController::class, 'KoperasiSejarah'])->name('koperasi.sejarah');
    Route::get('/struktur', [ViewController::class, 'KoperasiStruktur'])->name('koperasi.struktur');
    Route::get('/visi-misi', [ViewController::class, 'KoperasiVisiMisi'])->name('koperasi.visimisi');
    Route::get('/kegiatan', [ViewController::class, 'KoperasiKegiatan'])->name('koperasi.kegiatan');
    Route::get('/kegiatan-detail/{slug}', [ViewController::class, 'KoperasiKegiatanDetail'])->name('koperasi.activity.detail');
});


// ======================================================
// 🔐 LOGIN & LOGOUT
// ======================================================
Route::get('/login', [LoginController::class, 'LoginPage'])->name('login');
Route::post('/action-login', [LoginController::class, 'actionLogin'])->name('action-login');
Route::post('/logout', [LoginController::class, 'actionLogout'])->name('action-logout');


// ======================================================
// ⚙️ ADMIN ROUTES
// ======================================================
// ======================================================
// ⚙️ ADMIN ROUTES
// ======================================================
Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // ======================================================
    // 📰 NEWS
    // ======================================================
    Route::resource('news', NewsController::class)->names([
        'index'   => 'admin.news.index',
        'create'  => 'admin.news.create',
        'store'   => 'admin.news.store',
        'show'    => 'admin.news.show',
        'edit'    => 'admin.news.edit',
        'update'  => 'admin.news.update',
        'destroy' => 'admin.news.destroy',
    ]);

    // ======================================================
    // 🕌 ADMIN MASJID
    // ======================================================
    Route::prefix('masjid')->name('admin.masjid.')->group(function () {
        Route::resource('history', MasjidHistoryController::class)->names([
            'index'   => 'history.index',
            'create'  => 'history.create',
            'store'   => 'history.store',
            'edit'    => 'history.edit',
            'update'  => 'history.update',
            'destroy' => 'history.destroy',
        ]);
        Route::resource('structure', MasjidOrganizationStructureController::class)->names([
            'index'   => 'structure.index',
            'create'  => 'structure.create',
            'store'   => 'structure.store',
            'edit'    => 'structure.edit',
            'update'  => 'structure.update',
            'destroy' => 'structure.destroy',
        ]);
        Route::resource('visions', MasjidVisionController::class)->names([
            'index'   => 'visions.index',
            'create'  => 'visions.create',
            'store'   => 'visions.store',
            'edit'    => 'visions.edit',
            'update'  => 'visions.update',
            'destroy' => 'visions.destroy',
        ]);
        Route::resource('kajian', KajianController::class)->names([
            'index'   => 'kajian.index',
            'create'  => 'kajian.create',
            'store'   => 'kajian.store',
            'edit'    => 'kajian.edit',
            'update'  => 'kajian.update',
            'destroy' => 'kajian.destroy',
        ]);
    });

    // ======================================================
    // 🏫 ADMIN TPA
    // ======================================================
    Route::prefix('tpa')->name('admin.tpa.')->group(function () {

        // 📖 Sejarah
        Route::resource('history', TpaHistoryController::class)->names([
            'index'   => 'history.index',
            'create'  => 'history.create',
            'store'   => 'history.store',
            'edit'    => 'history.edit',
            'update'  => 'history.update',
            'destroy' => 'history.destroy',
        ]);

        // 🧩 Struktur Organisasi
        Route::resource('structure', TpaOrganizationStructureController::class)->names([
            'index'   => 'structure.index',
            'create'  => 'structure.create',
            'store'   => 'structure.store',
            'edit'    => 'structure.edit',
            'update'  => 'structure.update',
            'destroy' => 'structure.destroy',
        ]);

        // 🎯 Visi & Misi
        Route::resource('visions', TpaVisionController::class)->names([
            'index'   => 'visions.index',
            'create'  => 'visions.create',
            'store'   => 'visions.store',
            'edit'    => 'visions.edit',
            'update'  => 'visions.update',
            'destroy' => 'visions.destroy',
        ]);

        // 👩‍🏫 Teachers (Guru)
        Route::resource('teachers', TeacherController::class)->names([
            'index'   => 'teachers.index',
            'create'  => 'teachers.create',
            'store'   => 'teachers.store',
            'edit'    => 'teachers.edit',
            'update'  => 'teachers.update',
            'destroy' => 'teachers.destroy',
        ]);

        // 🧠 Ummi Levels
        Route::resource('ummi-levels', UmmiLevelController::class)->names([
            'index'   => 'ummi-levels.index',
            'create'  => 'ummi-levels.create',
            'store'   => 'ummi-levels.store',
            'edit'    => 'ummi-levels.edit',
            'update'  => 'ummi-levels.update',
            'destroy' => 'ummi-levels.destroy',
        ]);

        // 🟢 Program
        Route::resource('programs', ProgramController::class)->names([
            'index'   => 'programs.index',
            'create'  => 'programs.create',
            'store'   => 'programs.store',
            'edit'    => 'programs.edit',
            'update'  => 'programs.update',
            'destroy' => 'programs.destroy',
        ]);

        // 🕒 Schedule (Jadwal)
        Route::get('schedule', [ScheduleController::class, 'mainIndex'])->name('schedule.index');

        // Weekly
        Route::get('weekly/create', [ScheduleController::class, 'weeklyCreate'])->name('weekly.create');
        Route::post('weekly', [ScheduleController::class, 'weeklyStore'])->name('weekly.store');
        Route::get('weekly/{weeklyId}/edit', [ScheduleController::class, 'weeklyEdit'])->name('weekly.edit');
        Route::put('weekly/{weeklyId}', [ScheduleController::class, 'weeklyUpdate'])->name('weekly.update');
        Route::delete('weekly/{weeklyId}', [ScheduleController::class, 'weeklyDestroy'])->name('weekly.destroy');

        // 🗓️ Events
        Route::get('events/create', [ScheduleController::class, 'eventCreate'])->name('events.create');
        Route::post('events', [ScheduleController::class, 'eventStore'])->name('events.store');
        Route::get('events/{eventId}/edit', [ScheduleController::class, 'eventEdit'])->name('events.edit');
        Route::put('events/{eventId}', [ScheduleController::class, 'eventUpdate'])->name('events.update');
        Route::get('events/{eventId}', [ScheduleController::class, 'eventShow'])->name('events.show');
        Route::delete('events/{eventId}', [ScheduleController::class, 'eventDestroy'])->name('events.destroy');

        // 💬 Quotes
        Route::get('quotes/create', [ScheduleController::class, 'quoteCreate'])->name('quotes.create');
        Route::post('quotes', [ScheduleController::class, 'quoteStore'])->name('quotes.store');
        Route::get('quotes/{quoteId}/edit', [ScheduleController::class, 'quoteEdit'])->name('quotes.edit');
        Route::put('quotes/{quoteId}', [ScheduleController::class, 'quoteUpdate'])->name('quotes.update');
        Route::get('quotes/{quoteId}', [ScheduleController::class, 'quoteShow'])->name('quotes.show');
        Route::delete('quotes/{quoteId}', [ScheduleController::class, 'quoteDestroy'])->name('quotes.destroy');
    });

    // ======================================================
    // 💼 ADMIN KOPERASI
    // ======================================================
    Route::prefix('koperasi')->name('admin.koperasi.')->group(function () {
        Route::resource('history', KoperasiHistoryController::class)->names([
            'index'   => 'history.index',
            'create'  => 'history.create',
            'store'   => 'history.store',
            'edit'    => 'history.edit',
            'update'  => 'history.update',
            'destroy' => 'history.destroy',
        ]);
        Route::resource('structure', KoperasiOrganizationStructureController::class)->names([
            'index'   => 'structure.index',
            'create'  => 'structure.create',
            'store'   => 'structure.store',
            'edit'    => 'structure.edit',
            'update'  => 'structure.update',
            'destroy' => 'structure.destroy',
        ]);
        Route::resource('visions', KoperasiVisionController::class)->names([
            'index'   => 'visions.index',
            'create'  => 'visions.create',
            'store'   => 'visions.store',
            'edit'    => 'visions.edit',
            'update'  => 'visions.update',
            'destroy' => 'visions.destroy',
        ]);
        Route::resource('activity', KoperasiActivityController::class)->names([
            'index'   => 'activity.index',
            'create'  => 'activity.create',
            'store'   => 'activity.store',
            'edit'    => 'activity.edit',
            'update'  => 'activity.update',
            'destroy' => 'activity.destroy',
        ]);
    });

    // ======================================================
    // 🦶 FOOTER
    // ======================================================
    Route::resource('footer', FooterController::class)->names([
        'index'   => 'admin.footer.index',
        'create'  => 'admin.footer.create',
        'store'   => 'admin.footer.store',
        'edit'    => 'admin.footer.edit',
        'update'  => 'admin.footer.update',
        'destroy' => 'admin.footer.destroy',
    ]);
});


// ======================================================
// 📋 ADMIN REGISTER ONLINE
// ======================================================
Route::prefix('admin-register-online')->middleware('auth')->group(function () {
    Route::get('/', [RegisterOnlineController::class, 'index'])->name('admin.register-online.index');
    Route::get('/{id}', [RegisterOnlineController::class, 'show'])->name('admin.register-online.show');
    Route::post('/{id}/approve', [RegisterOnlineController::class, 'approve'])->name('admin.register-online.approve');
    Route::delete('/{id}', [RegisterOnlineController::class, 'destroy'])->name('admin.register-online.destroy');
});
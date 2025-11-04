<?php

use App\Http\Controllers\OrganizationStructureController;
use App\Http\Controllers\VisionController;
use App\Models\RegisterOnline;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UmmiLevelController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\RegisterOnlineController;

// ==================== USER ROUTES ====================

// View Page User
Route::get('/', [ViewController::class, 'HomePage'])->name('home');
Route::get('/news', [ViewController::class, 'NewsPage'])->name('news');
Route::get('/news-detail/{slug}', [ViewController::class, 'NewsDetailPage'])->name('news-detail');
Route::get('/program', [ViewController::class, 'ProgramPage'])->name('program');
Route::get('/program-detail/{slug}', [ViewController::class, 'ProgramDetailPage'])->name('program-detail');
Route::get('/schedule', [ViewController::class, 'SchedulePage'])->name('schedule');
Route::get('/register-online', [ViewController::class, 'RegistrationPage'])->name('register-online');
Route::post('/pendaftaran', [RegisterOnlineController::class, 'store'])->name('register.store');
Route::get('/contact', [ViewController::class, 'ContactPage'])->name('contact');
Route::get('/history', [ViewController::class, 'HistoryPage'])->name('history');
Route::get('/structure-organization', [ViewController::class, 'StructurePage'])->name('structure');
Route::get('/vision-mission', [ViewController::class, 'VisionMissionPage'])->name('visionAndMission');
Route::resource('footer', FooterController::class);

// Login & Logout
Route::get('/login', [LoginController::class, 'LoginPage'])->name('login');
Route::post('/action-login', [LoginController::class, 'actionLogin'])->name('action-login');
Route::post('logout', [LoginController::class, 'actionLogout'])->name('action-logout');

// ==================== ADMIN ROUTES ====================

// Semua route admin otomatis pakai middleware 'auth'
Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // News & Programs
    Route::resource('news', NewsController::class)->names([
        'index'   => 'admin.news.index',
        'create'  => 'admin.news.create',
        'store'   => 'admin.news.store',
        'show'    => 'admin.news.show',
        'edit'    => 'admin.news.edit',
        'update'  => 'admin.news.update',
        'destroy' => 'admin.news.destroy',
    ]);

    Route::resource('programs', ProgramController::class)->names([
        'index'   => 'admin.programs.index',
        'create'  => 'admin.programs.create',
        'store'   => 'admin.programs.store',
        'show'    => 'admin.programs.show',
        'edit'    => 'admin.programs.edit',
        'update'  => 'admin.programs.update',
        'destroy' => 'admin.programs.destroy',
    ]);

    Route::resource('history', HistoryController::class)->names([
        'index'   => 'admin.history.index',
        'create'  => 'admin.history.create',
        'store'   => 'admin.history.store',
        'edit'    => 'admin.history.edit',
        'update'  => 'admin.history.update',
        'destroy' => 'admin.history.destroy',
    ]);

    Route::resource('structure', OrganizationStructureController::class)->names([
        'index'   => 'admin.structure.index',
        'create'  => 'admin.structure.create',
        'store'   => 'admin.structure.store',
        'edit'    => 'admin.structure.edit',
        'update'  => 'admin.structure.update',
        'destroy' => 'admin.structure.destroy',
    ]);

    Route::resource('visions', VisionController::class)->names([
        'index'   => 'admin.visions.index',
        'create'  => 'admin.visions.create',
        'store'   => 'admin.visions.store',
        'edit'    => 'admin.visions.edit',
        'update'  => 'admin.visions.update',
        'destroy' => 'admin.visions.destroy',
    ]);

    // ==================== SCHEDULE ROUTES ====================

    // SATU HALAMAN UNTUK MENAMPILKAN SEMUA JADWAL
    Route::get('schedules', [ScheduleController::class, 'mainIndex'])->name('admin.schedules.index');

    Route::resource('ummi-levels', UmmiLevelController::class)->names([
        'index'   => 'admin.ummi-levels.index',
        'store'   => 'admin.ummi-levels.store',
        'update'  => 'admin.ummi-levels.update',
        'destroy' => 'admin.ummi-levels.destroy',
    ])->except(['create', 'edit', 'show']);


    // Weekly Schedule - CREATE/EDIT/SHOW/DELETE halaman terpisah
    Route::get('weekly/create', [ScheduleController::class, 'weeklyCreate'])->name('admin.weekly.create');
    Route::post('weekly', [ScheduleController::class, 'weeklyStore'])->name('admin.weekly.store');
    Route::get('weekly/{weeklyId}/edit', [ScheduleController::class, 'weeklyEdit'])->name('admin.weekly.edit');
    Route::put('weekly/{weeklyId}', [ScheduleController::class, 'weeklyUpdate'])->name('admin.weekly.update');
    Route::delete('weekly/{weeklyId}', [ScheduleController::class, 'weeklyDestroy'])->name('admin.weekly.destroy');

    // Event Schedule - CREATE/EDIT/SHOW/DELETE halaman terpisah
    Route::get('events/create', [ScheduleController::class, 'eventCreate'])->name('admin.events.create');
    Route::post('events', [ScheduleController::class, 'eventStore'])->name('admin.events.store');
    Route::get('events/{eventId}/edit', [ScheduleController::class, 'eventEdit'])->name('admin.events.edit');
    Route::put('events/{eventId}', [ScheduleController::class, 'eventUpdate'])->name('admin.events.update');
    Route::get('events/{eventId}', [ScheduleController::class, 'eventShow'])->name('admin.events.show');
    Route::delete('events/{eventId}', [ScheduleController::class, 'eventDestroy'])->name('admin.events.destroy');

    // Quote Schedule - CREATE/EDIT/SHOW/DELETE halaman terpisah
    Route::get('quotes/create', [ScheduleController::class, 'quoteCreate'])->name('admin.quotes.create');
    Route::post('quotes', [ScheduleController::class, 'quoteStore'])->name('admin.quotes.store');
    Route::get('quotes/{quoteId}/edit', [ScheduleController::class, 'quoteEdit'])->name('admin.quotes.edit');
    Route::put('quotes/{quoteId}', [ScheduleController::class, 'quoteUpdate'])->name('admin.quotes.update');
    Route::get('quotes/{quoteId}', [ScheduleController::class, 'quoteShow'])->name('admin.quotes.show');
    Route::delete('quotes/{quoteId}', [ScheduleController::class, 'quoteDestroy'])->name('admin.quotes.destroy');

    // Footer
    Route::resource('footer', FooterController::class)->names([
        'index'   => 'admin.footer.index',
        'create'  => 'admin.footer.create',
        'store'   => 'admin.footer.store',
        'edit'    => 'admin.footer.edit',
        'update'  => 'admin.footer.update',
        'destroy' => 'admin.footer.destroy',
    ]);
});

// Register Online
Route::prefix('admin-register-online')->middleware('auth')->group(function () {
    Route::get('/', [RegisterOnlineController::class, 'index'])->name('admin.admin-register-online.index');
    Route::get('/{id}', [RegisterOnlineController::class, 'show'])->name('admin.admin-register-online.show');
    Route::post('/{id}/approve', [RegisterOnlineController::class, 'approve'])->name('admin.admin-register-online.approve');
    Route::delete('/{id}', [RegisterOnlineController::class, 'destroy'])->name('admin.admin-register-online.destroy');
});

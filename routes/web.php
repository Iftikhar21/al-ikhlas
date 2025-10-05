<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\RegisterOnlineController;
use App\Models\RegisterOnline;

// ==================== USER ROUTES ====================

// View Page User
Route::get('/', [ViewController::class, 'HomePage'])->name('home');
Route::get('/news', [ViewController::class, 'NewsPage'])->name('news');
Route::get('/news-detail/{id}', [ViewController::class, 'NewsDetailPage'])->name('news-detail');
Route::get('/program', [ViewController::class, 'ProgramPage'])->name('program');
Route::get('/program-detail/{slug}', [ViewController::class, 'ProgramDetailPage'])->name('program-detail');
Route::get('/schedule', [ViewController::class, 'SchedulePage'])->name('schedule');
Route::get('/register-online', [ViewController::class, 'RegistrationPage'])->name('register-online');
Route::post('/pendaftaran', [RegisterOnlineController::class, 'store'])->name('register.store');
Route::get('/contact', [ViewController::class, 'ContactPage'])->name('contact');
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

    // Routes untuk quick actions
    Route::resource('news', NewsController::class)->names('admin.news');
    Route::resource('events', ScheduleController::class)->names('admin.events');
    Route::resource('programs', ProgramController::class)->names('admin.programs');
    Route::resource('registrations', RegisterOnlineController::class)->names('admin.registrations');

    // News CRUD
    Route::resource('news', NewsController::class)->names([
        'index'   => 'admin-news.index',
        'create'  => 'admin-news.create',
        'store'   => 'admin-news.store',
        'show'    => 'admin-news.show',
        'edit'    => 'admin-news.edit',
        'update'  => 'admin-news.update',
        'destroy' => 'admin-news.destroy',
    ]);

    // Programs CRUD
    Route::resource('programs', ProgramController::class)->names([
        'index'   => 'admin-programs.index',
        'create'  => 'admin-programs.create',
        'store'   => 'admin-programs.store',
        'show'    => 'admin-programs.show',
        'edit'    => 'admin-programs.edit',
        'update'  => 'admin-programs.update',
        'destroy' => 'admin-programs.destroy',
    ]);

    // ==================== SCHEDULE ROUTES ====================

    // Main schedule index
    Route::get('schedules', [ScheduleController::class, 'mainIndex'])->name('admin.schedules.index');

    // Weekly Schedule
    Route::prefix('weekly')->group(function () {
        Route::get('/', [ScheduleController::class, 'weeklyIndex'])->name('admin.weekly.index');
        Route::get('/create', [ScheduleController::class, 'weeklyCreate'])->name('admin.weekly.create');
        Route::post('/', [ScheduleController::class, 'weeklyStore'])->name('admin.weekly.store');
        Route::get('/{weeklyId}/edit', [ScheduleController::class, 'weeklyEdit'])->name('admin.weekly.edit');
        Route::put('/{weeklyId}', [ScheduleController::class, 'weeklyUpdate'])->name('admin.weekly.update');
        Route::delete('/{weeklyId}', [ScheduleController::class, 'weeklyDestroy'])->name('admin.weekly.destroy');
        Route::post('/bulk-delete', [ScheduleController::class, 'weeklyBulkDestroy'])->name('admin.weekly.bulk-destroy');
        Route::get('/search', [ScheduleController::class, 'weeklySearch'])->name('admin.weekly.search');
    });

    // Event Schedule
    Route::prefix('events')->group(function () {
        Route::get('/', [ScheduleController::class, 'eventIndex'])->name('admin.events.index');
        Route::get('/create', [ScheduleController::class, 'eventCreate'])->name('admin.events.create');
        Route::post('/', [ScheduleController::class, 'eventStore'])->name('admin.events.store');
        Route::get('/{eventId}/edit', [ScheduleController::class, 'eventEdit'])->name('admin.events.edit');
        Route::put('/{eventId}', [ScheduleController::class, 'eventUpdate'])->name('admin.events.update');
        Route::get('/{eventId}', [ScheduleController::class, 'eventShow'])->name('admin.events.show');
        Route::delete('/{eventId}', [ScheduleController::class, 'eventDestroy'])->name('admin.events.destroy');
        Route::post('/bulk-delete', [ScheduleController::class, 'eventBulkDestroy'])->name('admin.events.bulk-destroy');
        Route::get('/search', [ScheduleController::class, 'eventSearch'])->name('admin.events.search');
    });

    // Quote Schedule
    Route::prefix('quotes')->group(function () {
        Route::get('/', [ScheduleController::class, 'quoteIndex'])->name('admin.quotes.index');
        Route::get('/create', [ScheduleController::class, 'quoteCreate'])->name('admin.quotes.create');
        Route::post('/', [ScheduleController::class, 'quoteStore'])->name('admin.quotes.store');
        Route::get('/{quoteId}/edit', [ScheduleController::class, 'quoteEdit'])->name('admin.quotes.edit');
        Route::put('/{quoteId}', [ScheduleController::class, 'quoteUpdate'])->name('admin.quotes.update');
        Route::get('/{quoteId}', [ScheduleController::class, 'quoteShow'])->name('admin.quotes.show');
        Route::delete('/{quoteId}', [ScheduleController::class, 'quoteDestroy'])->name('admin.quotes.destroy');
        Route::post('/bulk-delete', [ScheduleController::class, 'quoteBulkDestroy'])->name('admin.quotes.bulk-destroy');
        Route::get('/search', [ScheduleController::class, 'quoteSearch'])->name('admin.quotes.search');
    });

    // Footer CRUD
    Route::resource('footer', FooterController::class)->names([
        'index'   => 'admin.footer.index',
        'create'  => 'admin.footer.create',
        'store'   => 'admin.footer.store',
        'edit'    => 'admin.footer.edit',
        'update'  => 'admin.footer.update',
        'destroy' => 'admin.footer.destroy',
    ])->middleware('auth');
});

// Register Online CRUD (tanpa edit)
Route::prefix('admin-register-online')->middleware('auth')->group(function () {
    Route::get('/', [RegisterOnlineController::class, 'index'])->name('admin.admin-register-online.index');
    Route::get('/{id}', [RegisterOnlineController::class, 'show'])->name('admin.admin-register-online.show');
    Route::post('/{id}/approve', [RegisterOnlineController::class, 'approve'])->name('admin.admin-register-online.approve');
    Route::delete('/{id}', [RegisterOnlineController::class, 'destroy'])->name('admin.admin-register-online.destroy');
});

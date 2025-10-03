<?php

use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

// View Page User
Route::get('/', [ViewController::class, 'HomePage'])->name('home');
Route::get('/program', [ViewController::class, 'ProgramPage'])->name('program');
Route::get('/schedule', [ViewController::class, 'SchedulePage'])->name('schedule');
Route::get('/register-online', [ViewController::class, 'RegistrationPage'])->name('register-online');
Route::get('/contact', [ViewController::class, 'ContactPage'])->name('contact');
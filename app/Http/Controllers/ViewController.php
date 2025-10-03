<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function HomePage() {
        return view('home');
    }

    public function ProgramPage() {
        return view('program');
    }

    public function SchedulePage() {
        return view('schedule');
    }

    public function RegistrationPage() {
        return view('register-online');
    }

    public function ContactPage() {
        return view('contact');
    }
}

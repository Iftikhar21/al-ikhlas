<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function LoginPage()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function actionlogin(Request $request)
    {
        $maxAttempts = 5;
        $decaySeconds = 34;
        $throttleKey = $request->ip();

        // Cek limit login attempt
        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->with('error', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $seconds . ' detik.');
        }

        // Validasi input (boleh email atau username)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            RateLimiter::hit($throttleKey, $decaySeconds);

            $error = User::where('email', $request->email)->exists()
                ? 'Password salah'
                : 'Email tidak terdaftar';

            return back()->withInput($request->only('email'))->with('error', $error);
        }

        // Berhasil login → reset limiter
        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Selamat datang, ' . Auth::user()->name . ' !');
    }

    public function actionlogout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('login')->with('success', 'Anda telah berhasil logout.');
    }
}

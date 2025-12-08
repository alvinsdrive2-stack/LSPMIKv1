<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class LoginRateLimiter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $email = $request->input('email');
        $ipAddress = $request->ip();

        // Key untuk session
        $attemptKey = 'login_attempts_' . md5($email . $ipAddress);
        $blockedKey = 'login_blocked_' . md5($email . $ipAddress);

        // Cek apakah user sedang diblokir
        if (Session::has($blockedKey)) {
            $blockedUntil = Session::get($blockedKey);
            $now = Carbon::now();

            if ($now->lt($blockedUntil)) {
                // Masih dalam waktu block
                $remainingTime = $now->diffInSeconds($blockedUntil);
                return redirect()->back()
                    ->with('error', 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . $remainingTime . ' detik.')
                    ->with('blocked', true)
                    ->with('remaining_time', $remainingTime);
            } else {
                // Block time sudah habis, reset counter
                Session::forget($attemptKey);
                Session::forget($blockedKey);
            }
        }

        // Simpan attempt sebelum proses login
        Session::put($attemptKey, Session::get($attemptKey, 0) + 1);

        $response = $next($request);

        // Jika login gagal
        if ($response->isRedirect() && Session::has('error')) {
            $attempts = Session::get($attemptKey, 0);

            // Jika sudah 3 kali percobaan, block selama 5 menit
            if ($attempts >= 3) {
                $blockedUntil = Carbon::now()->addMinutes(5);
                Session::put($blockedKey, $blockedUntil);

                return redirect()->back()
                    ->with('error', 'Terlalu banyak percobaan login. Akun diblokir selama 5 menit.')
                    ->with('blocked', true)
                    ->with('blocked_until', $blockedUntil->timestamp);
            }

            // Update pesan error dengan sisa percobaan
            $remaining = 3 - $attempts;
            if ($remaining > 0) {
                Session::flash('error', 'Email atau password salah. Sisa percobaan: ' . $remaining);
                Session::flash('attempts', $attempts);
                Session::flash('max_attempts', 3);
            }
        }

        // Jika login berhasil, reset counter
        if ($response->isRedirect() && !Session::has('error')) {
            Session::forget($attemptKey);
            Session::forget($blockedKey);
        }

        return $response;
    }
}
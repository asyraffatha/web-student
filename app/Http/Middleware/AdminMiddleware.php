<?php
// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Check if user is admin
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Akses ditolak. Hanya admin yang diizinkan mengakses halaman ini.');
        }


        // Check if admin account is active
        if (!Auth::user()->is_active) {
        Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Anda telah dinonaktifkan. Hubungi administrator.');
        }

        return $next($request);
    }
}
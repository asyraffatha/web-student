<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Cek dulu user berdasarkan email
    $user = \App\Models\User::where('email', $request->email)->first();

    // Jika tidak ditemukan user
    if (!$user) {
        throw ValidationException::withMessages([
            'email' => __('Email tidak ditemukan.'),
        ]);
    }

    // Cek role yang diizinkan (misalnya dari URL login)
    // Misal, kamu tambahkan hidden input atau pakai route berbeda
    $expectedRole = $request->input('role'); // misal: 'siswa' atau 'guru'

    // Jika role tidak cocok
    if ($user->role !== $expectedRole) {
        throw ValidationException::withMessages([
            'email' => __('Anda tidak diizinkan login sebagai ' . $expectedRole . '.'),
        ]);
    }

    // Proses login jika semua cocok
    if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
        throw ValidationException::withMessages([
            'email' => __('Email atau password salah.'),
        ]);
    }

    $request->session()->regenerate();

    // Redirect sesuai role
    if ($user->role === 'guru') {
        return redirect()->intended(route('guru.dashboard'));
    } elseif ($user->role === 'siswa') {
        return redirect()->intended(route('siswa.dashboard'));
    }
      elseif ($user->role === 'admin') {
        return redirect()->intended(route('admin.dashboard'));
    }
    

    // Default fallback
    return redirect()->intended('/');
}



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

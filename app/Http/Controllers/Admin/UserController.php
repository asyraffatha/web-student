<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['siswa', 'guru'])->get();
        return view('admin.user.index', compact('users'));
    }

    public function create() {
    $allKelas = Kelas::all();
    return view('admin.user.create', compact('allKelas'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role'     => 'required|in:siswa,guru',
        'kelas'    => 'nullable|array',
    ]);

    // Buat user terlebih dahulu
    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => $request->role,
    ]);

    // Jika guru, simpan ke tabel pivot guru_kelas
    if ($request->role === 'guru' && $request->filled('kelas')) {
        $user->kelasDiampu()->sync($request->kelas); // Pastikan relasi kelasDiampu() sudah ada di model User
    }

    // Jika siswa, simpan ke kolom kelas_id (pastikan kolom ini ada di tabel users)
    if ($request->role === 'siswa' && $request->filled('kelas')) {
        $user->kelas_id = $request->kelas[0]; // Ambil satu kelas saja
        $user->save();
    }

    return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }
}


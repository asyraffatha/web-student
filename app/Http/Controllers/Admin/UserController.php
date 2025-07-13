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
        $users = User::whereIn('role', ['siswa', 'guru','admin'])->get();
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
        'role'     => 'required|in:siswa,guru,admin',
        'kelas'    => 'nullable',
    ]);

    // Buat user terlebih dahulu
    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => $request->role,
    ]);

    // Jika guru, simpan ke tabel pivot guru_kelas
    if ($request->role === 'guru' && is_array($request->kelas)) {
    $user->kelasDiampu()->sync($request->kelas);
}

    // Jika siswa, simpan ke kolom kelas_id (pastikan kolom ini ada di tabel users)
    if ($request->role === 'siswa' && $request->filled('kelas')) {
    $kelasTerpilih = Kelas::find($request->kelas); // Ambil nama kelas berdasarkan ID
    $user->kelas = $kelasTerpilih ? $kelasTerpilih->nama : null;
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

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $allKelas = Kelas::all();
        $kelasDipilih = $user->kelasDiampu->pluck('id')->toArray();

        return view('admin.user.edit', compact('user', 'allKelas', 'kelasDipilih'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role'     => 'required|in:siswa,guru,admin',
            'kelas'    => 'nullable',
    ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->role = $request->role;

        if ($request->role === 'guru') {
            $user->kelasDiampu()->sync($request->kelas ?? []);
            $user->kelas = null;
        } elseif ($request->role === 'siswa') {
            $kelas = Kelas::find($request->kelas);
            $user->kelas = $kelas ? $kelas->nama : null;
            $user->kelasDiampu()->detach();
        } else {
            $user->kelas = null;
            $user->kelasDiampu()->detach();
        }

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

}


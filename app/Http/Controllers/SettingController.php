<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingController extends Controller
{
    public function form()
    {
        return view('information.setting');
    }

  public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'nisn' => 'required|unique:settings,nisn,' . Auth::id() . ',user_id',
        'kelas' => 'required',
        'tgl_lahir' => 'required|date',
        'alamat' => 'required',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $setting = Setting::where('user_id', Auth::id())->first();
    $path = $setting?->foto;

    if ($request->hasFile('foto')) {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/foto-profile', $filename);
        $path = 'foto-profile/' . $filename;

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->foto = $path;
        $user->save();
    }

    if ($setting) {
        // 🔄 UPDATE jika sudah ada
        $setting->update([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $path,
        ]);
    } else {
        // 🆕 CREATE jika belum ada
        Setting::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $path,
        ]);
    }

    return redirect()->route('setting.information')->with('success', 'Data berhasil disimpan.');
}

    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);

        // Hapus file foto jika ada
        if ($setting->foto && Storage::disk('public')->exists($setting->foto)) {
            Storage::disk('public')->delete($setting->foto);
        }

        $setting->delete();

        return redirect('home')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function information()
    {
          /** @var \App\Models\User $user */
    $user = Auth::user();
    $setting = $user->setting;
        return view('information.information', compact('setting'));
    }

    public function home()
    {
        return view('home');
    }

    public function edit($id)
{
    $setting = Setting::findOrFail($id);
    return view('information.edit', compact('setting'));
}

public function update(Request $request, $id)
{
    $setting = Setting::findOrFail($id);

    $request->validate([
        'nama' => 'required',
        'nisn' => 'required|unique:settings,nisn,' . $id,
        'kelas' => 'required',
        'tgl_lahir' => 'required|date',
        'alamat' => 'required',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Jika ada foto baru, simpan dan hapus foto lama
    if ($request->hasFile('foto')) {
        if ($setting->foto && Storage::disk('public')->exists($setting->foto)) {
            Storage::disk('public')->delete($setting->foto);
        }

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/foto-profile', $filename);
        $setting->foto = 'foto-profile/' . $filename;

        // Simpan juga ke user jika perlu
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->foto = $setting->foto;
        $user->save();
    }

    $setting->update([
        'nama' => $request->nama,
        'nisn' => $request->nisn,
        'kelas' => $request->kelas,
        'tgl_lahir' => $request->tgl_lahir,
        'alamat' => $request->alamat,
        'jenis_kelamin' => $request->jenis_kelamin,
    ]);

    return redirect()->route('setting.information')->with('success', 'Data berhasil diperbarui.');
}

}

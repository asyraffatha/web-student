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
        'nisn' => 'required|unique:settings',
        'kelas' => 'required',
        'tgl_lahir' => 'required|date',
        'alamat' => 'required',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $path = null;

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/foto-profile', $filename);
        $path = 'foto-profile/' . $filename;

        $user = User::find(Auth::id());
        if ($user) {
            $user->foto = $path;
            $user->save();
        }
    }

    Setting::create([
        'user_id' => Auth::id(), // ⬅️ WAJIB
        'nama' => $request->nama,
        'nisn' => $request->nisn,
        'kelas' => $request->kelas,
        'tgl_lahir' => $request->tgl_lahir,
        'alamat' => $request->alamat,
        'jenis_kelamin' => $request->jenis_kelamin,
        'foto' => $path,
    ]);

    return redirect('/setting/information')->with('success', 'Data berhasil disimpan.');
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
}

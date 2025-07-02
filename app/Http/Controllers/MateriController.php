<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    // Menampilkan semua materi untuk guru
    public function index()
    {
        $guru = Auth::user();
        $kelasDiampu = $guru->kelasDiampu;
        $materis = Materi::whereIn('kelas', $kelasDiampu->pluck('id'))->get();
        return view('Guru.managematerial', compact('materis', 'kelasDiampu'));
    }

    // Halaman form tambah materi
    public function create()
    {
        $guru = Auth::user();
        $kelasDiampu = $guru->kelasDiampu;
        $materis = Materi::whereIn('kelas', $kelasDiampu->pluck('id'))->get(); // <-- filter sesuai kelas diampu
        return view('Guru.managematerial', compact('materis', 'kelasDiampu'));  
    }

    // Proses menyimpan materi baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kelas' => 'required',
            'deskripsi' => 'required',
            'file' => 'required|mimes:pdf,docx,doc,pptx|max:2048',
        ]);

        $path = $request->file('file')->store('materi', 'public');

        Materi::create([
            'judul' => $request->judul,
            'kelas' => $request->kelas,
            'deskripsi' => $request->deskripsi,
            'file_path' => $path,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    // List materi untuk siswa
    public function listSiswa()
    {
        // Ambil nama kelas dari user (misal: "8.1")
        $kelasNama = Auth::user()->kelas;

        // Cari ID kelas yang sesuai
        $kelasObj = \App\Models\Kelas::where('nama', $kelasNama)->first();

        // Jika kelas ditemukan, ambil materi berdasarkan ID kelas
        if ($kelasObj) {
            $materis = Materi::where('kelas', $kelasObj->id)->get();
        } else {
            $materis = collect(); // kosongkan jika tidak ada kelas
        }

        return view('list-of-material', compact('materis'));
    }

    public function destroy($id)
    {
    $materi = Materi::findOrFail($id);

    // Hapus file dari storage jika ada
    if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
        Storage::disk('public')->delete($materi->file_path);
    }

    $materi->delete();

    return redirect()->back()->with('success', 'Materi berhasil dihapus!');
    }

   public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        $guru = Auth::user();
        $kelasDiampu = $guru->kelasDiampu; // relasi di model User
        return view('Guru.editmateri', compact('materi', 'kelasDiampu'));
    }

    public function update(Request $request, $id)   
    {
    $materi = Materi::findOrFail($id);

    $request->validate([
        'judul' => 'required',
        'kelas' => 'required',
        'deskripsi' => 'required',
        'deadline' => 'nullable|date',
        'file' => 'nullable|file|mimes:pdf,docx,pptx|max:2048'
    ]);

    $materi->judul = $request->judul;
    $materi->kelas = $request->kelas;
    $materi->deskripsi = $request->deskripsi;
    $materi->deadline = $request->deadline;

    if ($request->hasFile('file')) {
        // Hapus file lama
        if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
            Storage::disk('public')->delete($materi->file_path);
        }

        $materi->file_path = $request->file('file')->store('materi', 'public');
    }

    $materi->save();

    return redirect()->route('materi.create')->with('success', 'Materi berhasil diperbarui.');
    }
}

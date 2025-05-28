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
        $materis = Materi::where('kelas', Auth::user()->kelas)->get();
        return view('guru.managematerial', compact('materis'));
    }

    // Halaman form tambah materi
    public function create()
    {
         $materis = Materi::latest()->get(); // untuk ditampilkan setelah form
         return view('guru.managematerial', compact('materis'));
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
    $kelas = Auth::user()->kelas;
    $materis = Materi::where('kelas', $kelas)->get(); // hanya tampilkan materi sesuai kelas user
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
    return view('guru.editmateri', compact('materi'));
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

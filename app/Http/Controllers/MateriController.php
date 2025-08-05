<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Services\GamificationService;

class MateriController extends Controller
{
    protected $gamificationService;

    public function __construct(GamificationService $gamificationService)
    {
        $this->gamificationService = $gamificationService;
    }

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
        $user = Auth::user();
        $kelasNama = $user->kelas;

        // Cari ID kelas yang sesuai
        $kelasObj = \App\Models\Kelas::where('nama', $kelasNama)->first();

        if ($kelasObj) {
            $materis = Materi::where('kelas', $kelasObj->id)->get();

            // Progress belajar berdasarkan quiz saja
            $totalQuiz = \App\Models\Quiz::where('kelas', $kelasObj->id)->count();
            $quizSelesai = \App\Models\QuizResult::where('user_id', $user->id)->whereNotNull('score')->count();
            $progress = $totalQuiz > 0 ? round(($quizSelesai / $totalQuiz) * 100) : 0;
        } else {
            $materis = collect();
            $progress = 0;
        }

        return view('list-of-material', compact('materis', 'progress'));
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

    /**
     * Mark material as completed and award points
     */
    public function markAsCompleted(Request $request, $id)
    {
        $user = Auth::user();
        $materi = Materi::findOrFail($id);
        
        // Determine material type based on file extension or content
        $materialType = $this->determineMaterialType($materi->file_path);
        
        try {
            // Award points for material completion
            $history = $this->gamificationService->awardMaterialPoints($user, $materialType);
            
            // Check for badges
            $awardedBadges = $this->gamificationService->checkAndAwardBadges($user);
            
            // Store completion info
            $completionInfo = [
                'materi_id' => $materi->id,
                'materi_title' => $materi->judul,
                'material_type' => $materialType,
                'points_earned' => $history ? $history->points_earned : 0,
                'experience_earned' => $history ? ($history->metadata['experience_earned'] ?? 0) : 0,
                'level_up' => $history ? ($history->metadata['level_up'] ?? false) : false,
                'awarded_badges' => $awardedBadges
            ];
            
            session()->flash('material_completion_info', $completionInfo);
            
            if (count($awardedBadges) > 0) {
                session()->flash('new_badges', $awardedBadges);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Materi berhasil ditandai sebagai selesai!',
                'completion_info' => $completionInfo
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai materi sebagai selesai: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Determine material type based on file extension
     */
    private function determineMaterialType($filePath): string
    {
        if (!$filePath) {
            return 'regular';
        }
        
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        return match($extension) {
            'pdf', 'docx', 'doc' => 'document',
            'pptx', 'ppt' => 'presentation',
            'mp4', 'avi', 'mov' => 'video',
            'html', 'htm' => 'interactive',
            default => 'regular'
        };
    }

    /**
     * Get material completion reward info
     */
    public function getMaterialRewardInfo($materialType = 'regular'): array
    {
        $basePoints = match($materialType) {
            'video' => 20,
            'document' => 30,
            'interactive' => 40,
            'presentation' => 25,
            default => 25
        };
        
        $baseExperience = match($materialType) {
            'video' => 30,
            'document' => 40,
            'interactive' => 60,
            'presentation' => 35,
            default => 35
        };
        
        return [
            'material_type' => $materialType,
            'base_points' => $basePoints,
            'base_experience' => $baseExperience,
            'description' => $this->getMaterialTypeDescription($materialType)
        ];
    }

    /**
     * Get material type description
     */
    private function getMaterialTypeDescription($materialType): string
    {
        return match($materialType) {
            'video' => 'Video Pembelajaran',
            'document' => 'Dokumen Pembelajaran',
            'interactive' => 'Materi Interaktif',
            'presentation' => 'Presentasi',
            default => 'Materi Pembelajaran'
        };
    }
}

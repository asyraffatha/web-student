<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi</title>
    @vite('resources/css/app.css')
    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .file-input:hover::file-selector-button {
            background-color: #dbeafe;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen font-sans">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-md">
        <div class="max-w-5xl mx-auto py-4 px-6">
            <h1 class="text-2xl font-bold">Mathporia</h1>
        </div>
    </header>

    <div class="max-w-5xl mx-auto mt-8 mb-16 px-6">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 mb-6 text-sm">
            <a href="{{ route('guru.dashboard') }}"
                class="text-blue-600 hover:text-blue-800 font-medium transition duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard Guru
            </a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-800 font-medium">Tambah Materi</span>
        </div>

        <!-- Main Content -->
        <div class="bg-white shadow-xl rounded-xl overflow-hidden animate-fade-in">
            <!-- Header section -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b">
                <h2 class="text-2xl font-bold text-gray-800">Tambah Materi Baru</h2>
                <p class="text-gray-600 mt-1">Unggah dan kelola materi pembelajaran untuk siswa</p>
            </div>

            <div class="p-6">
                {{-- Notifikasi sukses --}}
                @if (session('success'))
                    <div
                        class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-800 rounded-r flex items-center animate-fade-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r animate-fade-in">
                        <div class="flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="font-medium">Mohon periksa kembali formulir Anda:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm ml-6">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form tambah materi --}}
                <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul
                                Materi</label>
                            <input type="text" name="judul" id="judul"
                                class="block w-full border border-gray-300 rounded-lg px-4 py-3 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="Masukkan judul materi" required>
                        </div>

                        <div>
                            <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                            <select name="kelas" id="kelas"
                                class="block w-full border border-gray-300 rounded-lg px-4 py-3 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition appearance-none bg-white"
                                required>
                                <option value="">Pilih Kelas</option>
                                @for ($tingkat = 7; $tingkat <= 9; $tingkat++)
                                    @for ($sub = 1; $sub <= 9; $sub++)
                                        <option value="{{ $tingkat . '.' . $sub }}">Kelas {{ $tingkat . '.' . $sub }}
                                        </option>
                                    @endfor
                                @endfor
                            </select>

                        </div>
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="block w-full border border-gray-300 rounded-lg px-4 py-3 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Jelaskan secara singkat tentang materi ini" required></textarea>
                    </div>

                    <div>
                        <label for="deadline">Deadline</label>
                        <input type="datetime-local" name="deadline" required
                            class="form-input rounded-lg border border-gray-300 px-3 py-2 w-full"
                            value="{{ old('deadline') }}">
                    </div>

                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 bg-gray-50 hover:bg-gray-100 transition text-center">
                        <label for="file" class="block mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400 mb-2"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <span class="block text-sm font-medium text-gray-700 mb-1">Upload File</span>
                            <span class="text-xs text-gray-500">PDF, DOCX, atau PPTX (Max: 2MB)</span>
                        </label>
                        <input type="file" name="file" id="file"
                            class="file-input w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700 cursor-pointer"
                            required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition shadow-md">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Simpan Materi
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Materi yang sudah diupload -->
        <div class="mt-12 animate-fade-in">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">Materi yang Sudah Diupload</h3>
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                    Total: {{ count($materis) }}
                </span>
            </div>

            <div class="space-y-4">
                @forelse ($materis as $materi)
                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                        <div class="p-5">
                            <div class="flex justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <span
                                            class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-medium mr-2">Kelas
                                            {{ $materi->kelas }}</span>
                                        <span
                                            class="text-gray-500 text-sm">{{ $materi->created_at->format('d M Y') }}</span>
                                    </div>
                                    <h4 class="text-lg font-bold text-gray-800">{{ $materi->judul }}</h4>
                                    <p class="text-gray-600 mt-1 mb-3">{{ $materi->deskripsi }}</p>

                                    <div class="flex items-center">
                                        @if ($materi->file_path)
                                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                                class="flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Lihat File
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="ml-4 flex items-start">
                                    {{-- Form delete --}}
                                    <form action="{{ route('materi.destroy', $materi->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-gray-200 rounded-xl p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-gray-500 mb-2">Belum ada materi yang diunggah.</p>
                        <p class="text-gray-400 text-sm">Mulai tambahkan materi dengan mengisi formulir di atas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-400 text-sm">
        <div class="max-w-5xl mx-auto py-4 px-6">
            <p>© {{ date('Y') }} Portal Pembelajaran. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>

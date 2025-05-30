<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pilih Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-6 space-y-6">

        <!-- Tombol Kembali -->
        <div>
            <a href="{{ route('guru.dashboard') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-white text-blue-600 border border-blue-500 rounded-lg shadow hover:bg-blue-50 transition">
                ⬅️ Kembali ke Dashboard Guru
            </a>
        </div>

        <!-- Judul -->
        <h2 class="text-2xl font-bold text-gray-800 text-center">
            👥 Pilih Siswa untuk Diskusi
        </h2>

        <!-- Daftar Siswa -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse ($students as $student)
                <a href="{{ route('discussion.show', $student->id) }}"
                    class="group block p-4 bg-blue-50 hover:bg-blue-100 rounded-lg shadow transition duration-200 border border-transparent hover:border-blue-400">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-blue-500 text-white flex items-center justify-center rounded-full text-sm font-bold group-hover:scale-105 transform transition">
                            {{ strtoupper(substr($student->name, 0, 2)) }}
                        </div>
                        <span class="text-blue-700 font-medium group-hover:underline">
                            {{ $student->name }}
                        </span>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-500 col-span-full">Tidak ada siswa di kelas Anda.</p>
            @endforelse
        </div>
    </div>
</body>

</html>

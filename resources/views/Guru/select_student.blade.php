<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pilih Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bg-gradient {
            background: linear-gradient(135deg, #dbeafe, #fef3c7);
        }
    </style>
</head>

<body class="bg-gradient min-h-screen flex items-center justify-center px-4 py-10 font-sans">

    <div class="w-full max-w-2xl bg-white rounded-xl shadow-xl p-6 space-y-6 fade-in">

        <!-- Tombol Kembali -->
        <div>
            <a href="{{ route('guru.dashboard') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-white text-blue-600 border border-blue-500 rounded-lg shadow hover:bg-blue-50 transition">
                ⬅️ Kembali ke Dashboard Guru
            </a>
        </div>

        <!-- Judul -->
        <h2 class="text-3xl font-extrabold text-gray-800 text-center">
            👥 Pilih Siswa untuk Diskusi
        </h2>

        <!-- Daftar Siswa -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            @forelse ($students as $student)
                <a href="{{ route('discussion.show', $student->id) }}"
                    class="group p-4 bg-white hover:bg-yellow-100 border border-transparent hover:border-yellow-400 rounded-xl shadow hover:shadow-lg transition duration-300 transform hover:scale-[1.03] fade-in">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-12 h-12 bg-blue-500 text-white rounded-full flex items-center justify-center text-lg font-bold group-hover:scale-110 transition-all duration-200">
                            {{ strtoupper(substr($student->name, 0, 2)) }}
                        </div>
                        <div class="flex-1">
                            <p class="text-lg font-semibold text-gray-700 group-hover:text-yellow-700">
                                {{ $student->name }}
                            </p>
                            <p class="text-xs text-gray-500">Klik untuk mulai diskusi</p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-500 col-span-full">Tidak ada siswa di kelas Anda.</p>
            @endforelse
        </div>
    </div>

</body>

</html>

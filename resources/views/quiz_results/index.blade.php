<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kuis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen py-10 px-6">

    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">📜 Riwayat Nilai Kuis</h1>

        @if ($results->isEmpty())
            <div class="text-center mt-20">
                <p class="text-xl text-white opacity-80 mb-4">Belum ada kuis yang dikerjakan.</p>
                <div class="text-6xl">📭</div>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($results as $result)
                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold">{{ $result->quiz->title }}</h2>
                        @if ($result->completed_at)
                            <p class="text-sm opacity-80 mb-1">📅 Selesai:
                                {{ \Carbon\Carbon::parse($result->completed_at)->translatedFormat('l, d F Y H:i') }}</p>
                        @endif
                        <p class="text-sm opacity-80">🎯 Nilai: <span class="font-bold">{{ $result->score }}</span></p>
                        <p class="text-sm">
                            Status:
                            @if ($result->score >= $result->quiz->passing_score)
                                <span class="text-green-400 font-semibold">✅ Lulus</span>
                            @else
                                <span class="text-red-400 font-semibold">❌ Tidak Lulus</span>
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-10 text-center">
            <a href="{{ url()->previous() }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full transition">⬅
                Kembali</a>
        </div>
    </div>

</body>

</html>

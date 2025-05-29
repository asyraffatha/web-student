<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kuis Tersedia</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-6">

    <h1 class="text-2xl font-bold mb-6">Daftar Kuis</h1>

    @if ($quizzes->isEmpty())
        <p class="text-gray-600">Belum ada kuis tersedia.</p>
    @else
        <div class="space-y-4">
            @foreach ($quizzes as $quiz)
                <div class="p-4 bg-white rounded shadow">
                    <h2 class="text-lg font-semibold text-blue-700">{{ $quiz->title }}</h2>
                    @if ($quiz->deadline)
                        <p class="text-sm text-gray-500 mb-2">🕒 Deadline:
                            {{ \Carbon\Carbon::parse($quiz->deadline)->translatedFormat('l, d F Y H:i') }}</p>
                    @endif
                    <p class="text-sm text-gray-600">Passing Score: {{ $quiz->passing_score }}</p>
                    @if ($results->has($quiz->id))
                        <p class="text-sm">Skor: {{ $results[$quiz->id]->score }} -
                            @if ($results[$quiz->id]->passed)
                                <span class="text-green-600">✅ Lulus</span>
                            @else
                                <span class="text-red-600">❌ Tidak Lulus</span>
                                <a href="{{ route('quizzes.show', $quiz->id) }}"
                                    class="text-blue-600 hover:underline ml-2">Coba Lagi</a>
                            @endif
                        </p>
                    @else
                        <a href="{{ route('quizzes.show', $quiz->id) }}"
                            class="text-blue-600 hover:underline text-sm">Kerjakan Kuis</a>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

</body>

</html>

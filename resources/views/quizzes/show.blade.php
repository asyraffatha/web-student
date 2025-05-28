<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $quiz->title }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 py-10">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $quiz->title }}</h1>
        <p class="mb-6 text-sm text-gray-500">Passing Score: {{ $quiz->passing_score }}</p>

        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
            @csrf

            @foreach ($quiz->questions as $index => $question)
                <div class="mb-6 p-4 border rounded-md bg-gray-50">
                    <p class="font-semibold text-gray-700 mb-2">
                        {{ $index + 1 }}. {{ $question->question }}
                    </p>

                    @php
                        $options = $question->options;
                        $optionLabels = ['A', 'B', 'C', 'D'];
                    @endphp

                    <div class="space-y-2">
                        @foreach ($options as $i => $option)
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="answers[{{ $question->id }}]"
                                    value="{{ $optionLabels[$i] }}" class="text-blue-600" required>
                                <span>{{ $optionLabels[$i] }}. {{ $option }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="text-right">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                    Kirim Jawaban
                </button>
            </div>
        </form>
    </div>

</body>

</html>

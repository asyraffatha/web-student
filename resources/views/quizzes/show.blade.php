<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $quiz->title }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 py-10">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <div class="mb-6">
            <a href="{{ route('quizzes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>

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
                <div class="mb-8 p-4 border rounded-md bg-gray-50">
                    <p class="font-semibold text-gray-700 mb-4 text-lg">
                        {{ $index + 1 }}. {{ $question->question }}
                    </p>
                    @if($question->image)
                        <div class="mb-4 flex justify-center">
                            <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Pertanyaan" class="max-w-md rounded-lg shadow-md">
                        </div>
                    @endif
                    @if($question->video)
                        <div class="mb-4 flex justify-center">
                            <video controls class="max-w-md rounded-lg shadow-md">
                                <source src="{{ asset('storage/' . $question->video) }}" type="video/mp4">
                                Browser Anda tidak mendukung video.
                            </video>
                        </div>
                    @endif
                    <!-- Opsi jawaban grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        @php
                            $optionColors = ['bg-red-500','bg-blue-600','bg-yellow-400','bg-green-600'];
                            $optionIcons = ['▲','◆','■','✔'];
                        @endphp
                        @foreach ($question->options as $i => $option)
                            <label class="relative flex flex-col items-center justify-center p-0 rounded-xl shadow-lg cursor-pointer transition-transform hover:scale-105 {{$optionColors[$i]}} text-white min-h-[160px]">
                                <div class="absolute left-2 top-2 text-2xl opacity-80">{{$optionIcons[$i]}}</div>
                                <div class="absolute right-2 top-2">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ ['A', 'B', 'C', 'D'][$i] }}" class="form-radio w-6 h-6 text-white bg-white border-white focus:ring-2 focus:ring-white" required>
                                </div>
                                @if(isset($question->options_images[$i]))
                                    <img src="{{ asset('storage/' . $question->options_images[$i]) }}" alt="Gambar Opsi" class="w-full h-32 object-contain rounded-t-xl mb-2 bg-white">
                                @endif
                                <span class="block w-full text-center text-lg font-semibold px-2 pb-4 pt-2 bg-opacity-70">{{ $option }}</span>
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

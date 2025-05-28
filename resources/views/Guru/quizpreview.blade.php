<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Preview Kuis</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            transition: transform 0.3s ease;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-shadow {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .option-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .option-card:hover {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            transform: translateX(10px);
        }

        .correct-answer {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border: 2px solid #22c55e;
        }

        .question-counter {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
    </style>
</head>

<body class="min-h-screen gradient-bg p-4">
    <div class="max-w-5xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white rounded-2xl card-shadow p-8 mb-8 fade-in-up hover-lift">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-clipboard-list text-blue-600 mr-4"></i>
                        Preview Kuis
                    </h1>
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">{{ $quiz->title }}</h2>
                </div>
                <div class="text-center">
                    <div class="bg-gradient-to-r from-green-400 to-green-600 text-white px-6 py-3 rounded-xl shadow-lg">
                        <i class="fas fa-trophy text-xl mb-2"></i>
                        <p class="text-sm font-medium">Passing Score</p>
                        <p class="text-2xl font-bold">{{ $quiz->passing_score }}</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center text-gray-600 space-x-6">
                <div class="flex items-center">
                    <i class="fas fa-question-circle text-blue-500 mr-2"></i>
                    <span class="font-medium">{{ count($quiz->questions) }} Pertanyaan</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock text-green-500 mr-2"></i>
                    <span class="font-medium">Estimasi: {{ count($quiz->questions) * 2 }} menit</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-star text-yellow-500 mr-2"></i>
                    <span class="font-medium">Preview Mode</span>
                </div>
            </div>
        </div>

        <!-- Questions Container -->
        <div class="space-y-8">
            @foreach ($quiz->questions as $index => $question)
                <div class="bg-white rounded-2xl card-shadow p-8 fade-in-up hover-lift"
                    style="animation-delay: {{ $index * 0.1 }}s">
                    <!-- Question Header -->
                    <div class="flex items-center mb-6">
                        <div class="question-counter text-white px-4 py-2 rounded-full font-bold text-lg mr-4">
                            {{ $index + 1 }}
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            Pertanyaan {{ $index + 1 }}
                        </h2>
                    </div>

                    <!-- Question Text -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-6 border-l-4 border-blue-500">
                        <p class="text-lg text-gray-800 leading-relaxed">{{ $question->question }}</p>
                    </div>

                    <!-- Options -->
                    <div class="space-y-3 mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-list-ul text-blue-500 mr-2"></i>
                            Pilihan Jawaban:
                        </h3>
                        @foreach ($question->options as $optIndex => $option)
                            <div
                                class="option-card rounded-xl p-4 border-2 border-gray-200 flex items-center
                                @if (chr(65 + $optIndex) === $question->answer) correct-answer @endif">
                                <div
                                    class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold mr-4">
                                    {{ chr(65 + $optIndex) }}
                                </div>
                                <p class="text-gray-800 flex-1">{{ $option }}</p>
                                @if (chr(65 + $optIndex) === $question->answer)
                                    <div class="flex items-center text-green-600">
                                        <i class="fas fa-check-circle text-xl mr-2"></i>
                                        <span class="font-semibold">Jawaban Benar</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Correct Answer Highlight -->
                    <div class="bg-gradient-to-r from-green-100 to-green-50 border border-green-300 rounded-xl p-4">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <div>
                                <p class="text-green-800 font-semibold">Kunci Jawaban</p>
                                <p class="text-green-700">
                                    Opsi <strong>{{ $question->answer }}</strong> adalah jawaban yang benar untuk
                                    pertanyaan ini.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer Actions -->
        <div class="mt-12 bg-white rounded-2xl card-shadow p-8 fade-in-up">
            <div class="flex items-center justify-between">
                <div class="flex items-center text-gray-600">
                    <i class="fas fa-info-circle text-blue-500 mr-3 text-xl"></i>
                    <div>
                        <p class="font-semibold">Preview Mode Aktif</p>
                        <p class="text-sm">Semua jawaban benar ditampilkan untuk review</p>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <button onclick="window.print()"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center hover-lift">
                        <i class="fas fa-print mr-2"></i>
                        Cetak Preview
                    </button>

                    <a href="{{ route('quiz.list') }}"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center hover-lift">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar Quiz
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth scroll behavior
        document.addEventListener('DOMContentLoaded', function() {
            // Animate elements on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all question cards
            document.querySelectorAll('.fade-in-up').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'all 0.6s ease-out';
                observer.observe(el);
            });

            // Add click animation to option cards
            document.querySelectorAll('.option-card').forEach(card => {
                card.addEventListener('click', function() {
                    this.style.animation = 'pulse 0.3s ease-in-out';
                    setTimeout(() => {
                        this.style.animation = '';
                    }, 300);
                });
            });

            // Add floating animation to correct answers
            document.querySelectorAll('.correct-answer').forEach(answer => {
                answer.style.animation = 'pulse 2s ease-in-out infinite';
            });
        });

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                window.location.href = "{{ route('quiz.list') }}";
            }
        });
    </script>
</body>

</html>

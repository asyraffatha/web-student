<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Quiz</title>
    @vite('resources/css/app.css')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
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

        @keyframes bounce {

            0%,
            20%,
            53%,
            80%,
            100% {
                transform: translate3d(0, 0, 0);
            }

            40%,
            43% {
                transform: translate3d(0, -8px, 0);
            }

            70% {
                transform: translate3d(0, -4px, 0);
            }

            90% {
                transform: translate3d(0, -2px, 0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .slide-in {
            animation: slideIn 0.5s ease-out;
        }

        .bounce-in {
            animation: bounce 1s ease-out;
        }

        .pulse-hover:hover {
            animation: pulse 0.5s ease-in-out;
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 1px solid rgba(148, 163, 184, 0.2);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            border-color: rgba(59, 130, 246, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            box-shadow: 0 4px 14px 0 rgba(59, 130, 246, 0.25);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            box-shadow: 0 6px 20px 0 rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .icon-bounce:hover {
            animation: bounce 0.6s ease-in-out;
        }

        .success-notification {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.3);
        }

        .empty-state {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }

        .action-btn {
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .action-btn:hover::before {
            left: 100%;
        }

        .quiz-title {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="gradient-bg">
    <!-- Floating decorative elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
        <div class="absolute top-1/4 right-20 w-32 h-32 bg-blue-400/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-1/3 left-1/4 w-24 h-24 bg-purple-400/10 rounded-full blur-xl"></div>
        <div class="absolute bottom-20 right-1/3 w-16 h-16 bg-pink-400/10 rounded-full blur-lg"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto pt-10 pb-20 px-4">
        <!-- Main Container -->
        <div class="glass-effect p-8 rounded-2xl shadow-2xl fade-in">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div class="slide-in">
                    <h1
                        class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-2">
                        📚 Daftar Quiz
                    </h1>
                    <p class="text-gray-600">Kelola dan pantau semua quiz Anda dengan mudah</p>
                </div>
                <a href="{{ route('quiz.create') }}"
                    class="flex items-center gap-2 text-blue-600 hover:text-blue-800 transition-all duration-300 group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform icon-bounce" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="font-medium">Kembali ke Buat Quiz</span>
                </a>
            </div>

            <!-- Success Notification -->
            @if (session('success'))
                <div
                    class="mb-6 p-4 success-notification text-white rounded-xl shadow-lg fade-in flex items-center gap-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Add Quiz Button -->
            <div class="mb-8 text-right fade-in" style="animation-delay: 0.2s;">
                <a href="{{ route('quiz.create') }}"
                    class="btn-primary inline-flex items-center gap-2 px-6 py-3 text-white rounded-xl font-semibold transition-all duration-300 pulse-hover">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Quiz Baru
                </a>
            </div>

            <!-- Quiz List -->
            @if ($quizzes->isEmpty())
                <div class="text-center py-16 fade-in">
                    <div class="empty-state p-12 rounded-2xl shadow-lg max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum ada Quiz yang dibuat</h3>
                        <p class="text-gray-500 mb-6">Mulai buat Quiz pertama Anda untuk menguji pengetahuan siswa</p>
                        <a href="{{ route('quiz.create') }}"
                            class="btn-primary inline-flex items-center gap-2 px-6 py-3 text-white rounded-xl font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Quiz Sekarang
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    @foreach ($quizzes as $index => $quiz)
                        <div class="card-hover p-6 rounded-2xl shadow-lg fade-in flex flex-col md:flex-row justify-between items-start md:items-center gap-6"
                            style="animation-delay: {{ $index * 0.1 }}s;">
                            <!-- Quiz Info -->
                            <div class="flex-1">
                                <div class="flex items-start gap-4">
                                    <!-- Quiz Icon -->
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="text-white font-bold text-lg">{{ substr($quiz->title, 0, 1) }}</span>
                                    </div>

                                    <!-- Quiz Details -->
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold quiz-title mb-2">{{ $quiz->title }}</h2>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-gray-600">Nilai minimum: <strong
                                                        class="text-gray-800">{{ $quiz->passing_score }}</strong></span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-gray-600">Jumlah pertanyaan: <strong
                                                        class="text-gray-800">{{ $quiz->questions_count }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3 flex-shrink-0">
                                <a href="{{ route('quiz.preview', $quiz->id) }}"
                                    class="action-btn px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat
                                </a>

                                <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kuis ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="action-btn px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Statistics Panel -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 fade-in" style="animation-delay: 0.6s;">
            <div class="glass-effect p-6 rounded-2xl shadow-xl text-center card-hover">
                <div
                    class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h4 class="text-2xl font-bold text-gray-800 mb-2">{{ $quizzes->count() ?? 0 }}</h4>
                <p class="text-gray-600 font-medium">Total Quiz</p>
            </div>

            <div class="glass-effect p-6 rounded-2xl shadow-xl text-center card-hover">
                <div
                    class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                </div>
                <h4 class="text-2xl font-bold text-gray-800 mb-2">{{ $quizzes->sum('questions_count') ?? 0 }}</h4>
                <p class="text-gray-600 font-medium">Total Pertanyaan</p>
            </div>

            <div class="glass-effect p-6 rounded-2xl shadow-xl text-center card-hover">
                <div
                    class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h4 class="text-2xl font-bold text-gray-800 mb-2">
                    {{ number_format($quizzes->avg('passing_score') ?? 0, 0) }}%</h4>
                <p class="text-gray-600 font-medium">Rata-rata Passing Score</p>
            </div>
        </div>
    </div>

    <script>
        // Add loading animation
        document.addEventListener('DOMContentLoaded', function() {
            // Stagger animation for quiz cards
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('.action-btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('absolute', 'bg-white', 'rounded-full', 'opacity-30',
                        'pointer-events-none');
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });

        // Add ripple animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>

</body>

</html>

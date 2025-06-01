<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Fitur Kuis | Mathporia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Enhanced Shadows */
        .shadow-3xl {
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
        }

        .shadow-glow {
            box-shadow: 0 0 40px rgba(139, 92, 246, 0.3);
        }

        .shadow-glow-blue {
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.4);
        }

        .shadow-glow-purple {
            box-shadow: 0 0 30px rgba(147, 51, 234, 0.4);
        }

        .shadow-glow-yellow {
            box-shadow: 0 0 30px rgba(245, 158, 11, 0.4);
        }

        .shadow-glow-green {
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.4);
        }

        /* Enhanced Animations */
        .animate__animated.animate__fadeInDown {
            animation: fadeInDown 1s ease-out;
        }

        .animate__animated.animate__fadeInUp {
            animation: fadeInUp 1s ease-out;
        }

        .animate__delay-1s {
            animation-delay: 1s;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        /* Pulse Animation */
        @keyframes pulse-glow {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 0 20px rgba(139, 92, 246, 0.4);
            }
            50% { 
                transform: scale(1.05);
                box-shadow: 0 0 40px rgba(139, 92, 246, 0.6);
            }
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        /* Card Hover Effects */
        .card-interactive {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card-interactive::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .card-interactive:hover::before {
            left: 100%;
        }

        .card-interactive:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 40px 80px -12px rgba(0, 0, 0, 0.3);
        }

        /* Icon Animations */
        .icon-container {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .icon-container::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }

        .group:hover .icon-container::after {
            width: 100%;
            height: 100%;
        }

        .group:hover .icon-container {
            transform: scale(1.1) rotate(5deg);
        }

        /* Button Hover Effects */
        .btn-interactive {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-interactive::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }

        .btn-interactive:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-interactive:active {
            transform: scale(0.95);
        }

        /* Navigation Hover Effects */
        .nav-item {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-item::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #8b5cf6, #06b6d4);
            transition: width 0.3s ease;
        }

        .nav-item:hover::after {
            width: 100%;
        }

        /* Stats Card Animations */
        .stats-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.3);
        }

        /* Motivational Section Animation */
        .motivational-box {
            transition: all 0.3s ease;
            animation: float 4s ease-in-out infinite;
        }

        .motivational-box:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.3);
        }

        /* Loading Animation for Icons */
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .spin-slow {
            animation: spin-slow 4s linear infinite;
        }

        /* Background Pattern Animation */
        .bg-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);
            background-size: 100px 100px;
            animation: pattern-move 20s ease-in-out infinite;
        }

        @keyframes pattern-move {
            0%, 100% { background-position: 0% 0%, 100% 100%; }
            50% { background-position: 100% 0%, 0% 100%; }
        }

        /* Text Gradient Animation */
        .text-gradient {
            background: linear-gradient(45deg, #8b5cf6, #06b6d4, #10b981, #f59e0b);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient-shift 3s ease-in-out infinite;
        }

        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Ripple Effect */
        .ripple {
            position: relative;
            overflow: hidden;
        }

        .ripple::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }

        .ripple:active::after {
            width: 200px;
            height: 200px;
        }

        /* Responsive Enhancements */
        @media (max-width: 768px) {
            .text-5xl {
                font-size: 2.5rem;
            }
            .text-6xl {
                font-size: 3rem;
            }
            
            .card-interactive:hover {
                transform: translateY(-8px) scale(1.01);
            }
            
            .float-animation {
                animation-duration: 4s;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .card-interactive::before {
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            }
        }

        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {
            .animate__animated,
            .float-animation,
            .pulse-glow,
            .bg-pattern {
                animation: none;
            }
            
            .card-interactive,
            .btn-interactive,
            .stats-card {
                transition: none;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-700 bg-pattern">
    <!-- Navigation Bar -->
    <nav class="bg-white/10 backdrop-blur-lg border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Back Button -->
                <div class="flex items-center space-x-4">
                    <button onclick="window.location.href='{{ route('siswa.dashboard') }}'" class="nav-item flex items-center space-x-2 text-white hover:text-purple-200 transition-colors duration-200">
                        <i class="fas fa-arrow-left text-lg"></i>
                        <span class="font-medium">Kembali ke Dashboard</span>
                    </button>
                </div>
                <!-- User Info -->
                <div class="flex items-center space-x-2">
                    <span class="text-white text-base font-semibold flex items-center bg-purple-500/80 px-4 py-1 rounded-xl shadow">
                        <i class="fas fa-user-circle mr-2 text-lg"></i>
                        {{ Auth::user()->name ?? 'User' }}
                    </span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-4 animate__animated animate__fadeInDown text-gradient">
                    🎯 Pilih Fitur Kuis
                </h1>
                <p class="text-xl text-purple-100 animate__animated animate__fadeInUp animate__delay-1s max-w-2xl mx-auto float-animation">
                    Eksplorasi berbagai tantangan seru dan asah kemampuanmu setiap hari! Jadikan belajar matematika lebih menyenangkan! 🚀
                </p>
            </div>

            <!-- Quiz Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 mb-12">
                <!-- Misi Harian Card -->
                <div class="group relative">
                    <div class="card-interactive bg-white rounded-3xl shadow-2xl p-8 h-full flex flex-col items-center text-center hover:shadow-glow-blue border-4 border-transparent hover:border-blue-200 w-full">
                        <div class="icon-container w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-check-circle text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Misi Harian</h3>
                        <div class="flex items-center justify-center mb-4">
                            <span class="bg-blue-100 text-blue-800 text-lg font-bold px-4 py-2 rounded-full pulse-glow">
                                {{ $quizzes->count()}} Quizz Harian
                            </span>
                        </div>
                        <div class="w-full mb-4">
                            @if ($quizzes->isEmpty())
                                <p class="text-gray-400">Belum ada quiz harian dari guru.</p>
                            @else
                                <div class="space-y-4">
                                    @foreach ($quizzes as $quiz)
                                        <div class="p-4 bg-blue-50 rounded-xl shadow-sm mb-2 text-left">
                                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                                <div>
                                                    <h2 class="text-lg font-semibold text-blue-700">{{ $quiz->title }}</h2>
                                                    @if ($quiz->deadline)
                                                        <p class="text-xs text-gray-500 mb-1">🕒 Deadline: {{ \Carbon\Carbon::parse($quiz->deadline)->translatedFormat('l, d F Y H:i') }}</p>
                                                    @endif
                                                    <p class="text-xs text-gray-600">Passing Score: {{ $quiz->passing_score }}</p>
                                                </div>
                                                <div class="flex flex-col md:items-end">
                                                    @if ($results->has($quiz->id))
                                                        <p class="text-xs">Skor: {{ $results[$quiz->id]->score }} -
                                                            @if ($results[$quiz->id]->passed)
                                                                <span class="text-green-600 font-semibold">✅ Lulus</span>
                                                            @else
                                                                <span class="text-red-600 font-semibold">❌ Tidak Lulus</span>
                                                                <a href="{{ route('quizzes.show', $quiz->id) }}" class="text-blue-600 hover:underline ml-2">Coba Lagi</a>
                                                            @endif
                                                        </p>
                                                    @else
                                                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="text-blue-600 hover:underline text-xs">Kerjakan Kuis</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <a href="/quizzes" class="btn-interactive ripple w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-6 rounded-2xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            🎯 Lihat Semua Kuis
                        </a>
                    </div>
                </div>

                <!-- Teka-Teki Harian Card -->
                <div class="group relative">
                    <div class="card-interactive bg-white rounded-3xl shadow-2xl p-8 h-full flex flex-col items-center text-center hover:shadow-glow-purple border-4 border-transparent hover:border-purple-200">
                        <div class="icon-container w-20 h-20 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-lightbulb text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Teka-Teki Harian</h3>
                        <div class="flex items-center justify-center mb-4">
                            <span class="bg-purple-100 text-purple-800 text-lg font-bold px-4 py-2 rounded-full">
                                {{ $jumlahTekaTeki }} Teka-Teki
                            </span>
                        </div>
                        <div class="w-full mb-4">
                            <ul class="text-left text-sm text-gray-700">
                                @forelse($tekaTekis as $tekaTeki)
                                    <li class="mb-1 flex items-center">
                                        <i class="fas fa-puzzle-piece text-purple-400 mr-2"></i>{{ $tekaTeki->title }}
                                        @php $result = $tekaTekiResults[$tekaTeki->id] ?? null; @endphp
                                        @if($result)
                                            <span class="ml-2 text-xs px-2 py-1 rounded-full {{ $result->score >= 60 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">Skor: {{ $result->score }}</span>
                                        @else
                                            <span class="ml-2 text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-500">Belum dikerjakan</span>
                                        @endif
                                    </li>
                                @empty
                                    <li class="text-gray-400">Belum ada teka-teki dari guru.</li>
                                @endforelse
                            </ul>
                        </div>
                        <a href="#" class="btn-interactive ripple w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white font-bold py-3 px-6 rounded-2xl hover:from-purple-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            🧠 Mulai Berpikir
                        </a>
                    </div>
                </div>

                <!-- Boss Quiz Mingguan Card -->
                <div class="group relative">
                    <div class="card-interactive bg-white rounded-3xl shadow-2xl p-8 h-full flex flex-col items-center text-center hover:shadow-glow-yellow border-4 border-transparent hover:border-yellow-200">
                        <div class="icon-container w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-star text-white text-3xl spin-slow"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Boss Quiz Mingguan</h3>
                        <div class="flex items-center justify-center mb-4">
                            @if($canAccessBossQuiz)
                                <span class="bg-green-100 text-green-800 text-lg font-bold px-4 py-2 rounded-full flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Terbuka
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 text-lg font-bold px-4 py-2 rounded-full flex items-center">
                                    <i class="fas fa-lock mr-2"></i>
                                    Terkunci
                                </span>
                            @endif
                        </div>
                        <p class="text-gray-600 text-sm mb-6 flex-grow">Tantangan mingguan untuk para jagoan matematika!</p>
                        @if($canAccessBossQuiz)
                            <a href="#" class="btn-interactive ripple w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 font-bold py-3 px-6 rounded-2xl hover:from-yellow-500 hover:to-yellow-600 transition-all duration-300 shadow-lg hover:shadow-xl">
                                👑 Tantang Boss
                            </a>
                        @else
                            <button class="w-full bg-gray-300 text-gray-500 font-bold py-3 px-6 rounded-2xl cursor-not-allowed" disabled>
                                🔒 Terkunci
                            </button>
                            <div class="mt-3 text-xs text-red-500 text-left">
                                <b>Aturan:</b><br>
                                - Selesaikan semua Teka-Teki Harian<br>
                                - Nilai semua Teka-Teki minimal 60<br>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tantang Teman Card -->
                <div class="group relative opacity-75">
                    <div class="card-interactive bg-white rounded-3xl shadow-2xl p-8 h-full flex flex-col items-center text-center hover:shadow-glow-green border-4 border-transparent hover:border-green-200">
                        <div class="icon-container w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-users text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Tantang Teman</h3>
                        <div class="flex items-center justify-center mb-4">
                            <span class="bg-orange-100 text-orange-600 text-lg font-bold px-4 py-2 rounded-full">
                                Segera Hadir
                            </span>
                        </div>
                        <p class="text-gray-500 text-sm mb-6 flex-grow">Adu kemampuan dengan teman-temanmu!</p>
                        <button class="w-full bg-gray-300 text-gray-500 font-bold py-3 px-6 rounded-2xl cursor-not-allowed" disabled>
                            🔜 Coming Soon
                        </button>
                    </div>
                </div>
            </div>

            <!-- Motivational Section -->
            <div class="text-center">
                <div class="motivational-box inline-block bg-white/20 backdrop-blur-lg text-white px-8 py-4 rounded-3xl shadow-2xl border border-white/30">
                    <div class="flex items-center justify-center space-x-3">
                        <span class="text-2xl">🎓</span>
                        <span class="text-lg font-semibold">Ayo, jadikan belajar matematika lebih seru dan menantang!</span>
                        <span class="text-2xl">🚀</span>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                <div class="flex flex-col items-center justify-center bg-blue-100 rounded-2xl p-6 shadow-md">
                    <i class="fa-solid fa-bolt text-4xl text-yellow-500 mb-2"></i>
                    <div class="text-3xl font-extrabold text-blue-700">{{ $jumlahQuizHarian ?? 0 }}</div>
                    <div class="text-sm text-blue-800 font-semibold mt-1">Misi Harian</div>
                </div>
                <div class="flex flex-col items-center justify-center bg-purple-100 rounded-2xl p-6 shadow-md">
                    <i class="fa-solid fa-puzzle-piece text-4xl text-purple-500 mb-2"></i>
                    <div class="text-3xl font-extrabold text-purple-700">{{ $jumlahTekaTeki ?? 0 }}</div>
                    <div class="text-sm text-purple-800 font-semibold mt-1">Teka-Teki Harian</div>
                </div>
                <div class="flex flex-col items-center justify-center bg-yellow-100 rounded-2xl p-6 shadow-md">
                    <i class="fa-solid fa-crown text-4xl text-yellow-600 mb-2"></i>
                    <div class="text-3xl font-extrabold text-yellow-700">{{ $jumlahBossQuiz ?? 0 }}</div>
                    <div class="text-sm text-yellow-800 font-semibold mt-1">Boss Quiz Mingguan</div>
                </div>
                <div class="flex flex-col items-center justify-center bg-green-100 rounded-2xl p-6 shadow-md">
                    <i class="fa-solid fa-user-friends text-4xl text-green-600 mb-2"></i>
                    <div class="text-3xl font-extrabold text-green-700">{{ $jumlahTantangan ?? 0 }}</div>
                    <div class="text-sm text-green-800 font-semibold mt-1">Tantang Teman</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Update time every minute
            function updateTime() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('en-GB', { 
                    hour: '2-digit', 
                    minute: '2-digit',
                    hour12: false 
                });
                const timeElement = document.querySelector('.text-lg.font-bold');
                if (timeElement) {
                    timeElement.textContent = timeString;
                }
            }
            
            setInterval(updateTime, 60000); // Update every minute
            
            // Add click animations
            const cards = document.querySelectorAll('.group');
            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    if (!e.target.closest('button[disabled]')) {
                        this.style.transform = 'scale(0.98)';
                        setTimeout(() => {
                            this.style.transform = '';
                        }, 150);
                    }
                });
            });
        });
    </script>
</body>
</html>
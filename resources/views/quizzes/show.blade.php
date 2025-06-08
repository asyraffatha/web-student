<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $quiz->title }}</title>
    @vite('resources/css/app.css')
    <!-- Animate.css CDN untuk animasi yang lebih baik -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>

<body class="bg-gray-100 py-10">

    @php
        $type = $quiz->type ?? 'daily';
    @endphp

    @if($type === 'daily')
        <!-- Misi Harian: Tampilan sederhana yang diperbarui -->
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg animate__animated animate__fadeInUp">
            <div class="mb-6">
                <a href="{{ route('quizzes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Misi Harian: {{ $quiz->title }}</h1>
            <p class="mb-6 text-md text-gray-600">Passing Score: <span class="font-semibold">{{ $quiz->passing_score }}</span></p>
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded animate__animated animate__shakeX">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
                @csrf
                @foreach ($quiz->questions as $index => $question)
                    <div class="mb-8 p-6 border border-gray-200 rounded-lg bg-gray-50/80 shadow-md animate__animated animate__fadeInUp animate__delay-{{ $index + 1 }}s">
                        <p class="font-semibold text-gray-800 mb-4 text-lg flex items-center gap-2">
                            <span class="text-xl text-blue-600">📝</span> {{ $index + 1 }}. {{ $question->question }}
                        </p>
                        @if($question->image)
                            <div class="mb-4 flex justify-center">
                                <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Pertanyaan" class="max-w-md rounded-lg shadow-md border-2 border-gray-300">
                            </div>
                        @endif
                        @if($question->video)
                            <div class="mb-4 flex justify-center">
                                <video controls class="max-w-md rounded-lg shadow-md border-2 border-gray-300">
                                    <source src="{{ asset('storage/' . $question->video) }}" type="video/mp4">
                                    Browser Anda tidak mendukung video.
                                </video>
                            </div>
                        @endif
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            @php
                                $optionColors = ['bg-red-500','bg-blue-600','bg-yellow-400','bg-green-600'];
                                $optionIcons = ['A.','B.','C.','D.']; // Teks karena ikon emoji tidak selalu pas dengan konteks huruf
                            @endphp
                            @foreach ($question->options as $i => $option)
                                <label class="relative flex items-center p-4 rounded-xl shadow-md cursor-pointer transition-transform hover:scale-105 {{$optionColors[$i]}} text-white min-h-[60px]">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ ['A', 'B', 'C', 'D'][$i] }}" class="form-radio h-5 w-5 text-white bg-white border-white focus:ring-2 focus:ring-white mr-3" required>
                                    <span class="font-semibold text-lg">{{$optionIcons[$i]}} {{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="text-right mt-8">
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-300 font-bold shadow-xl animate__animated animate__pulse animate__infinite">
                        Kirim Jawaban
                    </button>
                </div>
            </form>
        </div>
    @elseif($type === 'teka-teki' || $type === 'boss')
        <style>
            body {
                background: linear-gradient(135deg, #a7d9f7 0%, #ffecb3 100%); /* Biru langit ke Kuning cerah */
                background-repeat: no-repeat;
                min-height: 100vh;
                font-family: 'Poppins', sans-serif;
                overflow-x: hidden;
                position: relative; /* Untuk background elements */
            }
            @keyframes cloudMove {
                0% { background-position: 0% 50%; }
                100% { background-position: 100% 50%; }
            }
            .cloud-bg {
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="800" height="400" viewBox="0 0 800 400"><defs><filter id="blur" x="-50%" y="-50%" width="200%" height="200%"><feGaussianBlur in="SourceGraphic" stdDeviation="10" /></filter></defs><circle cx="100" cy="200" r="80" fill="white" filter="url(%23blur)" opacity="0.5"/><circle cx="250" cy="150" r="100" fill="white" filter="url(%23blur)" opacity="0.4"/><circle cx="450" cy="220" r="90" fill="white" filter="url(%23blur)" opacity="0.6"/><circle cx="600" cy="180" r="70" fill="white" filter="url(%23blur)" opacity="0.3"/></svg>');
                background-size: 200% 100%;
                animation: cloudMove 60s linear infinite alternate;
                pointer-events: none;
                z-index: 0;
            }
            .quiz-container-gamify {
                background: rgba(255, 255, 255, 0.95);
                border-radius: 40px; /* Lebih membulat */
                box-shadow: 0 15px 40px rgba(0,0,0,0.15); /* Shadow lebih dalam */
                padding: 3rem; /* Padding lebih besar */
                margin-bottom: 2rem;
                position: relative;
                z-index: 1;
                overflow: hidden;
                border: 6px solid #8e2de2; /* Border ungu untuk kesan premium */
                animation: popIn 0.8s ease-out;
            }
            @keyframes popIn {
                0% { transform: scale(0.9); opacity: 0; }
                100% { transform: scale(1); opacity: 1; }
            }
            .option-gamify {
                border-radius: 25px; /* Lebih membulat */
                min-height: 90px;
                font-size: 1.4rem;
                font-weight: 700; /* Lebih tebal */
                display: flex;
                align-items: center;
                justify-content: flex-start; /* Untuk ikon di kiri */
                padding: 1.5rem 2rem; /* Padding lebih besar */
                box-shadow: 0 4px 15px rgba(0,0,0,0.1); /* Shadow lebih lembut */
                transition: transform 0.2s ease-out, box-shadow 0.2s ease-out, border-color 0.2s ease-out;
                cursor: pointer;
                border: 4px solid transparent; /* Untuk efek border saat hover */
                color: white; /* Default text color for options */
            }
            .option-gamify:hover {
                transform: translateY(-5px) scale(1.02); /* Lebih responsif */
                box-shadow: 0 8px 25px rgba(0,0,0,0.2);
                border-color: #ffd700; /* Emas saat hover */
            }
            .option-icon {
                font-size: 2.5rem; /* Lebih besar */
                margin-right: 1rem;
                display: inline-block;
                animation: floatIcon 3s infinite alternate;
            }
            @keyframes floatIcon {
                0% { transform: translateY(0); }
                100% { transform: translateY(-5px); }
            }
            .question-img-gamify {
                border-radius: 25px;
                border: 5px solid #ffac33; /* Border oranye cerah */
                box-shadow: 0 8px 20px rgba(0,0,0,0.15);
                margin: 0 auto 2rem auto; /* Margin lebih besar */
                display: block;
                max-width: 90%; /* Sesuaikan ukuran gambar */
                height: auto;
            }
            .bee-icon {
                position: absolute; left: 5%; top: 10%; font-size: 3.5rem; 
                animation: flybee 4s infinite alternate ease-in-out;
                z-index: 2;
            }
            .firefly-icon {
                position: absolute; right: 8%; bottom: 15%; font-size: 2.2rem; 
                animation: flybee 5s infinite alternate-reverse ease-in-out;
                z-index: 2;
                color: #ffeb3b;
            }
            @keyframes flybee {
                0% { transform: translate(0, 0) rotate(0deg); }
                50% { transform: translate(20px, -15px) rotate(5deg); }
                100% { transform: translate(0, 0) rotate(0deg); }
            }
            .boss-quiz-theme {
                background: linear-gradient(135deg, #1a202c 0%, #4a0e4a 100%); /* Darker, more menacing */
                background-repeat: no-repeat;
                min-height: 100vh;
                font-family: 'Poppins', sans-serif;
                overflow-x: hidden;
                position: relative;
            }
            .boss-quiz-container {
                background: rgba(0, 0, 0, 0.7); /* Transparan gelap */
                border-radius: 40px;
                box-shadow: 0 15px 60px rgba(0,0,0,0.4); /* Shadow sangat dalam */
                padding: 3.5rem;
                margin-bottom: 2rem;
                position: relative;
                z-index: 1;
                overflow: hidden;
                border: 8px solid #ffeb3b; /* Border kuning menyala */
                animation: glowBorder 2s infinite alternate;
            }
            @keyframes glowBorder {
                from { box-shadow: 0 0 10px #ffeb3b, 0 0 20px #ffeb3b, 0 0 30px #ffeb3b, inset 0 0 10px #ffeb3b; }
                to { box-shadow: 0 0 20px #ffeb3b, 0 0 30px #ffeb3b, 0 0 40px #ffeb3b, inset 0 0 20px #ffeb3b; }
            }
            .boss-hp-bar-outer {
                width: 100%;
                background: #333;
                border-radius: 15px;
                height: 25px;
                margin-bottom: 1.5rem;
                overflow: hidden;
                border: 2px solid #ffeb3b;
                box-shadow: 0 0 10px #ffeb3b;
            }
            .boss-hp-bar-inner {
                background: linear-gradient(90deg, #e74c3c 0%, #c0392b 100%); /* Merah darah */
                height: 100%;
                border-radius: 12px;
                width: 80%; /* Contoh HP */
                transition: width 0.5s ease-out;
                animation: hpPulse 1.5s infinite;
            }
            @keyframes hpPulse {
                0% { transform: scaleX(1); }
                50% { transform: scaleX(0.99); }
                100% { transform: scaleX(1); }
            }
            .boss-option-colors {
                background: linear-gradient(45deg, var(--color-start), var(--color-end));
            }
            .boss-option-hover-border {
                border-color: #00bcd4; /* Cyan */
            }
        </style>

        @if($type === 'teka-teki')
            <!-- Background Elements -->
            <div class="cloud-bg"></div>
            <div class="floating-elements">
                <span class="bee-icon animate__animated animate__bounceInLeft">🐝</span>
                <span class="firefly-icon animate__animated animate__bounceInRight">✨</span>
                <div class="floating-emoji emoji-1">🎮</div>
                <div class="floating-emoji emoji-2">🎯</div>
                <div class="floating-emoji emoji-3">🎲</div>
                <div class="floating-emoji emoji-4">🎨</div>
            </div>

            @php
                $userQuizResult = Auth::user() ? Auth::user()->quizResults->where('quiz_id', $quiz->id)->first() : null;
                $hasFailedPreviously = $userQuizResult && $userQuizResult->score < 60;
                $isRetryAttempt = $hasFailedPreviously && !$userQuizResult->retry_attempted;
                $isRetryRequested = request()->has('retry') && request()->get('retry') === 'true';
            @endphp

            @if($hasFailedPreviously && !$isRetryRequested)
                <div class="max-w-2xl mx-auto bg-gradient-to-r from-red-100 to-pink-100 border-l-4 border-red-500 text-red-700 p-8 rounded-2xl shadow-2xl animate__animated animate__fadeInDown">
                    <div class="text-center">
                        <div class="text-6xl mb-4 animate__animated animate__bounceIn">😢</div>
                        <p class="font-bold text-3xl mb-4 text-center bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-pink-600">
                            Ups! Belum Berhasil
                        </p>
                        <div class="bg-white/80 p-6 rounded-xl mb-6">
                            <p class="text-xl mb-4">Skormu: <span class="font-extrabold text-red-800 text-2xl">{{ $userQuizResult->score }}%</span></p>
                            <p class="text-xl">Passing Score: <span class="font-bold text-pink-600">60%</span></p>
                        </div>
                        <p class="text-xl mb-8 text-center font-semibold">Tapi jangan sedih! Kamu punya kesempatan terakhir untuk membuktikan kemampuanmu! 💪</p>
                        <div class="text-center">
                            <a href="{{ route('quizzes.show', $quiz->id) }}?retry=true" 
                               class="px-12 py-5 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-full hover:from-red-600 hover:to-pink-600 transition duration-300 font-extrabold text-2xl shadow-2xl animate__animated animate__pulse animate__infinite transform hover:scale-105 inline-flex items-center gap-3">
                                <span class="text-3xl">🔄</span>
                                Coba Lagi Sekarang!
                            </a>
                        </div>
                    </div>
                </div>
            @elseif($isRetryRequested || !$hasFailedPreviously)
                <div class="max-w-4xl mx-auto quiz-container-gamify animate__animated animate__zoomIn animate__delay-0.5s">
                    <!-- Progress Bar -->
                    <div class="progress-container mb-8">
                        <div class="progress-bar">
                            <div class="progress-fill"></div>
                        </div>
                        <div class="progress-text">Pertanyaan <span id="current-question">1</span> dari {{ count($quiz->questions) }}</div>
                    </div>

                    <div class="text-center mb-8">
                        <h1 class="text-5xl font-extrabold mb-4 drop-shadow-lg">
                            <span class="animate__animated animate__heartBeat animate__infinite text-6xl">🧩</span>
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-pink-600">
                                Teka-Teki Seru
                            </span>
                        </h1>
                        <h2 class="text-3xl font-bold text-purple-800 mb-6">{{ $quiz->title }}</h2>
                        
                        @if($isRetryRequested)
                            <div class="bg-gradient-to-r from-yellow-100 to-orange-100 border-l-4 border-yellow-500 text-yellow-800 p-6 rounded-xl mb-6 animate__animated animate__fadeIn">
                                <div class="flex items-center justify-center gap-3 mb-2">
                                    <span class="text-4xl">⚠️</span>
                                    <p class="font-bold text-2xl">Kesempatan Terakhir!</p>
                                </div>
                                <p class="text-xl">Ini adalah kesempatan terakhirmu untuk menyelesaikan teka-teki ini! Semangat! 💪</p>
                                <p class="text-lg mt-2">Jika kamu berhasil, kamu akan bisa mengakses Boss Quiz! 🎮</p>
                            </div>
                        @endif

                        <div class="bg-white/80 p-4 rounded-xl inline-block">
                            <p class="text-xl text-gray-800 font-semibold">
                                Passing Score: <span class="font-bold text-pink-600 text-2xl">60%</span>
                            </p>
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="mb-6 p-6 bg-red-100 text-red-800 rounded-xl animate__animated animate__shakeX border-l-4 border-red-500">
                            <div class="flex items-center gap-3">
                                <span class="text-3xl">❌</span>
                                <p class="text-lg font-semibold">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST" id="quizForm">
                        @csrf
                        @if($isRetryRequested)
                            <input type="hidden" name="is_retry" value="1">
                        @endif
                        
                        @foreach ($quiz->questions as $index => $question)
                            <div class="question-container mb-12 p-8 border-4 border-pink-300 rounded-3xl bg-white/95 shadow-2xl animate__animated animate__fadeInUp animate__delay-{{ $index + 1 }}s hover:shadow-pink-200 transition-all duration-300" data-question="{{ $index + 1 }}">
                                <div class="flex items-center gap-4 mb-6">
                                    <span class="text-4xl text-purple-600 animate__animated animate__swing animate__infinite animate__slow">🔎</span>
                                    <p class="font-extrabold text-pink-800 text-2xl">{{ $index + 1 }}. {{ $question->question }}</p>
                                </div>

                                @if($question->image)
                                    <div class="mb-8 flex justify-center transform hover:scale-105 transition-transform duration-300">
                                        <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Pertanyaan" class="question-img-gamify rounded-2xl">
                                    </div>
                                @endif

                                @if($question->video)
                                    <div class="mb-8 flex justify-center">
                                        <video controls class="max-w-md rounded-2xl shadow-xl border-4 border-pink-300 hover:shadow-pink-200 transition-all duration-300">
                                            <source src="{{ asset('storage/' . $question->video) }}" type="video/mp4">
                                            Browser Anda tidak mendukung video.
                                        </video>
                                    </div>
                                @endif

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
                                    @php
                                        $optionColors = [
                                            'bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700', 
                                            'bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700', 
                                            'bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600', 
                                            'bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700'
                                        ];
                                        $optionIcons = ['🌟','🚀','💡','🏆'];
                                    @endphp
                                    @foreach ($question->options as $i => $option)
                                        <label class="option-gamify {{$optionColors[$i]}} animate__animated animate__fadeInRight animate__delay-{{ $index * 0.2 + $i * 0.1 }}s transform hover:scale-105 transition-all duration-300 cursor-pointer">
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ ['A', 'B', 'C', 'D'][$i] }}" 
                                                   class="form-radio h-6 w-6 text-white bg-white border-white focus:ring-3 focus:ring-yellow-300 mr-4" 
                                                   required
                                                   onchange="playSelectSound()">
                                            <span class="option-icon text-3xl">{{$optionIcons[$i]}}</span>
                                            <span class="text-shadow text-xl">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="text-center mt-12">
                            <button type="submit" 
                                    class="px-12 py-5 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full hover:from-purple-700 hover:to-pink-700 transition duration-300 font-extrabold text-2xl shadow-2xl animate__animated animate__tada animate__infinite animate__slow transform hover:scale-105"
                                    onclick="playSubmitSound()">
                                {{ $isRetryRequested ? 'Kirim Jawaban Terakhir' : 'Kirim Jawaban' }} 
                                <span class="ml-3 text-3xl">➡️</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Audio Elements -->
            <audio id="selectSound" src="{{ asset('sounds/select.mp3') }}" preload="auto"></audio>
            <audio id="submitSound" src="{{ asset('sounds/submit.mp3') }}" preload="auto"></audio>
            <audio id="successSound" src="{{ asset('sounds/success.mp3') }}" preload="auto"></audio>

            <!-- Confetti Container -->
            <div id="confetti-container"></div>

            <style>
                /* Enhanced Styles */
                .floating-elements {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    pointer-events: none;
                    z-index: 0;
                }

                .floating-emoji {
                    position: absolute;
                    font-size: 2rem;
                    animation: float 6s ease-in-out infinite;
                }

                .emoji-1 { top: 10%; left: 5%; animation-delay: 0s; }
                .emoji-2 { top: 20%; right: 10%; animation-delay: 1s; }
                .emoji-3 { bottom: 15%; left: 15%; animation-delay: 2s; }
                .emoji-4 { bottom: 25%; right: 5%; animation-delay: 3s; }

                @keyframes float {
                    0%, 100% { transform: translateY(0) rotate(0deg); }
                    50% { transform: translateY(-20px) rotate(10deg); }
                }

                .progress-container {
                    background: rgba(255, 255, 255, 0.9);
                    padding: 1rem;
                    border-radius: 1rem;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                }

                .progress-bar {
                    height: 10px;
                    background: #e2e8f0;
                    border-radius: 5px;
                    overflow: hidden;
                    margin-bottom: 0.5rem;
                }

                .progress-fill {
                    height: 100%;
                    background: linear-gradient(90deg, #4f46e5, #ec4899);
                    width: 0%;
                    transition: width 0.3s ease;
                }

                .progress-text {
                    text-align: center;
                    font-weight: 600;
                    color: #4b5563;
                }

                .question-container {
                    position: relative;
                    overflow: hidden;
                }

                .question-container::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
                    transform: translateX(-100%);
                    transition: transform 0.6s;
                }

                .question-container:hover::before {
                    transform: translateX(100%);
                }

                .option-gamify {
                    position: relative;
                    overflow: hidden;
                }

                .option-gamify::after {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.2) 50%, transparent 70%);
                    transform: translateX(-100%);
                    transition: transform 0.6s;
                }

                .option-gamify:hover::after {
                    transform: translateX(100%);
                }

                #confetti-container {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    pointer-events: none;
                    z-index: 9999;
                }
            </style>

            <script>
                // Progress Bar
                function updateProgress() {
                    const totalQuestions = {{ count($quiz->questions) }};
                    const answeredQuestions = document.querySelectorAll('input[type="radio"]:checked').length;
                    const progress = (answeredQuestions / totalQuestions) * 100;
                    
                    document.querySelector('.progress-fill').style.width = `${progress}%`;
                    document.getElementById('current-question').textContent = answeredQuestions + 1;
                }

                // Sound Effects
                function playSelectSound() {
                    const sound = document.getElementById('selectSound');
                    sound.currentTime = 0;
                    sound.play();
                    updateProgress();
                }

                function playSubmitSound() {
                    const sound = document.getElementById('submitSound');
                    sound.currentTime = 0;
                    sound.play();
                }

                // Confetti Effect
                function showConfetti() {
                    const container = document.getElementById('confetti-container');
                    for (let i = 0; i < 100; i++) {
                        const confetti = document.createElement('div');
                        confetti.className = 'confetti';
                        confetti.style.left = Math.random() * 100 + 'vw';
                        confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                        confetti.style.animationDelay = Math.random() * 2 + 's';
                        container.appendChild(confetti);
                    }
                }

                // Initialize
                document.addEventListener('DOMContentLoaded', function() {
                    updateProgress();
                });
            </script>
        @else<!-- $type === 'boss' -->
            <body class="boss-quiz-theme">
                <div class="max-w-4xl mx-auto boss-quiz-container animate__animated animate__fadeInDownBig">
                    <h1 class="text-5xl font-extrabold text-yellow-400 text-center mb-8 drop-shadow-xl animate__animated animate__flash animate__infinite animate__slow">
                        <span class="animate__animated animate__wobble animate__infinite">👑</span> BOSS QUIZ: <span class="text-purple-400">{{ $quiz->title }}</span>
                    </h1>
                    <div class="boss-hp-bar-outer animate__animated animate__fadeInLeft animate__delay-1s">
                        <div class="boss-hp-bar-inner"></div>
                    </div>
                    <div class="text-center text-yellow-300 font-bold text-2xl mb-8 animate__animated animate__fadeInRight animate__delay-1.2s">HP Boss: 80%</div>
                    <p class="mb-8 text-xl text-yellow-200 font-semibold text-center">Kalahkan boss dengan menjawab semua soal dengan benar!</p>
                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded animate__animated animate__shakeX">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
                        @csrf
                        @foreach ($quiz->questions as $index => $question)
                            <div class="mb-12 p-10 border-4 border-yellow-500 rounded-3xl bg-gray-900/80 shadow-2xl animate__animated animate__fadeInUp animate__delay-{{ $index + 1 }}s">
                                <p class="font-extrabold text-yellow-400 mb-8 text-2xl flex items-center gap-4">
                                    <span class="text-4xl text-red-500 animate__animated animate__jello animate__infinite">⚔️</span> {{ $index + 1 }}. {{ $question->question }}
                                </p>
                                @if($question->image)
                                    <div class="mb-8 flex justify-center">
                                        <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Pertanyaan" class="question-img-gamify border-red-600">
                                    </div>
                                @endif
                                @if($question->video)
                                    <div class="mb-8 flex justify-center">
                                        <video controls class="max-w-md rounded-lg shadow-md border-4 border-red-600">
                                            <source src="{{ asset('storage/' . $question->video) }}" type="video/mp4">
                                            Browser Anda tidak mendukung video.
                                        </video>
                                    </div>
                                @endif
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-8">
                                    @php
                                        $bossOptionColors = [
                                            '--color-start: #ff416c; --color-end: #ff4b2b;', /* Merah */
                                            '--color-start: #2193b0; --color-end: #6dd5ed;', /* Biru */
                                            '--color-start: #f7b733; --color-end: #fc4a1a;', /* Oranye */
                                            '--color-start: #34e89e; --color-end: #0f3443;'  /* Hijau gelap */
                                        ];
                                        $bossOptionIcons = ['💥','🛡️','⚡','🔥'];
                                    @endphp
                                    @foreach ($question->options as $i => $option)
                                        <label class="option-gamify boss-option-colors {{$i % 2 === 0 ? 'animate__animated animate__fadeInLeft' : 'animate__animated animate__fadeInRight'}} animate__delay-{{ $index * 0.2 + $i * 0.1 }}s" style="{{ $bossOptionColors[$i] }}">
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ ['A', 'B', 'C', 'D'][$i] }}" class="form-radio h-7 w-7 text-white bg-white border-white focus:ring-4 focus:ring-yellow-400 mr-4" required>
                                            <span class="option-icon">{{$bossOptionIcons[$i]}}</span>
                                            <span class="text-shadow-lg text-2xl">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <div class="text-center mt-12">
                            <button type="submit" class="px-12 py-5 bg-yellow-500 text-gray-900 rounded-full hover:bg-yellow-400 transition duration-300 font-extrabold text-2xl shadow-2xl animate__animated animate__heartBeat animate__infinite animate__slower">
                                FINAL STRIKE! <span class="ml-3">🔥</span>
                            </button>
                        </div>
                    </form>
                </div>
            </body>
        @endif
    @endif

</body>

</html>

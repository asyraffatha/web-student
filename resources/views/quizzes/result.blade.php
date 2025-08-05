<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Quiz</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .result-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 3rem;
            border-radius: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            margin: 2rem auto;
            position: relative;
            z-index: 1;
            border: 4px solid #8e2de2;
            animation: popIn 0.8s ease-out;
        }

        @keyframes popIn {
            0% {
                transform: scale(0.9);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .result-container h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #2d3748;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .score-display {
            text-align: center;
            margin: 2rem 0;
            padding: 2rem;
            border-radius: 1rem;
            background: linear-gradient(135deg, #f6f8fd 0%, #f1f4f9 100%);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .score {
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 1rem 0;
        }

        .message {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 1.5rem 0;
            text-align: center;
            padding: 1rem;
            border-radius: 1rem;
        }

        .success-message {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
            animation: bounceIn 1s;
        }

        .retry-message {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
            animation: shake 1s;
        }

        .back-btn {
            display: inline-block;
            background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 999px;
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 2rem;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 8px 16px rgba(79, 172, 254, 0.3);
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(79, 172, 254, 0.4);
        }

        /* Gamification Reward Styles */
        .reward-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 1rem;
            margin: 2rem 0;
            text-align: center;
            animation: slideInUp 0.8s ease-out;
        }

        .reward-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .reward-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .reward-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 1rem;
            border-radius: 0.5rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .reward-label {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .reward-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffd700;
        }

        .achievement-badge {
            display: inline-block;
            background: linear-gradient(45deg, #ffd700, #ffed4e);
            color: #2d3748;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-weight: 600;
            margin: 0.5rem;
            box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .level-up-notification {
            background: linear-gradient(45deg, #ff6b6b, #ffa500);
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            margin: 1rem 0;
            text-align: center;
            font-weight: 600;
            animation: bounce 1s;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

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

        .emoji-1 {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .emoji-2 {
            top: 20%;
            right: 10%;
            animation-delay: 1s;
        }

        .emoji-3 {
            bottom: 15%;
            left: 15%;
            animation-delay: 2s;
        }

        .emoji-4 {
            bottom: 25%;
            right: 5%;
            animation-delay: 3s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.3);
                opacity: 0;
            }

            50% {
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="floating-emoji emoji-1">🎮</div>
        <div class="floating-emoji emoji-2">🎯</div>
        <div class="floating-emoji emoji-3">🎲</div>
        <div class="floating-emoji emoji-4">🎨</div>
    </div>

    <div class="result-container animate__animated animate__fadeIn">
        <h1 class="animate__animated animate__bounceIn">
            @if ($quiz->type === 'teka-teki')
                🧩 Hasil Teka-Teki
            @elseif($quiz->type === 'boss')
                👑 Hasil Boss Quiz
            @else
                📝 Hasil Quiz
            @endif
        </h1>

        <div class="score-display animate__animated animate__fadeInUp">
            <p class="text-xl text-gray-600 mb-2">Skor Anda</p>
            <div class="score animate__animated animate__bounceIn">{{ number_format($score, 2) }}%</div>
            <p class="text-lg text-gray-500">Passing Score: {{ $quiz->passing_score }}%</p>
        </div>

        <!-- Gamification Reward Section -->
        @if(session('quiz_reward_info'))
            @php $rewardInfo = session('quiz_reward_info'); @endphp
            <div class="reward-section animate__animated animate__fadeInUp animate__delay-1s">
                <div class="reward-title">
                    🎁 Reward & Experience Earned!
                </div>
                
                <div class="achievement-badge">
                    {{ $rewardInfo['achievement'] }}
                </div>
                
                <div class="reward-grid">
                    <div class="reward-item">
                        <div class="reward-label">Base Points</div>
                        <div class="reward-value">+{{ $rewardInfo['base_points'] }}</div>
                    </div>
                    
                    @if($rewardInfo['bonus_points'] > 0)
                    <div class="reward-item">
                        <div class="reward-label">Bonus Points</div>
                        <div class="reward-value">+{{ $rewardInfo['bonus_points'] }}</div>
                    </div>
                    @endif
                    
                    <div class="reward-item">
                        <div class="reward-label">Base Experience</div>
                        <div class="reward-value">+{{ $rewardInfo['base_experience'] }} XP</div>
                    </div>
                    
                    @if($rewardInfo['bonus_experience'] > 0)
                    <div class="reward-item">
                        <div class="reward-label">Bonus Experience</div>
                        <div class="reward-value">+{{ $rewardInfo['bonus_experience'] }} XP</div>
                    </div>
                    @endif
                    
                    <div class="reward-item">
                        <div class="reward-label">Total Points</div>
                        <div class="reward-value">+{{ $rewardInfo['total_points'] }}</div>
                    </div>
                    
                    <div class="reward-item">
                        <div class="reward-label">Total Experience</div>
                        <div class="reward-value">+{{ $rewardInfo['total_experience'] }} XP</div>
                    </div>
                </div>
                
                @if($score >= 100)
                <div class="level-up-notification">
                    🏆 Perfect Score! Double points and experience earned!
                </div>
                @elseif($score >= 80)
                <div class="level-up-notification">
                    🌟 High Score! Bonus points and experience earned!
                </div>
                @endif
                
                <div class="mt-4">
                    <a href="{{ route('gamification.dashboard') }}" 
                       class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        🏆 Lihat Progress Gamifikasi
                    </a>
                </div>
            </div>
        @endif

        @if ($score >= $quiz->passing_score)
            <div class="message success-message animate__animated animate__bounceIn">
                <span class="text-4xl">🎉</span>
                <p class="mt-2">Selamat! Kamu Berhasil! 🎊</p>
                @if ($quiz->type === 'teka-teki')
                    <p class="text-lg mt-2">Sekarang kamu bisa mengakses Boss Quiz! 🎮</p>
                @endif
            </div>
        @else
            <div class="message retry-message animate__animated animate__shakeX">
                <span class="text-4xl">😢</span>
                <p class="mt-2">Belum Berhasil</p>
                @if ($quiz->type === 'teka-teki' && ($result && !$result->retry_attempted))
                    <p class="text-lg mt-2">Jangan sedih! Kamu masih punya kesempatan terakhir! 💪</p>
                @elseif($quiz->type === 'daily' && ($result && $result->attempts < 3))
                    <p class="text-lg mt-2">Jangan sedih! Kamu masih punya {{ 3 - $result->attempts }} kesempatan lagi!
                        💪</p>
                @endif
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('quizzes.index') }}"
                class="back-btn animate__animated animate__fadeInUp animate__delay-1s">
                Kembali ke Daftar Quiz
            </a>
        </div>
    </div>
</body>

</html>

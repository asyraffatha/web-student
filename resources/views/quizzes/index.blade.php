<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kuis Tersedia</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"><animate attributeName="opacity" values="0;1;0" dur="3s" repeatCount="indefinite"/></circle><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.15)"><animate attributeName="opacity" values="0;1;0" dur="2s" repeatCount="indefinite" begin="1s"/></circle><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.2)"><animate attributeName="opacity" values="0;1;0" dur="4s" repeatCount="indefinite" begin="2s"/></circle></svg>');
            pointer-events: none;
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Back Button dengan Neon Effect */
        .back-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 1.1rem;
            background: #fff;
            color: #222;
            border-radius: 999px;
            font-weight: 500;
            font-size: 0.98rem;
            text-decoration: none;
            border: 1.5px solid #222;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: background 0.18s, color 0.18s, border 0.18s, box-shadow 0.18s, transform 0.13s;
            margin-bottom: 1.2rem;
            position: absolute;
            top: 1.2rem;
            left: 2.2rem;
            z-index: 10;
        }

        .back-btn:hover {
            background: #f3f4f6;
            color: #111;
            border-color: #111;
            transform: translateY(-1px) scale(1.02);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .back-btn svg {
            margin-right: 0.5rem;
            width: 18px;
            height: 18px;
        }

        .user-info {
            position: absolute;
            top: 1.2rem;
            right: 2.2rem;
            background: #fff;
            color: #222;
            border-radius: 999px;
            padding: 0.45rem 1.1rem;
            font-size: 0.98rem;
            font-weight: 500;
            border: 1.5px solid #222;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            z-index: 10;
        }

        .user-info .user-icon {
            font-size: 1.1rem;
        }

        /* Header dengan Glowing Effect */
        .header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(45deg, #ffd89b, #19547b, #ffd89b);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(255, 216, 155, 0.5);
            margin-bottom: 1rem;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .header .subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 300;
        }

        /* Quiz Grid */
        .quiz-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        /* Quiz Card dengan Holographic Effect */
        .quiz-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 2rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .quiz-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .quiz-card:hover::before {
            transform: translateX(100%);
        }

        .quiz-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        /* Quiz Type Badges */
        .quiz-daily {
            border-left: 6px solid #4facfe;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
        }

        .quiz-teka-teki {
            border-left: 6px solid #a855f7;
            box-shadow: 0 10px 30px rgba(168, 85, 247, 0.3);
        }

        .quiz-boss {
            border-left: 6px solid #fbbf24;
            box-shadow: 0 10px 30px rgba(251, 191, 36, 0.3);
        }

        /* Card Header */
        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .quiz-icon {
            font-size: 3rem;
            margin-right: 1rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .quiz-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            flex-grow: 1;
        }

        .quiz-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .badge-daily {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            color: white;
        }

        .badge-teka-teki {
            background: linear-gradient(45deg, #a855f7, #e879f9);
            color: white;
        }

        .badge-boss {
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            color: #1f2937;
        }

        /* Quiz Info */
        .quiz-info {
            margin-bottom: 1.5rem;
        }

        .deadline {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .passing-score {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Status Section */
        .status-section {
            margin-bottom: 1.5rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .status-passed {
            background: linear-gradient(45deg, #10b981, #34d399);
            color: white;
        }

        .status-failed {
            background: linear-gradient(45deg, #ef4444, #f87171);
            color: white;
        }

        .status-not-attempted {
            background: rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.8);
        }

        .status-text {
            margin-top: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status-passed-text {
            color: #34d399;
        }

        .status-failed-text {
            color: #f87171;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
        }

        .action-btn {
            flex: 1;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-daily {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            color: white;
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
        }

        .btn-teka-teki {
            background: linear-gradient(45deg, #a855f7, #e879f9);
            color: white;
            box-shadow: 0 8px 25px rgba(168, 85, 247, 0.4);
        }

        .btn-boss {
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            color: #1f2937;
            box-shadow: 0 8px 25px rgba(251, 191, 36, 0.4);
        }

        .btn-disabled {
            background: rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.5);
            cursor: not-allowed;
        }

        .action-btn:not(.btn-disabled):hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .btn-retry {
            background: linear-gradient(45deg, #06b6d4, #0891b2);
            color: white;
            box-shadow: 0 8px 25px rgba(6, 182, 212, 0.4);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .empty-state h2 {
            font-size: 2rem;
            color: white;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        /* Floating Elements */
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .floating-shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            top: 10%;
            left: 10%;
            width: 60px;
            height: 60px;
            background: #4facfe;
            border-radius: 50%;
            animation-delay: 0s;
        }

        .shape-2 {
            top: 20%;
            right: 20%;
            width: 40px;
            height: 40px;
            background: #a855f7;
            transform: rotate(45deg);
            animation-delay: 2s;
        }

        .shape-3 {
            bottom: 20%;
            left: 15%;
            width: 50px;
            height: 50px;
            background: #fbbf24;
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header h1 {
                font-size: 2.5rem;
            }

            .quiz-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .quiz-card {
                padding: 1.5rem;
            }

            .back-btn {
                left: 1rem;
                top: 0.7rem;
                font-size: 0.92rem;
                padding: 0.35rem 0.8rem;
            }

            .user-info {
                right: 1rem;
                top: 0.7rem;
                font-size: 0.92rem;
                padding: 0.35rem 0.8rem;
            }
        }

        /* Success Animations */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .status-passed {
            animation: pulse 2s infinite;
        }

        /* Glowing Border Animation */
        @keyframes glow {

            0%,
            100% {
                box-shadow: 0 0 5px rgba(255, 255, 255, 0.2), 0 0 10px rgba(255, 255, 255, 0.2), 0 0 15px rgba(255, 255, 255, 0.2);
            }

            50% {
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.4), 0 0 20px rgba(255, 255, 255, 0.4), 0 0 30px rgba(255, 255, 255, 0.4);
            }
        }

        .quiz-card:hover {
            animation: glow 2s infinite;
        }
    </style>
</head>

<body>
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>

    <div class="container">
        <!-- Back Button -->
        <a href="{{ route('siswa.fiturquiz') }}" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            Kembali ke Fiturquiz
        </a>

        <div class="user-info">
            <span class="user-icon">👤</span>
            {{ Auth::user()->name ?? 'User' }}
        </div>

        <!-- Header -->
        <div class="header">
            <h1>🎮 Arena Quiz 🏆</h1>
            <p class="subtitle">Tunjukkan kemampuanmu di setiap kuis dari gurumu!
                Belajar serius, hasil maksimal!</p>
        </div>

        <!-- Quiz Content -->
        @if ($quizzes->isEmpty())
            <div class="empty-state">
                <h2>🎯 Belum Ada Tantangan</h2>
                <p>Belum ada kuis saat ini. Guru kamu akan segera menambahkan kuis untuk kelasmu!</p>
            </div>
        @else
            <div class="quiz-grid">
                @foreach ($quizzes as $quiz)
                    @php
                        $type = $quiz->type;
                        $isAttempted = $results->has($quiz->id);
                        $isPassed = $isAttempted && $results[$quiz->id]->passed;
                        $isTekaTekiOrBoss = $type === 'teka-teki' || $type === 'boss';

                        $cardClass =
                            $type === 'daily' ? 'quiz-daily' : ($type === 'teka-teki' ? 'quiz-teka-teki' : 'quiz-boss');
                        $badgeClass =
                            $type === 'daily'
                                ? 'badge-daily'
                                : ($type === 'teka-teki'
                                    ? 'badge-teka-teki'
                                    : 'badge-boss');
                        $btnClass =
                            $type === 'daily' ? 'btn-daily' : ($type === 'teka-teki' ? 'btn-teka-teki' : 'btn-boss');

                        $icon = $type === 'daily' ? '📝' : ($type === 'teka-teki' ? '🧩' : '👑');
                        $typeLabel =
                            $type === 'daily' ? 'Misi Harian' : ($type === 'teka-teki' ? 'Teka-Teki' : 'Boss Quiz');

                        $canAccessBossQuiz = true;
                        if (isset($quizzes)) {
                            $bossQuizzes = $quizzes->where('type', 'boss');
                            $tekaTekis = $quizzes->where('type', 'teka-teki');
                            $tekaTekiPassed =
                                $tekaTekis->count() > 0
                                    ? $tekaTekis->every(function ($q) use ($results) {
                                        return isset($results[$q->id]) && $results[$q->id]->score > $q->passing_score;
                                    })
                                    : false;
                            $canAccessBossQuiz = $tekaTekis->count() > 0 && $tekaTekiPassed;
                        }
                    @endphp

                    <div
                        class="quiz-card {{ $cardClass }} {{ $type === 'boss' && !$canAccessBossQuiz ? 'opacity-60 pointer-events-none cursor-not-allowed relative' : '' }}">
                        <!-- Card Header -->
                        <div class="card-header">
                            <span class="quiz-icon">{{ $icon }}</span>
                            <h2 class="quiz-title">{{ $quiz->title }}</h2>
                            <span class="quiz-badge {{ $badgeClass }}">{{ $typeLabel }}</span>
                        </div>

                        <!-- Quiz Info -->
                        <div class="quiz-info">
                            @if ($quiz->deadline)
                                <p class="deadline">
                                    🕒 Deadline:
                                    {{ \Carbon\Carbon::parse($quiz->deadline)->translatedFormat('l, d F Y H:i') }}
                                </p>
                            @endif
                            <p class="passing-score">
                                🎯 Target Skor: <strong>{{ $quiz->passing_score }}</strong>
                            </p>
                        </div>

                        <!-- Status Section -->
                        <div class="status-section">
                            @if ($isAttempted)
                                <div class="status-badge {{ $isPassed ? 'status-passed' : 'status-failed' }}">
                                    {{ $isPassed ? '🏆' : '💪' }} Skor: {{ $results[$quiz->id]->score }}
                                </div>
                                @if ($isPassed)
                                    <div class="status-text status-passed-text">✨ Keren! Kamu sudah lulus!</div>
                                @else
                                    @if ($type === 'daily')
                                        <div class="status-text status-failed-text">
                                            🔥 Sisa percobaan: {{ 3 - $results[$quiz->id]->attempts }}x
                                        </div>
                                    @else
                                        <div class="status-text status-failed-text">🔥 Jangan menyerah, coba lagi!</div>
                                    @endif
                                @endif
                            @else
                                <div class="status-badge status-not-attempted">
                                    🚀 Siap untuk tantangan?
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            @if ($isAttempted)
                                @if ($type === 'daily' && !$isPassed && $results[$quiz->id]->attempts < 3)
                                    <a href="{{ route('quizzes.show', $quiz->id) }}" class="action-btn btn-retry">
                                        🔄 Coba Lagi ({{ 3 - $results[$quiz->id]->attempts }}x tersisa)
                                    </a>
                                @elseif (
                                    $type === 'teka-teki' &&
                                        !$isPassed &&
                                        !($results[$quiz->id]->retry_attempted ?? false) &&
                                        $results[$quiz->id]->score < $quiz->passing_score)
                                    <a href="{{ route('quizzes.show', $quiz->id) }}" class="action-btn btn-teka-teki">
                                        🔄 Kesempatan Terakhir
                                    </a>
                                @elseif ($isTekaTekiOrBoss || ($type === 'daily' && ($isPassed || $results[$quiz->id]->attempts >= 3)))
                                    <button class="action-btn btn-disabled" disabled>
                                        ✅ Sudah Selesai
                                    </button>
                                @endif
                            @else
                                @if ($type === 'boss' && !$canAccessBossQuiz)
                                    <button class="action-btn btn-boss btn-disabled" disabled>
                                        <span style="font-size:1.3rem;vertical-align:middle;margin-right:8px;">🔒</span>
                                        Terkunci
                                    </button>
                                @else
                                    <a href="{{ route('quizzes.show', $quiz->id) }}"
                                        class="action-btn {{ $btnClass }}">
                                        🎯 {{ $type === 'boss' ? 'Lawan Boss!' : 'Mulai Quiz' }}
                                    </a>
                                @endif
                            @endif
                        </div>
                        @if ($type === 'boss' && !$canAccessBossQuiz)
                            <div
                                style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);opacity:0.25;pointer-events:none;">
                                <span style="font-size:3rem;">🔒</span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>

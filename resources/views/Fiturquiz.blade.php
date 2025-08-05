<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Fitur Quiz</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }

        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(odd) {
            animation-direction: reverse;
            animation-duration: 4s;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }

        @keyframes particleFloat {
            0%, 100% {
                transform: translateY(0px) scale(1);
                opacity: 0.8;
            }
            50% {
                transform: translateY(-3px) scale(1.2);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.3);
                opacity: 0.7;
            }
        }

        @keyframes glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.4);
            }

            50% {
                box-shadow: 0 0 40px rgba(255, 215, 0, 0.8);
            }
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0) rotate(0deg);
            }

            50% {
                opacity: 1;
                transform: scale(1) rotate(180deg);
            }
        }

        .main-content {
            padding: 3rem 1rem;
            position: relative;
            z-index: 1;
        }

        .container {
            max-width: 56rem;
            margin: 0 auto;
        }

        .header-section {
            text-align: center;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .title-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1rem;
            position: relative;
            animation: slideInDown 1s ease-out;
        }

        .icon-container {
            background: linear-gradient(135deg, #ffd700, #ffed4a);
            width: 4rem;
            height: 4rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            position: relative;
            animation: glow 2s ease-in-out infinite, pulse 3s ease-in-out infinite;
            border: 3px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .icon-container::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(45deg, #ffd700, #ff6b6b, #4ecdc4, #45b7d1);
            border-radius: 50%;
            z-index: -1;
            animation: gradientShift 3s ease infinite;
            opacity: 0.7;
        }

        .bolt-icon {
            font-size: 1.5rem;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            animation: sparkle 2s ease-in-out infinite;
        }

        .feature-title {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #fff, #f0f8ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .feature-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #ffd700, transparent);
            border-radius: 2px;
            animation: pulse 2s ease-in-out infinite;
        }

        .feature-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.125rem;
            line-height: 1.7;
            max-width: 42rem;
            margin: 0 auto;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: slideInUp 1s ease-out 0.3s both;
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem 2rem;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .feature-subtitle::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .sparkles {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .sparkle {
            position: absolute;
            color: #ffd700;
            font-size: 1rem;
            animation: sparkle 2s ease-in-out infinite;
        }

        .sparkle:nth-child(1) {
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }

        .sparkle:nth-child(2) {
            top: 20%;
            right: 15%;
            animation-delay: 0.5s;
        }

        .sparkle:nth-child(3) {
            bottom: 30%;
            left: 10%;
            animation-delay: 1s;
        }

        .sparkle:nth-child(4) {
            bottom: 15%;
            right: 20%;
            animation-delay: 1.5s;
        }

        .sparkle:nth-child(5) {
            top: 50%;
            left: 5%;
            animation-delay: 2s;
        }

        .sparkle:nth-child(6) {
            top: 60%;
            right: 8%;
            animation-delay: 2.5s;
        }

        @media (max-width: 768px) {
            .feature-title {
                font-size: 2rem;
            }

            .feature-subtitle {
                font-size: 1rem;
                padding: 1rem 1.5rem;
            }

            .icon-container {
                width: 3rem;
                height: 3rem;
            }

            .bolt-icon {
                font-size: 1.25rem;
            }
        }

        .fitur-quiz-wrapper {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 2.2rem;
            margin-bottom: 2.2rem;
        }

        .fitur-quiz-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1.7rem;
            width: 100%;
            max-width: 1400px;
            justify-items: center;
        }

        .fitur-card {
            width: 100%;
            max-width: 320px;
            min-width: 220px;
            margin: 0 auto;
            border-radius: 2.2rem;
            padding: 2.2rem 1.2rem;
        }

        .fitur-card.harian,
        .fitur-card.teka {
            background: rgba(255, 255, 255, 0.82);
            box-shadow: 0 8px 32px 0 rgba(80, 80, 200, 0.10);
            backdrop-filter: blur(2px);
        }

        .fitur-card.boss {
            background: rgba(251, 191, 36, 0.10);
            box-shadow: 0 8px 32px 0 rgba(251, 191, 36, 0.13);
        }

        .fitur-card.teman {
            background: rgba(22, 22, 22, 0.13);
            filter: brightness(0.85) blur(0.5px);
            opacity: 0.7;
        }

        @media (max-width: 1200px) {
            .fitur-quiz-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {
            .fitur-quiz-grid {
                grid-template-columns: 1fr;
            }

            .fitur-card {
                max-width: 95vw;
            }
        }

        .quiz-title {
            display: block;
            font-weight: 700;
            color: #2563eb;
            font-size: 1.05rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 90%;
        }
    </style>
</head>

<body>
    <div
        style="position:sticky;top:0;z-index:10;display:flex;justify-content:space-between;align-items:center;padding:1.2rem 2.5vw 0.5rem 2.5vw;">
        <a href="{{ route('siswa.dashboard') }}"
            style="display:flex;align-items:center;gap:0.7rem;background:rgba(255,255,255,0.7);padding:0.7rem 1.3rem;border-radius:1.2rem;font-weight:700;color:#6366f1;text-decoration:none;box-shadow:0 2px 8px rgba(99,102,241,0.08);font-size:1.1rem;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Home
        </a>
        
        <!-- Gamification Info -->
        <div style="display:flex;align-items:center;gap:1rem;">
            <!-- Badge Display -->
            <div style="position:relative;display:flex;align-items:center;gap:0.7rem;background:rgba(255,255,255,0.9);padding:0.7rem 1.3rem;border-radius:1.2rem;font-weight:700;color:#f59e0b;box-shadow:0 2px 8px rgba(245,158,11,0.2);font-size:1rem;">
                <span style="font-size:1.5rem;">🏅</span>
                <div>
                    <div style="font-size:0.9rem;color:#f59e0b;">{{ Auth::user()->getLevelTitle() }}</div>
                    <div style="font-size:0.8rem;color:#f59e0b;opacity:0.8;">Level {{ Auth::user()->getLevel() }}</div>
                </div>
                @if(Auth::user()->getEarnedBadges()->count() > 0)
                <div style="position:absolute;-top:1;-right-1;background:#ef4444;color:white;font-size:0.7rem;border-radius:50%;width:1.2rem;height:1.2rem;display:flex;align-items:center;justify-content:center;font-weight:bold;">
                    {{ Auth::user()->getEarnedBadges()->count() }}
                </div>
                @endif
            </div>
            
            <!-- Points Display -->
            <div style="display:flex;align-items:center;gap:0.7rem;background:rgba(255,255,255,0.9);padding:0.7rem 1.3rem;border-radius:1.2rem;font-weight:700;color:#3b82f6;box-shadow:0 2px 8px rgba(59,130,246,0.2);font-size:1rem;">
                <span style="font-size:1.5rem;">⭐</span>
                <div>
                    <div style="font-size:0.9rem;color:#3b82f6;">{{ number_format(Auth::user()->getTotalPoints()) }}</div>
                    <div style="font-size:0.8rem;color:#3b82f6;opacity:0.8;">Poin</div>
                </div>
            </div>
            
            <!-- Experience Display with Professional Progress Bar -->
            <div style="display:flex;align-items:center;gap:0.7rem;background:rgba(255,255,255,0.95);padding:0.7rem 1.3rem;border-radius:1.2rem;font-weight:700;color:#10b981;box-shadow:0 4px 15px rgba(16,185,129,0.3);font-size:1rem;min-width:280px;backdrop-filter:blur(10px);border:1px solid rgba(16,185,129,0.2);">
                <span style="font-size:1.5rem;">📈</span>
                <div style="flex:1;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.4rem;">
                        <span style="font-size:0.9rem;color:#10b981;font-weight:600;">{{ number_format(Auth::user()->userPoint?->experience ?? 0) }} XP</span>
                        <span style="font-size:0.8rem;color:#10b981;opacity:0.8;background:rgba(16,185,129,0.1);padding:0.2rem 0.5rem;border-radius:0.5rem;">Level {{ Auth::user()->getLevel() + 1 }}</span>
                    </div>
                    
                    <!-- Professional Progress Bar -->
                    <div style="position:relative;width:100%;height:0.8rem;background:#fff;border-radius:0.4rem;overflow:hidden;border:1px solid rgba(16,185,129,0.2);">
                        <!-- Background Pattern -->
                        <div style="position:absolute;inset:0;background-image:repeating-linear-gradient(45deg,transparent,transparent 2px,rgba(16,185,129,0.05) 2px,rgba(16,185,129,0.05) 4px);"></div>
                        
                        <!-- Main Progress Fill - Gradasi Hijau -->
                        <div style="height:100%;background:linear-gradient(90deg,#10b981,#34d399,#10b981);background-size:200% 100%;border-radius:0.4rem;transition:width 1.5s cubic-bezier(0.4,0,0.2,1);position:relative;overflow:hidden;box-shadow:inset 0 1px 3px rgba(0,0,0,0.1);" 
                             style="width:{{ Auth::user()->getProgressToNextLevel() }}%">
                            
                            <!-- Animated Shimmer Effect -->
                            <div style="position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.4),transparent);animation:shimmer 2.5s infinite;transform:skewX(-20deg);"></div>
                            
                            <!-- Glowing Edge Effect -->
                            <div style="position:absolute;right:0;top:0;bottom:0;width:3px;background:linear-gradient(to bottom,transparent,rgba(255,255,255,0.8),transparent);box-shadow:0 0 10px rgba(255,255,255,0.5);"></div>
                            
                            <!-- Progress Particles -->
                            <div style="position:absolute;inset:0;">
                                <div style="position:absolute;top:1/2;left:1/4;width:2px;height:2px;background:rgba(255,255,255,0.8);border-radius:50%;animation:particleFloat 3s infinite;box-shadow:0 0 4px rgba(255,255,255,0.6);"></div>
                                <div style="position:absolute;top:1/2;left:1/2;width:1.5px;height:1.5px;background:rgba(255,255,255,0.6);border-radius:50%;animation:particleFloat 3s infinite;animation-delay:1s;box-shadow:0 0 3px rgba(255,255,255,0.4);"></div>
                                <div style="position:absolute;top:1/2;left:3/4;width:1px;height:1px;background:rgba(255,255,255,0.4);border-radius:50%;animation:particleFloat 3s infinite;animation-delay:2s;box-shadow:0 0 2px rgba(255,255,255,0.3);"></div>
                            </div>
                            
                            <!-- Level Up Indicator -->
                            @if(Auth::user()->getProgressToNextLevel() > 90)
                            <div style="position:absolute;right:2px;top:50%;transform:translateY(-50%);width:6px;height:6px;background:#fbbf24;border-radius:50%;animation:pulse 1s infinite;box-shadow:0 0 8px rgba(251,191,36,0.6);"></div>
                            @endif
                        </div>
                        
                        <!-- Progress Text Overlay - Dihilangkan -->
                    </div>
                    
                    <!-- Progress Details -->
                    <div style="display:flex;justify-content:space-between;margin-top:0.3rem;">
                        <span style="font-size:0.7rem;color:#10b981;opacity:0.8;">{{ number_format(Auth::user()->userPoint?->experience ?? 0) }}/{{ number_format(Auth::user()->userPoint?->experience_to_next_level ?? 100) }}</span>
                        <span style="font-size:0.7rem;color:#10b981;opacity:0.8;font-weight:600;">
                            {{ number_format(100 - Auth::user()->getProgressToNextLevel(), 1) }}% tersisa
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div
            style="display:flex;align-items:center;gap:0.7rem;background:rgba(255,255,255,0.7);padding:0.7rem 1.3rem;border-radius:1.2rem;font-weight:700;color:#6366f1;box-shadow:0 2px 8px rgba(99,102,241,0.08);font-size:1.1rem;">
            <i class="fa-solid fa-user-circle"></i> {{ Auth::user()->name ?? 'User' }}
        </div>
    </div>

    <div class="animated-bg"></div>

    <div class="particles" id="particles"></div>

    <div class="main-content">
        <div class="container">
            <div class="header-section">
                <div class="sparkles">
                    <i class="sparkle fa-solid fa-star"></i>
                    <i class="sparkle fa-solid fa-star"></i>
                    <i class="sparkle fa-solid fa-star"></i>
                    <i class="sparkle fa-solid fa-star"></i>
                    <i class="sparkle fa-solid fa-star"></i>
                    <i class="sparkle fa-solid fa-star"></i>
                </div>

                <div class="title-container">
                    <div class="icon-container">
                        <i class="fa-solid fa-bolt bolt-icon"></i>
                    </div>
                    <h1 class="feature-title">Pilih Fitur Quiz</h1>
                </div>

                <div class="feature-subtitle">
                    Asah kemampuanmu lewat kuis yang dibuat langsung oleh gurumu!
                    Setiap soal dirancang sesuai kebutuhan kelas — belajar jadi lebih seru! 🚀
                </div>
            </div>

            <!-- 4 Fitur Quiz -->
            <div class="fitur-quiz-wrapper">
                <div class="fitur-quiz-grid">
                    <!-- Misi Harian -->
                    <div class="fitur-card harian">
                        <div
                            style="background:#38bdf8;width:3.2rem;height:3.2rem;display:flex;align-items:center;justify-content:center;border-radius:1rem;margin-bottom:1.1rem;font-size:2rem;">
                            <span role="img" aria-label="misi">📝</span>
                        </div>
                        <div style="font-weight:900;font-size:1.25rem;color:#2563eb;margin-bottom:0.7rem;">Misi Harian
                        </div>
                        <div
                            style="background:#38bdf8;color:#fff;font-weight:700;padding:0.5rem 1.2rem;border-radius:1rem;margin-bottom:1.1rem;font-size:1rem;">
                            Total: {{ $quizzes->count() }} Quiz</div>
                        @foreach ($quizzes as $quiz)
                            @php
                                $result = $results->get($quiz->id);
                                $gagal = $result && !$result->passed;
                            @endphp
                            @if (!$result || $gagal)
                                <div
                                    style="background:rgba(255,255,255,0.97);border-radius:1rem;padding:1rem;margin-bottom:0.7rem;box-shadow:0 2px 8px rgba(37,99,235,0.08);width:100%;font-size:0.98rem;">
                                    <div class="quiz-title" style="display:flex;align-items:center;gap:0.5rem;">
                                        <span role="img" aria-label="soal">📝</span>
                                        <span style="flex:1;">{{ $quiz->title }}</span>
                                    </div>
                                    @if ($quiz->deadline)
                                        <div style="font-size:0.93rem;color:#64748b;margin-top:0.2rem;">🕒 Deadline:
                                            {{ \Carbon\Carbon::parse($quiz->deadline)->translatedFormat('l, d F Y H:i') }}
                                        </div>
                                    @endif
                                    <div style="font-size:0.93rem;color:#ef4444;margin-top:0.2rem;">🎯 Target Skor:
                                        <b>{{ $quiz->passing_score }}</b>
                                    </div>
                                    
                                    <!-- Reward Info -->
                                    <div style="margin-top:0.4rem;background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:0.8rem;padding:0.5rem;border:1px solid #f59e0b;">
                                        <div style="display:flex;align-items:center;gap:0.3rem;margin-bottom:0.2rem;">
                                            <span style="font-size:0.9rem;">⭐</span>
                                            <span style="font-size:0.8rem;color:#92400e;font-weight:600;">Reward Poin:</span>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:0.75rem;color:#92400e;">
                                            <span>Base: 60 poin</span>
                                            <span>Perfect: 120 poin</span>
                                            <span>XP: 80-240</span>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-top:0.4rem;">
                                        <div
                                            style="background:#f1f5f9;color:#64748b;font-weight:700;padding:0.3rem 0.8rem;border-radius:0.8rem;display:inline-block;margin-bottom:0.2rem;">
                                            @if ($gagal)
                                                💪 Coba lagi!
                                            @else
                                                🚀 Siap untuk tantangan?
                                            @endif
                                        </div>
                                        @if (!$result)
                                            <a href="{{ route('quizzes.show', $quiz->id) }}"
                                                style="display:inline-block;margin-top:0.3rem;background:#38bdf8;color:#fff;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;font-size:0.98rem;"><i
                                                    class="fa-solid fa-rotate-right"></i> KERJAKAN</a>
                                        @elseif($gagal)
                                            <a href="{{ route('quizzes.show', $quiz->id) }}"
                                                style="display:inline-block;margin-top:0.3rem;background:#38bdf8;color:#fff;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;font-size:0.98rem;"><i
                                                    class="fa-solid fa-rotate-right"></i> COBA LAGI</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($quizzes->filter(fn($quiz) => !$results->has($quiz->id) || ($results->get($quiz->id) && !$results->get($quiz->id)->passed))->count() == 0)
                            <div style="color:#64748b;font-size:0.98rem;margin-top:1.2rem;">Tidak ada quiz harian yang
                                perlu dikerjakan.</div>
                        @endif
                    </div>
                    <!-- Teka-Teki Harian -->
                    <div class="fitur-card teka">
                        <div
                            style="background:#a78bfa;width:3.2rem;height:3.2rem;display:flex;align-items:center;justify-content:center;border-radius:1rem;margin-bottom:1.1rem;font-size:2rem;">
                            <span role="img" aria-label="teka-teki">🧩</span>
                        </div>
                        <div style="font-weight:900;font-size:1.25rem;color:#7c3aed;margin-bottom:0.7rem;">Teka-Teki
                            Harian</div>
                        <div
                            style="background:#a78bfa;color:#fff;font-weight:700;padding:0.5rem 1.2rem;border-radius:1rem;margin-bottom:1.1rem;font-size:1rem;">
                            Total: {{ $tekaTekis->count() }} Teka-Teki</div>
                        @foreach ($tekaTekis as $tekaTeki)
                            @php
                                $remedialCount = $tekaTekiRemedialCount[$tekaTeki->id] ?? 0;
                                $result = $tekaTekiResults->get($tekaTeki->id);
                            @endphp
                            @if (
                                !isset($tekaTekiResults[$tekaTeki->id]) ||
                                    ($result && $result->score < ($tekaTeki->passing_score ?? 60) && $remedialCount < 2))
                                <div
                                    style="background:rgba(255,255,255,0.97);border-radius:1rem;padding:1rem;margin-bottom:0.7rem;box-shadow:0 2px 8px rgba(168,85,247,0.08);width:100%;font-size:0.98rem;">
                                    <div class="quiz-title"
                                        style="display:flex;align-items:center;gap:0.5rem;color:#7c3aed;">
                                        <span role="img" aria-label="teka-teki">🧩</span>
                                        <span style="flex:1;">{{ $tekaTeki->title }}</span>
                                    </div>
                                    <div style="font-size:0.93rem;color:#ef4444;margin-top:0.2rem;">🎯 Target Skor:
                                        <b>{{ $tekaTeki->passing_score ?? '-' }}</b>
                                    </div>
                                    
                                    <!-- Reward Info -->
                                    <div style="margin-top:0.4rem;background:linear-gradient(135deg,#e0e7ff,#c7d2fe);border-radius:0.8rem;padding:0.5rem;border:1px solid #6366f1;">
                                        <div style="display:flex;align-items:center;gap:0.3rem;margin-bottom:0.2rem;">
                                            <span style="font-size:0.9rem;">⭐</span>
                                            <span style="font-size:0.8rem;color:#3730a3;font-weight:600;">Reward Poin:</span>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:0.75rem;color:#3730a3;">
                                            <span>Base: 80 poin</span>
                                            <span>Perfect: 160 poin</span>
                                            <span>XP: 120-360</span>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-top:0.4rem;">
                                        <div
                                            style="background:#f1f5f9;color:#64748b;font-weight:700;padding:0.3rem 0.8rem;border-radius:0.8rem;display:inline-block;margin-bottom:0.2rem;">
                                            @if ($result && $result->score < ($tekaTeki->passing_score ?? 60))
                                                💪 Coba lagi!
                                            @else
                                                🚀 Siap untuk tantangan?
                                            @endif
                                        </div>
                                        @if (!isset($tekaTekiResults[$tekaTeki->id]))
                                            <a href="{{ route('quizzes.show', $tekaTeki->id) }}"
                                                style="display:inline-block;margin-top:0.3rem;background:#a78bfa;color:#fff;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;font-size:0.98rem;"><i
                                                    class="fa-solid fa-rotate-right"></i> KERJAKAN</a>
                                        @elseif($result && $result->score < ($tekaTeki->passing_score ?? 60) && $remedialCount < 2)
                                            <a href="{{ route('quizzes.show', $tekaTeki->id) }}"
                                                style="display:inline-block;margin-top:0.3rem;background:#a78bfa;color:#fff;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;font-size:0.98rem;"><i
                                                    class="fa-solid fa-rotate-right"></i> COBA LAGI</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($tekaTekis->filter(fn($tekaTeki) => !isset($tekaTekiResults[$tekaTeki->id]))->count() == 0)
                            <div style="color:#64748b;font-size:0.98rem;margin-top:1.2rem;">Tidak ada teka-teki yang
                                perlu dikerjakan.</div>
                        @endif
                    </div>
                    <!-- Boss Quiz Mingguan -->
                    <div class="fitur-card boss"
                        style="position:relative;{{ !$canAccessBossQuiz ? 'opacity:0.7;' : '' }}">
                        @if (!$canAccessBossQuiz)
                            <div
                                style="position:absolute;inset:0;background:rgba(0,0,0,0.18);border-radius:2.2rem;z-index:1;">
                            </div>
                        @endif
                        <div
                            style="background:#fde68a;width:3.2rem;height:3.2rem;display:flex;align-items:center;justify-content:center;border-radius:1rem;margin-bottom:1.1rem;font-size:2rem;position:relative;z-index:2;">
                            <span role="img" aria-label="boss">👑</span>
                        </div>
                        <div
                            style="font-weight:900;font-size:1.25rem;color:#b45309;margin-bottom:0.7rem;position:relative;z-index:2;">
                            Boss Quiz Mingguan</div>
                        <div
                            style="background:#fde68a;color:#b45309;font-weight:700;padding:0.5rem 1.2rem;border-radius:1rem;margin-bottom:1.1rem;font-size:1rem;position:relative;z-index:2;">
                            Total: {{ $bossQuizzes->count() }} Boss Quiz</div>
                        @foreach ($bossQuizzes as $bossQuiz)
                            @if (!isset($bossQuizResults[$bossQuiz->id]))
                                <div
                                    style="background:rgba(255,255,255,0.97);border-radius:1rem;padding:1rem;margin-bottom:0.7rem;box-shadow:0 2px 8px rgba(251,191,36,0.08);width:100%;font-size:0.98rem;position:relative;z-index:2;">
                                    <div class="quiz-title"
                                        style="display:flex;align-items:center;gap:0.5rem;color:#b45309;">
                                        <span role="img" aria-label="boss">👑</span>
                                        <span style="flex:1;">{{ $bossQuiz->title }}</span>
                                    </div>
                                    <div style="font-size:0.93rem;color:#ef4444;margin-top:0.2rem;">🎯 Target Skor:
                                        <b>{{ $bossQuiz->passing_score ?? '-' }}</b>
                                    </div>
                                    
                                    <!-- Reward Info -->
                                    <div style="margin-top:0.4rem;background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:0.8rem;padding:0.5rem;border:1px solid #f59e0b;">
                                        <div style="display:flex;align-items:center;gap:0.3rem;margin-bottom:0.2rem;">
                                            <span style="font-size:0.9rem;">⭐</span>
                                            <span style="font-size:0.8rem;color:#92400e;font-weight:600;">Reward Poin:</span>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:0.75rem;color:#92400e;">
                                            <span>Base: 150 poin</span>
                                            <span>Perfect: 300 poin</span>
                                            <span>XP: 200-600</span>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-top:0.4rem;">
                                        <div
                                            style="background:#f1f5f9;color:#64748b;font-weight:700;padding:0.3rem 0.8rem;border-radius:0.8rem;display:inline-block;margin-bottom:0.2rem;">
                                            🚀 Siap untuk tantangan?</div>
                                        @if ($canAccessBossQuiz)
                                            <a href="{{ route('quizzes.show', $bossQuiz->id) }}"
                                                style="display:inline-block;margin-top:0.3rem;background:#fde68a;color:#b45309;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;font-size:0.98rem;"><i
                                                    class="fa-solid fa-rotate-right"></i> KERJAKAN</a>
                                        @else
                                            <button
                                                style="display:inline-block;margin-top:0.3rem;background:#fde68a;color:#b45309;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;cursor:not-allowed;opacity:0.7;font-size:0.98rem;"
                                                disabled>
                                                <span
                                                    style="font-size:1.2rem;vertical-align:middle;margin-right:8px;">🔒</span>
                                                Terkunci
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <!-- Completed Boss Quiz -->
                                <div
                                    style="background:rgba(255,255,255,0.97);border-radius:1rem;padding:1rem;margin-bottom:0.7rem;box-shadow:0 2px 8px rgba(34,197,94,0.08);width:100%;font-size:0.98rem;position:relative;z-index:2;border:2px solid #22c55e;">
                                    <div class="quiz-title"
                                        style="display:flex;align-items:center;gap:0.5rem;color:#16a34a;">
                                        <span role="img" aria-label="completed">✅</span>
                                        <span style="flex:1;">{{ $bossQuiz->title }}</span>
                                        <span style="background:#22c55e;color:white;padding:0.2rem 0.5rem;border-radius:0.5rem;font-size:0.8rem;font-weight:bold;">SELESAI</span>
                                    </div>
                                    <div style="font-size:0.93rem;color:#16a34a;margin-top:0.2rem;">🎯 Skor Anda:
                                        <b>{{ $bossQuizResults[$bossQuiz->id]->score ?? '-' }}</b>
                                    </div>
                                    
                                    <div style="margin-top:0.4rem;background:linear-gradient(135deg,#dcfce7,#bbf7d0);border-radius:0.8rem;padding:0.5rem;border:1px solid #22c55e;">
                                        <div style="display:flex;align-items:center;gap:0.3rem;margin-bottom:0.2rem;">
                                            <span style="font-size:0.9rem;">🏆</span>
                                            <span style="font-size:0.8rem;color:#15803d;font-weight:600;">Boss Quiz Selesai!</span>
                                        </div>
                                        <div style="font-size:0.75rem;color:#15803d;">
                                            Selamat! Anda telah berhasil menyelesaikan boss quiz ini.
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <!-- Boss Quiz section hanya muncul jika ada yang belum dikerjakan -->
                        @if ($bossQuizzes->filter(fn($bossQuiz) => !isset($bossQuizResults[$bossQuiz->id]))->count() > 0)
                            <!-- Boss quiz yang belum dikerjakan akan ditampilkan di atas -->
                        @endif
                    </div>
                    <!-- Tantang Teman -->
                    <div class="fitur-card teman">
                        <div
                            style="background:#6ee7b7;width:3.2rem;height:3.2rem;display:flex;align-items:center;justify-content:center;border-radius:1rem;margin-bottom:1.1rem;font-size:2rem;">
                            <span role="img" aria-label="teman">🧑‍🤝‍🧑</span>
                        </div>
                        <div style="font-weight:900;font-size:1.25rem;color:#047857;margin-bottom:0.7rem;">Tantang
                            Teman
                        </div>
                        <div
                            style="background:#6ee7b7;color:#fff;font-weight:700;padding:0.5rem 1.2rem;border-radius:1rem;margin-bottom:1.1rem;font-size:1rem;">
                            Segera Hadir</div>
                        <div style="color:#64748b;font-size:0.98rem;">Adu kemampuan dengan teman-temanmu!</div>
                        <button
                            style="margin-top:1.1rem;background:#e5e7eb;color:#6b7280;font-weight:700;padding:0.5rem 1.2rem;border-radius:1rem;cursor:not-allowed;border:none;font-size:0.98rem;">Coming
                            Soon</button>
                    </div>
                </div>
            </div>

            <!-- Info Ringkas Quiz -->
            <div
                style="max-width:900px;margin:0 auto 2.5rem auto;text-align:center;background:rgba(255,255,255,0.7);border-radius:18px;padding:1.7rem 1.2rem 1.4rem 1.2rem;box-shadow:0 2px 12px rgba(80,80,200,0.08);">
                <div style="font-size:1.25rem;font-weight:700;color:#4f46e5;margin-bottom:0.7rem;">Info Quiz Kamu</div>
                <div style="display:flex;justify-content:center;gap:2.5rem;flex-wrap:wrap;font-size:1.13rem;">
                    <div><span style="font-weight:700;color:#2563eb;">Total Quiz:</span>
                        {{ $jumlahQuizHarian + $jumlahTekaTeki + $jumlahBossQuiz }}</div>
                    <div><span style="font-weight:700;color:#38bdf8;">Quiz Harian:</span> {{ $jumlahQuizHarian }}
                    </div>
                    <div><span style="font-weight:700;color:#a78bfa;">Teka-Teki:</span> {{ $jumlahTekaTeki }}</div>
                    <div><span style="font-weight:700;color:#fde68a;">Boss Quiz:</span> {{ $jumlahBossQuiz }}</div>
                    <div><span style="font-weight:700;color:#22c55e;">Quiz Selesai:</span>
                        {{ $results->filter(fn($r) => $r->passed)->count() }}</div>
                </div>
            </div>

            <!-- Tombol Lihat Semua Quiz -->
            <div style="text-align:center;margin-bottom:2.5rem;">
                <a href="{{ route('quizzes.index') }}"
                    style="display:inline-block;background:linear-gradient(90deg,#6366f1,#a78bfa);color:#fff;font-weight:700;padding:1.1rem 2.5rem;border-radius:1.7rem;font-size:1.18rem;box-shadow:0 4px 16px rgba(99,102,241,0.13);text-decoration:none;transition:filter 0.2s;"
                    onmouseover="this.style.filter='brightness(1.08)'" onmouseout="this.style.filter='none'">
                    <i class="fa-solid fa-list-ul" style="margin-right:0.7rem;"></i> Lihat Semua Quiz
                </a>
            </div>
        </div>
    </div>

    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random size
                const size = Math.random() * 4 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';

                // Random position
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';

                // Random animation delay
                particle.style.animationDelay = Math.random() * 6 + 's';

                particlesContainer.appendChild(particle);
            }
        }

        // Initialize particles
        createParticles();

        // Add interactive effects
        document.addEventListener('mousemove', (e) => {
            const particles = document.querySelectorAll('.particle');
            particles.forEach((particle, index) => {
                if (index % 3 === 0) {
                    const rect = particle.getBoundingClientRect();
                    const centerX = rect.left + rect.width / 2;
                    const centerY = rect.top + rect.height / 2;

                    const deltaX = (e.clientX - centerX) * 0.01;
                    const deltaY = (e.clientY - centerY) * 0.01;

                    particle.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
                }
            });
        });

        // Add click effect to icon
        document.querySelector('.icon-container').addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    </script>
</body>

</html>

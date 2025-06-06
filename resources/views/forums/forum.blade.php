<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Enhanced animated background */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
        }

        .particle:nth-child(1) {
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.3);
            left: 15%;
            animation: float1 8s ease-in-out infinite;
        }

        .particle:nth-child(2) {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.2);
            left: 35%;
            animation: float2 10s ease-in-out infinite 2s;
        }

        .particle:nth-child(3) {
            width: 6px;
            height: 6px;
            background: rgba(255, 255, 255, 0.4);
            left: 55%;
            animation: float3 6s ease-in-out infinite 1s;
        }

        .particle:nth-child(4) {
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.25);
            left: 75%;
            animation: float1 12s ease-in-out infinite 3s;
        }

        .particle:nth-child(5) {
            width: 14px;
            height: 14px;
            background: rgba(255, 255, 255, 0.15);
            left: 85%;
            animation: float2 9s ease-in-out infinite 4s;
        }

        @keyframes float1 {

            0%,
            100% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }

            10% {
                opacity: 1;
                transform: scale(1);
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) scale(0);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            50% {
                transform: translateY(50vh) translateX(100px) rotate(180deg);
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) translateX(-50px) rotate(360deg);
            }
        }

        @keyframes float3 {

            0%,
            100% {
                transform: translateY(100vh) scale(1);
                opacity: 0;
            }

            20% {
                opacity: 1;
            }

            50% {
                transform: translateY(50vh) scale(1.5);
            }

            80% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) scale(0.5);
            }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 10;
        }

        /* Glassmorphism header */
        .header {
            text-align: center;
            margin-bottom: 40px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            animation: slideDown 1s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: headerShine 3s ease-in-out infinite;
        }

        @keyframes headerShine {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            50% {
                transform: translateX(50%) translateY(50%) rotate(45deg);
            }

            100% {
                transform: translateX(200%) translateY(200%) rotate(45deg);
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100px) scale(0.8);
                opacity: 0;
            }

            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        .header h1 {
            font-size: 3.5rem;
            background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        @keyframes textGlow {
            from {
                filter: drop-shadow(0 0 5px rgba(102, 126, 234, 0.5));
            }

            to {
                filter: drop-shadow(0 0 20px rgba(102, 126, 234, 0.8));
            }
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.3rem;
            margin-bottom: 25px;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Enhanced buttons */
        .back-btn,
        .create-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .back-btn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f, #ff8a80);
            color: white;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.4);
        }

        .create-btn {
            background: linear-gradient(135deg, #4ecdc4, #44a08d, #26d0ce);
            color: white;
            box-shadow: 0 10px 30px rgba(78, 205, 196, 0.4);
        }

        .back-btn::before,
        .create-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .back-btn:hover::before,
        .create-btn:hover::before {
            left: 100%;
        }

        .back-btn:hover,
        .create-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        /* Enhanced forum cards with 3D effect */
        .forum-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            margin-bottom: 30px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            animation: cardSlideIn 0.8s ease-out;
            animation-fill-mode: both;
            border: 2px solid transparent;
            position: relative;
            transform-style: preserve-3d;
        }

        .forum-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 25px;
        }

        .forum-card:hover::before {
            opacity: 1;
        }

        .forum-card:nth-child(even) {
            animation-delay: 0.2s;
        }

        .forum-card:nth-child(odd) {
            animation-delay: 0.4s;
        }

        @keyframes cardSlideIn {
            from {
                transform: translateX(-50px) rotateY(-10deg);
                opacity: 0;
            }

            to {
                transform: translateX(0) rotateY(0);
                opacity: 1;
            }
        }

        .forum-card:hover {
            transform: translateY(-15px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        .forum-header {
            background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
            color: white;
            padding: 25px 30px;
            position: relative;
            overflow: hidden;
        }

        .forum-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: rotate(45deg);
            opacity: 0;
            transition: all 0.6s ease;
        }

        .forum-card:hover .forum-header::after {
            animation: cardShine 0.8s ease-in-out;
        }

        @keyframes cardShine {
            0% {
                transform: translateX(-100%) rotate(45deg);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateX(200%) rotate(45deg);
                opacity: 0;
            }
        }

        .forum-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .forum-meta {
            opacity: 0.95;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .forum-content {
            padding: 25px 30px;
            font-size: 1.1rem;
            line-height: 1.7;
            color: #444;
            position: relative;
        }

        .forum-actions {
            padding: 20px 30px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-view {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-edit {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
        }

        .btn-delete {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .action-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .action-btn:active::before {
            width: 300px;
            height: 300px;
        }

        /* Enhanced empty state */
        .empty-state {
            text-align: center;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 80px 50px;
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            animation: emptyStatePulse 3s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        @keyframes emptyStatePulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }
        }

        .empty-emoji {
            font-size: 6rem;
            margin-bottom: 25px;
            animation: emojiDance 2s ease-in-out infinite;
            display: inline-block;
        }

        @keyframes emojiDance {

            0%,
            100% {
                transform: rotate(0deg) scale(1);
            }

            25% {
                transform: rotate(-10deg) scale(1.1);
            }

            75% {
                transform: rotate(10deg) scale(1.1);
            }
        }

        .success-message {
            background: linear-gradient(135deg, #27ae60, #2ecc71, #58d68d);
            color: white;
            padding: 25px 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(39, 174, 96, 0.3);
            animation: successSlide 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        @keyframes successSlide {
            from {
                transform: translateX(-100%) rotate(-5deg);
                opacity: 0;
            }

            to {
                transform: translateX(0) rotate(0);
                opacity: 1;
            }
        }

        /* Interactive loading */
        .loading {
            display: none;
            text-align: center;
            color: white;
            font-size: 1.3rem;
            margin: 30px 0;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }

        .loading::after {
            content: '';
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top: 5px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-left: 15px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Enhanced fun icons */
        .fun-icon {
            display: inline-block;
            animation: iconWiggle 2s ease-in-out infinite;
            margin-right: 10px;
            font-size: 1.2em;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        @keyframes iconWiggle {

            0%,
            100% {
                transform: rotate(0deg) scale(1);
            }

            25% {
                transform: rotate(10deg) scale(1.1);
            }

            75% {
                transform: rotate(-10deg) scale(1.1);
            }
        }

        /* Responsive enhancements */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
            }

            .header {
                padding: 30px 20px;
            }

            .forum-actions {
                flex-direction: column;
            }

            .action-btn {
                text-align: center;
                justify-content: center;
            }

            .back-btn,
            .create-btn {
                width: 100%;
                justify-content: center;
                margin-bottom: 10px;
            }
        }

        /* Scroll animations */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Particle effect on hover */
        .particle-burst {
            position: absolute;
            width: 5px;
            height: 5px;
            background: #667eea;
            border-radius: 50%;
            pointer-events: none;
            animation: burstParticle 1s ease-out forwards;
        }

        @keyframes burstParticle {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(0) translateY(-100px);
                opacity: 0;
            }
        }

        /* Button navigation controls */
        .nav-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 25px;
        }

        @media (max-width: 600px) {
            .nav-controls {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Enhanced animated background particles -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div class="container">
        <!-- Enhanced header with glassmorphism -->
        <div class="header">
            <h1><span class="fun-icon">🎓</span>Forum Diskusi Siswa<span class="fun-icon">📚</span></h1>
            <p>Tempat berbagi ide, bertanya, dan belajar bersama teman-teman!</p>

            <div class="nav-controls">
                <a href="{{ route('home') }}" class="back-btn">
                    <span class="fun-icon">🏠</span> Kembali ke Beranda
                </a>
                <a href="{{ route('forums.create') }}" class="create-btn">
                    <span class="fun-icon">✨</span> Buat Forum Baru
                </a>
            </div>
        </div>

        <!-- Enhanced loading indicator -->
        <div class="loading" id="loading">
            <span class="fun-icon">⚡</span>Memuat forum yang keren...
        </div>

        <!-- Enhanced success message -->
        @if (session('success'))
            <div class="success-message">
                <span class="fun-icon">🎉</span> {{ session('success') }}
            </div>
        @endif

        <!-- Enhanced forum cards -->
        <div id="forumContainer">
            @forelse ($forums as $forum)
                <div class="forum-card scroll-reveal">
                    <div class="forum-header">
                        <div class="forum-title">
                            <span class="fun-icon">📚</span>{{ $forum->title }}
                        </div>
                        <div class="forum-meta">
                            <span><span class="fun-icon">👤</span> {{ $forum->user->name }}</span>
                            <span><span class="fun-icon">⏰</span> {{ $forum->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="forum-content">
                        {{ Str::limit($forum->content, 200, '...') }}
                    </div>
                    <div class="forum-actions">
                        <a href="{{ route('forums.show', $forum->id) }}" class="action-btn btn-view">
                            <span class="fun-icon">👀</span> Lihat Detail
                        </a>
                        <a href="{{ route('forums.edit', $forum->id) }}" class="action-btn btn-edit">
                            <span class="fun-icon">✏️</span> Edit
                        </a>
                        <form action="{{ route('forums.destroy', $forum->id) }}" method="POST"
                            onsubmit="return confirm('🗑️ Yakin mau hapus forum ini? Data yang sudah dihapus nggak bisa dikembalikan lho!')"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete">
                                <span class="fun-icon">🗑️</span> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state scroll-reveal">
                    <div class="empty-emoji">🤔</div>
                    <h2
                        style="color: white; margin-bottom: 20px; font-size: 2.5rem; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">
                        Belum Ada Forum Nih!
                    </h2>
                    <p
                        style="color: rgba(255,255,255,0.9); font-size: 1.2rem; margin-bottom: 30px; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                        Yuk jadi yang pertama buat forum diskusi yang seru!
                    </p>
                    <a href="{{ route('forums.create') }}" class="create-btn">
                        <span class="fun-icon">🚀</span> Buat Forum Pertama
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        // Enhanced interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll reveal animation
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });

            // Staggered animation for forum cards
            const cards = document.querySelectorAll('.forum-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.15}s`;
            });

            // Enhanced click effects with particle burst
            function createParticleBurst(x, y) {
                for (let i = 0; i < 8; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle-burst';
                    particle.style.left = x + 'px';
                    particle.style.top = y + 'px';
                    particle.style.background = `hsl(${Math.random() * 360}, 70%, 60%)`;

                    const angle = (Math.PI * 2 * i) / 8;
                    const velocity = 50 + Math.random() * 50;
                    particle.style.setProperty('--dx', Math.cos(angle) * velocity + 'px');
                    particle.style.setProperty('--dy', Math.sin(angle) * velocity + 'px');

                    document.body.appendChild(particle);

                    setTimeout(() => particle.remove(), 1000);
                }
            }

            // Enhanced button interactions
            document.addEventListener('click', function(e) {
                if (e.target.matches('.action-btn, .create-btn, .back-btn')) {
                    // Visual feedback
                    e.target.style.transform = 'scale(0.95)';

                    // Particle burst effect
                    const rect = e.target.getBoundingClientRect();
                    createParticleBurst(
                        rect.left + rect.width / 2,
                        rect.top + rect.height / 2
                    );

                    setTimeout(() => {
                        e.target.style.transform = '';
                    }, 200);
                }
            });

            // Enhanced form submission with better UX
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('button[type="submit"]');
                    if (button && !button.disabled) {
                        button.innerHTML = '<span class="fun-icon">⏳</span> Menghapus...';
                        button.disabled = true;
                        button.style.opacity = '0.7';

                        // Show loading indicator
                        const loading = document.getElementById('loading');
                        if (loading) {
                            loading.style.display = 'block';
                            loading.innerHTML =
                                '<span class="fun-icon">🗑️</span>Menghapus forum...';
                        }
                    }
                });
            });

            // Enhanced hover effects for cards
            cards.forEach(card => {
                let hoverTimeout;

                card.addEventListener('mouseenter', function(e) {
                    clearTimeout(hoverTimeout);
                    this.style.transform =
                        'translateY(-15px) rotateX(5deg) rotateY(5deg) scale(1.02)';
                    this.style.zIndex = '20';
                });

                card.addEventListener('mouseleave', function() {
                    hoverTimeout = setTimeout(() => {
                        this.style.transform =
                            'translateY(0) rotateX(0) rotateY(0) scale(1)';
                        this.style.zIndex = '10';
                    }, 100);
                });

                // Add subtle parallax effect
                card.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = (y - centerY) / 10;
                    const rotateY = (centerX - x) / 10;

                    this.style.transform =
                        `translateY(-15px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
                });
            });

            // Dynamic background color change based on scroll
            let lastScrollY = window.scrollY;
            window.addEventListener('scroll', () => {
                const scrollY = window.scrollY;
                const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
                const scrollPercent = scrollY / maxScroll;

                // Change background gradient based on scroll position
                const hue1 = 240 + (scrollPercent * 60); // 240 to 300
                const hue2 = 270 + (scrollPercent * 90); // 270 to 360

                document.body.style.background = `linear-gradient(135deg, 
                    hsl(${hue1}, 70%, 65%) 0%, 
                    hsl(${hue2}, 60%, 70%) 50%, 
                    hsl(${hue1 + 30}, 80%, 75%) 100%)`;

                lastScrollY = scrollY;
            });

            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Keyboard navigation enhancement
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.matches('.action-btn, .create-btn, .back-btn')) {
                    e.target.click();
                }
            });

            // Add floating action button for quick access
            const fab = document.createElement('div');
            fab.innerHTML = `
                <a href="{{ route('forums.create') }}" style="
                    position: fixed;
                    bottom: 30px;
                    right: 30px;
                    background: linear-gradient(135deg, #4ecdc4, #44a08d);
                    color: white;
                    width: 60px;
                    height: 60px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-decoration: none;
                    font-size: 24px;
                    box-shadow: 0 8px 25px rgba(78, 205, 196, 0.4);
                    transition: all 0.3s ease;
                    z-index: 1000;
                    animation: fabPulse 2s ease-in-out infinite;
                " onmouseover="this.style.transform='scale(1.1) rotate(90deg)'; this.style.boxShadow='0 12px 35px rgba(78, 205, 196, 0.6)';" 
                   onmouseout="this.style.transform='scale(1) rotate(0deg)'; this.style.boxShadow='0 8px 25px rgba(78, 205, 196, 0.4)';">
                    ✨
                </a>
            `;
            document.body.appendChild(fab);

            // Dynamic title animation
            let titleText = "Forum Diskusi Siswa - SMP Cerdas";
            let currentTitle = "";
            let charIndex = 0;

            function typeTitle() {
                if (charIndex < titleText.length) {
                    currentTitle += titleText.charAt(charIndex);
                    document.title = currentTitle;
                    charIndex++;
                    setTimeout(typeTitle, 100);
                } else {
                    setTimeout(() => {
                        currentTitle = "";
                        charIndex = 0;
                        setTimeout(typeTitle, 3000);
                    }, 2000);
                }
            }

            // Start title animation after page load
            setTimeout(typeTitle, 1000);

            // Add intersection observer for performance optimization
            const cardObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.willChange = 'transform';
                    } else {
                        entry.target.style.willChange = 'auto';
                    }
                });
            });

            cards.forEach(card => {
                cardObserver.observe(card);
            });

            // Enhanced success message auto-hide
            const successMessage = document.querySelector('.success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.animation = 'successSlide 0.5s ease-in reverse';
                    setTimeout(() => {
                        successMessage.remove();
                    }, 500);
                }, 5000);
            }

            // Add theme toggle functionality (bonus feature)
            const themeToggle = document.createElement('button');
            themeToggle.innerHTML = '🌙';
            themeToggle.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: rgba(255, 255, 255, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.3);
                color: white;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                font-size: 20px;
                cursor: pointer;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
                z-index: 1000;
            `;

            let isDarkMode = false;
            themeToggle.addEventListener('click', function() {
                isDarkMode = !isDarkMode;
                if (isDarkMode) {
                    document.body.style.filter = 'brightness(0.8) contrast(1.1)';
                    this.innerHTML = '☀️';
                } else {
                    document.body.style.filter = 'brightness(1) contrast(1)';
                    this.innerHTML = '🌙';
                }
            });

            document.body.appendChild(themeToggle);

            // Add subtle screen shake on delete confirmation
            window.confirm = function(message) {
                document.body.style.animation = 'shake 0.5s ease-in-out';
                setTimeout(() => {
                    document.body.style.animation = '';
                }, 500);
                return window.originalConfirm ? window.originalConfirm(message) : true;
            };
            window.originalConfirm = window.confirm;
        });

        // Add CSS for additional animations
        const additionalStyles = document.createElement('style');
        additionalStyles.textContent = `
            @keyframes fabPulse {
                0%, 100% { 
                    transform: scale(1); 
                    box-shadow: 0 8px 25px rgba(78, 205, 196, 0.4);
                }
                50% { 
                    transform: scale(1.05); 
                    box-shadow: 0 12px 35px rgba(78, 205, 196, 0.6);
                }
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
                20%, 40%, 60%, 80% { transform: translateX(2px); }
            }

            /* Smooth transitions for all elements */
            * {
                transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease;
            }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 12px;
            }

            ::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(135deg, #667eea, #764ba2);
                border-radius: 10px;
                border: 2px solid rgba(255, 255, 255, 0.2);
            }

            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(135deg, #764ba2, #f093fb);
            }

            /* Enhanced focus states for accessibility */
            .action-btn:focus,
            .create-btn:focus,
            .back-btn:focus {
                outline: 3px solid rgba(255, 255, 255, 0.8);
                outline-offset: 2px;
            }

            /* Loading state for buttons */
            .btn-loading {
                position: relative;
                color: transparent !important;
            }

            .btn-loading::after {
                content: '';
                position: absolute;
                width: 20px;
                height: 20px;
                top: 50%;
                left: 50%;
                margin-left: -10px;
                margin-top: -10px;
                border: 2px solid rgba(255, 255, 255, 0.3);
                border-top: 2px solid white;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            /* Responsive enhancements */
            @media (max-width: 480px) {
                .header h1 {
                    font-size: 2rem;
                }
                
                .forum-card {
                    margin-bottom: 20px;
                }
                
                .forum-header {
                    padding: 20px;
                }
                
                .forum-content {
                    padding: 20px;
                }
                
                .forum-actions {
                    padding: 15px 20px;
                }
            }

            /* High contrast mode support */
            @media (prefers-contrast: high) {
                .forum-card {
                    border: 2px solid #000;
                }
                
                .action-btn {
                    border: 1px solid #000;
                }
            }

            /* Reduced motion support */
            @media (prefers-reduced-motion: reduce) {
                * {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
            }
        `;
        document.head.appendChild(additionalStyles);
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Forum</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .bounce-animation {
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .pulse-animation {
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        /* Simple Gradient Background */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(59, 130, 246, 0.2);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: scale(1.02);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
        }

        .emoji-big {
            font-size: 2rem;
            display: inline-block;
            margin-right: 0.5rem;
        }

        .char-counter {
            font-size: 0.75rem;
            color: #6b7280;
            text-align: right;
            margin-top: 0.25rem;
        }

        .progress-bar {
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .fun-button {
            background: linear-gradient(45deg, #2563eb, #3b82f6);
            transform: perspective(1px) translateZ(0);
            transition: all 0.3s ease;
        }

        .fun-button:hover {
            background: linear-gradient(45deg, #1d4ed8, #2563eb);
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(59, 130, 246, 0.4);
        }

        .sparkle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #93c5fd;
            border-radius: 50%;
            animation: sparkle 1.5s ease-in-out infinite;
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .tooltip {
            position: relative;
        }

        .tooltip:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #1e40af;
            color: white;
            padding: 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 10;
        }

        /* Interactive mouse trail */
        .mouse-trail {
            position: fixed;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.6), transparent);
            pointer-events: none;
            z-index: 1;
            transition: all 0.1s ease;
        }

        /* Blue-themed gradients */
        .blue-text-gradient {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .blue-border-gradient {
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #3b82f6, #60a5fa) border-box;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-6 blue-gradient-bg"
    style="
  background-image: url('storage/images/LogoTA.png'); 
  background-size: 300px; 
  background-position: center; 
  background-repeat: no-repeat;
  background-blend-mode: soft-light;
">

    <!-- Interactive floating orbs -->
    <div class="interactive-orbs">
        <div class="orb"></div>
        <div class="orb"></div>
        <div class="orb"></div>
    </div>

    <!-- Floating decorative elements -->
    <div class="sparkle" style="top: 10%; left: 10%; animation-delay: 0s;"></div>
    <div class="sparkle" style="top: 20%; right: 15%; animation-delay: 0.5s;"></div>
    <div class="sparkle" style="bottom: 15%; left: 20%; animation-delay: 1s;"></div>
    <div class="sparkle" style="bottom: 25%; right: 10%; animation-delay: 1.5s;"></div>

    <div
        class="w-full max-w-4xl bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-8 blue-border-gradient card-hover floating-animation">
        <!-- Header with fun animation -->
        <div class="text-center mb-8">
            <div class="bounce-animation inline-block">
                <span class="emoji-big">🎯</span>
                <h1 class="text-4xl font-bold blue-text-gradient inline">
                    Buat Forum Diskusi Baru
                </h1>
                <span class="emoji-big">✨</span>
            </div>
            <p class="text-gray-600 mt-2 text-lg font-medium">Yuk, bagikan ide dan diskusi menarikmu di sini! 🚀</p>
        </div>

        <!-- Progress bar -->
        <div class="progress-bar">
            <div class="progress-fill" id="progressFill" style="width: 0%"></div>
        </div>

        {{-- Notifikasi Error --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-2 border-red-200 text-red-700 rounded-2xl shadow-lg bounce-animation">
                <div class="flex items-center mb-2">
                    <span class="text-2xl mr-2">⚠️</span>
                    <h3 class="font-bold text-lg">Oops! Ada yang perlu diperbaiki:</h3>
                </div>
                <ul class="list-none space-y-2 text-sm">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center">
                            <span class="text-red-500 mr-2">•</span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulir --}}
        <form action="{{ route('forums.store') }}" method="POST" class="space-y-8" id="forumForm">
            @csrf

            <input type="hidden" name="kelas" value="{{ Auth::user()->kelas }}">

            <!-- Title -->
            <div class="transform transition-all duration-300 hover:scale-105">
                <label for="title" class="flex items-center text-lg font-semibold text-gray-700 mb-3">
                    <span class="text-2xl mr-2">📌</span>
                    Judul Forum yang Menarik
                    <span class="tooltip ml-2 text-blue-500 cursor-help"
                        data-tooltip="Buat judul yang menarik perhatian teman-temanmu!">ℹ️</span>
                </label>
                <input type="text" id="title" name="title"
                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-200 transition-all duration-300 text-lg input-focus font-medium"
                    placeholder="Contoh: Diskusi Pelajaran Matematika yang Seru! 🧮" value="{{ old('title') }}"
                    maxlength="100" required>
                <div class="char-counter" id="titleCounter">0/100 karakter</div>
            </div>

            <!-- Description -->
            <div class="transform transition-all duration-300 hover:scale-105">
                <label for="description" class="flex items-center text-lg font-semibold text-gray-700 mb-3">
                    <span class="text-2xl mr-2">📝</span>
                    Deskripsi Singkat
                    <span class="tooltip ml-2 text-blue-500 cursor-help"
                        data-tooltip="Jelaskan secara singkat tentang apa forum ini">ℹ️</span>
                </label>
                <textarea id="description" name="description" rows="3"
                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-200 transition-all duration-300 text-lg input-focus resize-none font-medium"
                    placeholder="Ceritakan sedikit tentang topik yang ingin kamu diskusikan..." maxlength="200" required>{{ old('description') }}</textarea>
                <div class="char-counter" id="descCounter">0/200 karakter</div>
            </div>

            <!-- Content -->
            <div class="transform transition-all duration-300 hover:scale-105">
                <label for="content" class="flex items-center text-lg font-semibold text-gray-700 mb-3">
                    <span class="text-2xl mr-2">💬</span>
                    Isi Diskusi
                    <span class="tooltip ml-2 text-blue-500 cursor-help"
                        data-tooltip="Tulis pertanyaan atau topik diskusi secara detail">ℹ️</span>
                </label>
                <textarea id="content" name="content" rows="8"
                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-200 transition-all duration-300 text-lg input-focus resize-none font-medium"
                    placeholder="Tulis pertanyaan atau topik diskusi kamu di sini... Jangan lupa gunakan bahasa yang baik dan sopan ya! 😊"
                    maxlength="1000" required>{{ old('content') }}</textarea>
                <div class="char-counter" id="contentCounter">0/1000 karakter</div>
            </div>

            <!-- Fun Tips Section -->
            <div
                class="bg-gradient-to-r from-blue-50 to-sky-50 border-2 border-blue-200 rounded-2xl p-6 pulse-animation">
                <h3 class="flex items-center text-lg font-bold text-blue-700 mb-3">
                    <span class="text-2xl mr-2">💡</span>
                    Tips Bikin Forum Keren:
                </h3>
                <ul class="space-y-2 text-sm text-blue-600 font-medium">
                    <li class="flex items-center">
                        <span class="text-green-500 mr-2">✓</span>
                        Gunakan judul yang menarik dan mudah dipahami
                    </li>
                    <li class="flex items-center">
                        <span class="text-green-500 mr-2">✓</span>
                        Jelaskan pertanyaan dengan detail dan jelas
                    </li>
                    <li class="flex items-center">
                        <span class="text-green-500 mr-2">✓</span>
                        Gunakan bahasa yang sopan dan ramah
                    </li>
                    <li class="flex items-center">
                        <span class="text-green-500 mr-2">✓</span>
                        Tambahkan emoji untuk membuat lebih menarik! 🎉
                    </li>
                </ul>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8">
                <a href="{{ route('forums.index') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 text-lg font-semibold transition-all duration-300 hover:scale-105">
                    <span class="text-xl mr-2">←</span>
                    Kembali ke Forum
                </a>
                <button type="submit" id="submitBtn"
                    class="fun-button text-white font-bold px-8 py-4 rounded-2xl shadow-lg transition-all duration-300 text-lg flex items-center disabled:opacity-50 disabled:cursor-not-allowed">
                    <span class="text-xl mr-2">💾</span>
                    Buat Forum Sekarang!
                    <span class="text-xl ml-2">🚀</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        // Character counters and progress tracking
        const titleInput = document.getElementById('title');
        const descInput = document.getElementById('description');
        const contentInput = document.getElementById('content');
        const progressFill = document.getElementById('progressFill');
        const submitBtn = document.getElementById('submitBtn');

        function updateCharCounter(input, counterId, maxLength) {
            const counter = document.getElementById(counterId);
            const length = input.value.length;
            counter.textContent = `${length}/${maxLength} karakter`;

            if (length > maxLength * 0.8) {
                counter.style.color = '#ef4444';
            } else if (length > maxLength * 0.6) {
                counter.style.color = '#f59e0b';
            } else {
                counter.style.color = '#6b7280';
            }
        }

        function updateProgress() {
            const titleFilled = titleInput.value.length > 0;
            const descFilled = descInput.value.length > 0;
            const contentFilled = contentInput.value.length > 0;

            let progress = 0;
            if (titleFilled) progress += 33.33;
            if (descFilled) progress += 33.33;
            if (contentFilled) progress += 33.34;

            progressFill.style.width = `${progress}%`;

            // Enable submit button when all fields are filled
            if (progress === 100) {
                submitBtn.disabled = false;
                submitBtn.classList.add('bounce-animation');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.remove('bounce-animation');
            }
        }

        // Event listeners
        titleInput.addEventListener('input', function() {
            updateCharCounter(this, 'titleCounter', 100);
            updateProgress();
        });

        descInput.addEventListener('input', function() {
            updateCharCounter(this, 'descCounter', 200);
            updateProgress();
        });

        contentInput.addEventListener('input', function() {
            updateCharCounter(this, 'contentCounter', 1000);
            updateProgress();
        });

        // Form submission with fun animation
        document.getElementById('forumForm').addEventListener('submit', function() {
            submitBtn.innerHTML =
                '<span class="text-xl mr-2">⏳</span>Sedang Membuat Forum...<span class="text-xl ml-2">✨</span>';
            submitBtn.disabled = true;
        });

        // Initialize counters and progress
        updateCharCounter(titleInput, 'titleCounter', 100);
        updateCharCounter(descInput, 'descCounter', 200);
        updateCharCounter(contentInput, 'contentCounter', 1000);
        updateProgress();

        // Add some fun interactions
        document.querySelectorAll('input, textarea').forEach(element => {
            element.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });

            element.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Interactive mouse trail effect
        let mouseTrails = [];
        document.addEventListener('mousemove', function(e) {
            // Limit the number of trails
            if (mouseTrails.length > 5) {
                const oldTrail = mouseTrails.shift();
                oldTrail.remove();
            }

            // Create new trail
            const trail = document.createElement('div');
            trail.className = 'mouse-trail';
            trail.style.left = (e.pageX - 10) + 'px';
            trail.style.top = (e.pageY - 10) + 'px';

            document.body.appendChild(trail);
            mouseTrails.push(trail);

            // Fade out and remove
            setTimeout(() => {
                trail.style.opacity = '0';
                setTimeout(() => {
                    if (trail.parentNode) {
                        trail.remove();
                        mouseTrails = mouseTrails.filter(t => t !== trail);
                    }
                }, 200);
            }, 100);
        });

        // Fun click effects with blue theme
        document.addEventListener('click', function(e) {
            // Create a ripple effect
            const ripple = document.createElement('div');
            ripple.style.position = 'fixed';
            ripple.style.width = '20px';
            ripple.style.height = '20px';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(59, 130, 246, 0.4)';
            ripple.style.left = e.pageX - 10 + 'px';
            ripple.style.top = e.pageY - 10 + 'px';
            ripple.style.pointerEvents = 'none';
            ripple.style.animation = 'sparkle 0.6s ease-out forwards';
            ripple.style.zIndex = '1000';

            document.body.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    </script>
</body>

</html>

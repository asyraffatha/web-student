<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forum Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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

        /* Floating elements animation */
        .floating-element {
            position: absolute;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Enhanced text glow */
        .text-glow {
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.5), 0 0 20px rgba(59, 130, 246, 0.3);
        }

        /* Comment animation */
        .comment-slide-in {
            animation: slideIn 0.5s ease-out;
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

        /* Like animation */
        .like-pulse {
            animation: likePulse 0.6s ease;
        }

        @keyframes likePulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Typing indicator */
        .typing-indicator {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .typing-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #3b82f6;
            animation: typing 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) {
            animation-delay: -0.32s;
        }

        .typing-dot:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes typing {

            0%,
            80%,
            100% {
                transform: scale(0);
                opacity: 0.5;
            }

            40% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="min-h-screen gradient-bg relative overflow-x-hidden">
    <!-- Floating decorative elements -->
    <div class="floating-element top-10 left-10 w-4 h-4 bg-white/20 rounded-full"></div>
    <div class="floating-element top-32 right-20 w-6 h-6 bg-blue-200/30 rounded-full" style="animation-delay: -2s;"></div>
    <div class="floating-element bottom-20 left-1/4 w-3 h-3 bg-purple-200/40 rounded-full" style="animation-delay: -4s;">
    </div>

    <!-- Mouse trail elements -->
    <div class="mouse-trail" id="trail1"></div>
    <div class="mouse-trail" id="trail2" style="animation-delay: 0.1s;"></div>
    <div class="mouse-trail" id="trail3" style="animation-delay: 0.2s;"></div>

    <div class="min-h-screen flex items-center justify-center p-6">
        <div
            class="relative z-10 max-w-3xl w-full bg-white/95 backdrop-blur-lg shadow-2xl rounded-3xl p-8 space-y-8 text-gray-800 card-hover">

            <!-- Progress bar at top -->
            <div class="progress-bar">
                <div class="progress-fill" style="width: 100%;"></div>
            </div>

            <!-- Back button with enhanced styling -->
            <div>
                <a href="{{ route('forums.index') }}"
                    class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 text-sm font-semibold mb-4 transition-all duration-300 hover:gap-3 tooltip"
                    data-tooltip="Kembali ke daftar forum">
                    <span class="text-lg">←</span> Kembali ke Forum
                </a>
            </div>

            <!-- Enhanced title section -->
            <div class="relative">
                <h1 class="text-3xl md:text-4xl font-extrabold blue-text-gradient text-glow drop-shadow-sm">
                    {{ $forum->title }}
                </h1>
                <div class="sparkle" style="top: 10px; right: 20px; animation-delay: 0.5s;"></div>
                <div class="sparkle" style="top: 30px; right: 40px; animation-delay: 1s;"></div>

                <div class="mt-3 flex items-center gap-4 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <span class="emoji-big">👤</span>
                        <span class="font-medium">{{ $forum->user->name }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="emoji-big">⏰</span>
                        <span>{{ $forum->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Enhanced content section -->
            <div
                class="prose max-w-none text-gray-700 leading-relaxed blue-border-gradient rounded-xl p-6 bg-gradient-to-r from-blue-50 to-purple-50">
                <p class="text-lg">{{ $forum->content }}</p>
            </div>

            <hr class="border-gradient border-t-2 bg-gradient-to-r from-blue-300 to-purple-300">

            <!-- Enhanced comments section -->
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <span class="emoji-big">💬</span>
                    <span class="blue-text-gradient">Komentar</span>
                    <span class="text-sm font-normal text-gray-500">({{ count($forum->comments) }})</span>
                </h2>

                <div id="comments-container" class="space-y-4">
                    @forelse ($forum->comments as $index => $comment)
                        <div class="comment-slide-in bg-white border-l-4 border-blue-500 rounded-lg p-5 shadow-md transition-all duration-300 hover:shadow-lg hover:bg-blue-50/50 card-hover"
                            style="animation-delay: {{ $index * 0.1 }}s;">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-sm font-bold text-blue-700 flex items-center gap-2">
                                    <span
                                        class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </span>
                                    {{ $comment->user->name }}
                                </p>
                                <div class="flex items-center gap-2">
                                    <button class="like-btn text-gray-400 hover:text-red-500 transition-colors tooltip"
                                        data-tooltip="Like this comment">
                                        ❤️ <span class="like-count">0</span>
                                    </button>
                                    @if (auth()->id() === $comment->user_id || (auth()->user() && auth()->user()->is_admin))
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Hapus komentar ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-2 text-xs text-red-500 hover:text-red-700"
                                                title="Hapus Komentar">
                                                🗑️
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <p class="text-gray-800 leading-relaxed">{{ $comment->content }}</p>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl">
                            <div class="emoji-big mb-4">🤔</div>
                            <p class="text-gray-500 italic text-lg">Belum ada komentar. Jadilah yang pertama untuk
                                membagikan pendapatmu!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Enhanced comment form -->
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6 blue-border-gradient">
                <form action="{{ route('comments.store', $forum->id) }}" method="POST" class="space-y-4"
                    id="comment-form">
                    @csrf
                    <div>
                        <label for="content" class="flex items-center text-lg font-semibold text-gray-700 mb-3">
                            <span class="emoji-big">✍️</span>
                            <span class="blue-text-gradient">Berikan Komentarmu</span>
                        </label>
                        <div class="relative">
                            <textarea id="content" name="content" rows="4" maxlength="500"
                                class="w-full rounded-xl border-2 border-gray-200 p-4 shadow-sm input-focus focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500 transition bg-white/80 backdrop-blur-sm resize-none"
                                placeholder="Bagikan pemikiranmu... Apa pendapatmu tentang topik ini?" required></textarea>
                            <div class="char-counter">
                                <span id="char-count">0</span>/500 characters
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="typing-indicator" id="typing-indicator" style="display: none;">
                            <span class="text-sm text-gray-500">Mengetik...</span>
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                        </div>
                        <button type="submit"
                            class="fun-button text-white font-bold px-8 py-3 rounded-xl shadow-lg transition duration-300 flex items-center gap-2 tooltip"
                            data-tooltip="Bagikan komentar Anda dengan komunitas">
                            <span class="emoji-big" style="font-size: 1.2rem;">🚀</span>
                            Kirim Komentar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mouse trail effect
        let mouseX = 0,
            mouseY = 0;
        let trail1X = 0,
            trail1Y = 0;
        let trail2X = 0,
            trail2Y = 0;
        let trail3X = 0,
            trail3Y = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        function updateTrail() {
            const speed = 0.1;

            trail1X += (mouseX - trail1X) * speed;
            trail1Y += (mouseY - trail1Y) * speed;

            trail2X += (trail1X - trail2X) * speed;
            trail2Y += (trail1Y - trail2Y) * speed;

            trail3X += (trail2X - trail3X) * speed;
            trail3Y += (trail2Y - trail3Y) * speed;

            document.getElementById('trail1').style.left = trail1X + 'px';
            document.getElementById('trail1').style.top = trail1Y + 'px';

            document.getElementById('trail2').style.left = trail2X + 'px';
            document.getElementById('trail2').style.top = trail2Y + 'px';

            document.getElementById('trail3').style.left = trail3X + 'px';
            document.getElementById('trail3').style.top = trail3Y + 'px';

            requestAnimationFrame(updateTrail);
        }
        updateTrail();

        // Character counter for textarea
        const textarea = document.getElementById('content');
        const charCount = document.getElementById('char-count');
        const typingIndicator = document.getElementById('typing-indicator');
        let typingTimer;

        textarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = length;

            // Color coding for character count
            if (length > 400) {
                charCount.style.color = '#ef4444';
            } else if (length > 300) {
                charCount.style.color = '#f59e0b';
            } else {
                charCount.style.color = '#6b7280';
            }

            // Typing indicator
            typingIndicator.style.display = 'flex';
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                typingIndicator.style.display = 'none';
            }, 1000);
        });

        // Like button toggle functionality
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const likeCount = this.querySelector('.like-count');
                let currentCount = parseInt(likeCount.textContent);

                // Toggle state pakai data-liked attribute
                if (this.dataset.liked === "true") {
                    // UNLIKE
                    likeCount.textContent = currentCount > 0 ? currentCount - 1 : 0;
                    this.dataset.liked = "false";
                    this.style.color = ''; // Kembali ke warna default
                } else {
                    // LIKE
                    likeCount.textContent = currentCount + 1;
                    this.dataset.liked = "true";
                    this.classList.add('like-pulse');
                    this.style.color = '#ef4444';
                    setTimeout(() => {
                        this.classList.remove('like-pulse');
                    }, 600);
                }
            });
        });

        // Form submission with loading state
        document.getElementById('comment-form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<span class="emoji-big animate-spin">⏳</span> Sending...';
            submitBtn.disabled = true;

            // In a real application, this would be handled by the server response
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });

        // Add sparkle effects on hover
        document.querySelector('h1').addEventListener('mouseenter', function() {
            // Add more sparkles on title hover
            for (let i = 0; i < 3; i++) {
                setTimeout(() => {
                    const sparkle = document.createElement('div');
                    sparkle.className = 'sparkle';
                    sparkle.style.left = Math.random() * 200 + 'px';
                    sparkle.style.top = Math.random() * 50 + 'px';
                    this.appendChild(sparkle);

                    setTimeout(() => {
                        sparkle.remove();
                    }, 1500);
                }, i * 200);
            }
        });

        // Smooth scroll to comments when clicking comment count
        document.querySelector('h2').addEventListener('click', function() {
            this.scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>

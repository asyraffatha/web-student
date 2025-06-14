<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pilih Guru Favorit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(-45deg, #1e3a8a, #3b82f6, #60a5fa, #93c5fd, #1e40af, #2563eb);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: relative;
            overflow-x: hidden;
        }

        @keyframes gradientBG {
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

        /* Floating particles */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .teacher-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .teacher-card:hover {
            transform: translateY(-15px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 1);
        }

        .teacher-avatar {
            transition: all 0.3s ease;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .teacher-card:hover .teacher-avatar {
            transform: scale(1.1) rotate(5deg);
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.2));
        }

        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }

            80%,
            100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }

        .floating-icon {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .title-glow {
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
        }

        .sparkle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            animation: sparkle 2s linear infinite;
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
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Floating particles -->
    <div class="particle" style="left: 10%; width: 20px; height: 20px; animation-delay: 0s;"></div>
    <div class="particle" style="left: 20%; width: 15px; height: 15px; animation-delay: 2s;"></div>
    <div class="particle" style="left: 30%; width: 25px; height: 25px; animation-delay: 4s;"></div>
    <div class="particle" style="left: 40%; width: 18px; height: 18px; animation-delay: 6s;"></div>
    <div class="particle" style="left: 50%; width: 22px; height: 22px; animation-delay: 8s;"></div>
    <div class="particle" style="left: 60%; width: 16px; height: 16px; animation-delay: 10s;"></div>
    <div class="particle" style="left: 70%; width: 24px; height: 24px; animation-delay: 12s;"></div>
    <div class="particle" style="left: 80%; width: 19px; height: 19px; animation-delay: 14s;"></div>
    <div class="particle" style="left: 90%; width: 21px; height: 21px; animation-delay: 16s;"></div>

    <div class="relative">
        <!-- Tombol Back to Home -->
        <div class="mb-6">
            <a href="{{ route('home') }}"
                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full shadow hover:from-blue-600 hover:to-purple-700 transition-all duration-300 font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Home
            </a>
        </div>
        <!-- Sparkles around title -->
        <div class="sparkle" style="top: 20px; left: 50px; animation-delay: 0.5s;"></div>
        <div class="sparkle" style="top: 40px; right: 30px; animation-delay: 1s;"></div>
        <div class="sparkle" style="bottom: 60px; left: 80px; animation-delay: 1.5s;"></div>
        <div class="sparkle" style="bottom: 40px; right: 60px; animation-delay: 2s;"></div>

        <div
            class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-3xl shadow-2xl p-10 max-w-4xl w-full border border-white border-opacity-30">
            <div class="text-center mb-12">
                <div class="floating-icon inline-block mb-4">
                    <div class="text-6xl">🎓</div>
                </div>
                <h1 class="text-5xl font-extrabold text-white mb-4 title-glow">
                    Guru yang Siap Membimbingmu
                </h1>
                <p class="text-xl text-blue-100 font-medium">
                    Yuk, mulai diskusi dan belajar bareng!
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
                @foreach ($gurus as $guru)
                    <a href="{{ route('discussion.show', $guru->id) }}"
                        class="teacher-card w-full max-w-xs rounded-2xl p-8 shadow-lg relative overflow-hidden block no-underline">
                        <div
                            class="absolute inset-0 pulse-ring bg-gradient-to-r from-blue-400 to-purple-500 opacity-20 rounded-2xl">
                        </div>
                        <div class="relative z-10 flex flex-col items-center justify-center">
                            <div class="relative mb-6">
                                <img src="https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortFlat&accessoriesType=Blank&hairColor=Brown&facialHairType=Blank&clotheType=ShirtCrewNeck&eyeType=Happy&eyebrowType=Default&mouthType=Smile&skinColor=Light"
                                    alt="Avatar {{ $guru->name }}"
                                    class="teacher-avatar w-28 h-28 rounded-full border-4 border-white shadow-lg">
                                <div
                                    class="absolute -top-2 -right-2 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm">✓</span>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $guru->name }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ $guru->subject ?? 'Guru' }}</p>
                            <div class="flex space-x-1 mb-4">
                                <span class="text-yellow-400">⭐</span>
                                <span class="text-yellow-400">⭐</span>
                                <span class="text-yellow-400">⭐</span>
                                <span class="text-yellow-400">⭐</span>
                                <span class="text-yellow-400">⭐</span>
                            </div>
                            <div
                                class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-full font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 text-center">
                                Mulai Bertanya
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <p class="text-blue-100 text-lg">
                    💡 Tip: Jangan ragu untuk bertanya pada gurumu jika ada yang belum dipahami!
                </p>
            </div>
        </div>
    </div>

    <script>
        // Add interactive hover effects
        document.querySelectorAll('.teacher-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px) scale(1.05)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });

            // Add click effect for the entire card
            card.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    </script>

    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ke Mathporia</title>
    @vite('resources/css/app.css')
    <style>
        /* Animated Background */
        body {
            background: linear-gradient(135deg, #6366f1, #8b5cf6, #3b82f6);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: relative;
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

        /* Floating Math Elements */
        .math-world {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .math-element {
            position: absolute;
            opacity: 0.8;
            pointer-events: none;
        }

        /* Math formulas floating around */
        .formula {
            color: rgba(255, 255, 255, 0.7);
            font-size: 24px;
            font-family: 'Arial', sans-serif;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }

        /* Characters */
        .character {
            position: absolute;
            z-index: 2;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
            transition: transform 0.3s ease;
        }

        .character:hover {
            transform: scale(1.1);
        }

        .calculator-robot {
            bottom: 5%;
            left: 5%;
            width: 160px;
            height: 160px;
            animation: float 6s ease-in-out infinite;
        }

        .math-girl {
            top: 10%;
            right: 5%;
            width: 180px;
            height: 180px;
            animation: float 7s ease-in-out infinite reverse;
        }

        .math-boy {
            bottom: 8%;
            right: 8%;
            width: 150px;
            height: 150px;
            animation: float 5s ease-in-out infinite 1s;
        }

        .pi-wizard {
            top: 12%;
            left: 8%;
            width: 140px;
            height: 140px;
            animation: float 8s ease-in-out infinite 0.5s;
        }

        /* Floating animations */
        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            25% {
                transform: translateY(-15px) rotate(2deg);
            }

            50% {
                transform: translateY(0px) rotate(0deg);
            }

            75% {
                transform: translateY(15px) rotate(-2deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        /* Particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.7);
            pointer-events: none;
        }

        /* Login Card Styling */
        .login-container {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.3);
        }

        /* Input fields */
        .input-field {
            position: relative;
            transition: all 0.3s ease;
        }

        .input-field input,
        .input-field select {
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .input-field input:focus,
        .input-field select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            transform: translateY(-2px);
        }

        /* Login button pulse effect */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
            }
        }

        .login-btn {
            animation: pulse 2s infinite;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Back to Welcome button */
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 20;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateX(-5px);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 overflow-hidden relative">
    <!-- Back to Welcome Button -->
    <a href="{{ route('welcome') }}"
        class="back-button flex items-center px-4 py-2 rounded-lg bg-white/80 backdrop-blur-sm text-indigo-600 font-medium hover:bg-white/90 shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                clip-rule="evenodd" />
        </svg>
        Kembali ke Beranda
    </a>

    <!-- Floating Math World -->
    <div class="math-world" id="mathWorld"></div>

    <!-- Math Characters -->
    <svg class="character calculator-robot" viewBox="0 0 240 240" xmlns="http://www.w3.org/2000/svg">
        <!-- Robot Head -->
        <rect x="70" y="30" width="100" height="80" rx="15" fill="#4F46E5" />
        <rect x="85" y="45" width="70" height="35" rx="5" fill="#E2E8F0" />

        <!-- Robot Eyes -->
        <circle cx="105" cy="62" r="10" fill="#1E293B" />
        <circle cx="105" cy="62" r="4" fill="#38BDF8" />
        <circle cx="135" cy="62" r="10" fill="#1E293B" />
        <circle cx="135" cy="62" r="4" fill="#38BDF8" />

        <!-- Robot Antennas -->
        <rect x="95" y="10" width="6" height="20" fill="#94A3B8" />
        <circle cx="98" cy="5" r="5" fill="#F43F5E" />
        <rect x="140" y="10" width="6" height="20" fill="#94A3B8" />
        <circle cx="143" cy="5" r="5" fill="#F43F5E" />

        <!-- Robot Body -->
        <rect x="60" y="110" width="120" height="90" rx="10" fill="#3730A3" />

        <!-- Calculator Screen -->
        <rect x="80" y="125" width="80" height="30" rx="5" fill="#E2E8F0" />
        <text x="85" y="147" font-family="monospace" font-size="16" fill="#1E293B">1+1=2</text>

        <!-- Calculator Buttons -->
        <circle cx="90" cy="170" r="10" fill="#10B981" />
        <text x="86" y="175" font-family="monospace" font-size="16" fill="#fff">+</text>

        <circle cx="120" cy="170" r="10" fill="#EF4444" />
        <text x="116" y="175" font-family="monospace" font-size="16" fill="#fff">-</text>

        <circle cx="150" cy="170" r="10" fill="#F59E0B" />
        <text x="146" y="175" font-family="monospace" font-size="16" fill="#fff">×</text>

        <circle cx="90" cy="200" r="10" fill="#3B82F6" />
        <text x="86" y="205" font-family="monospace" font-size="16" fill="#fff">÷</text>

        <circle cx="120" cy="200" r="10" fill="#8B5CF6" />
        <text x="116" y="205" font-family="monospace" font-size="16" fill="#fff">=</text>

        <circle cx="150" cy="200" r="10" fill="#EC4899" />
        <text x="146" y="205" font-family="monospace" font-size="16" fill="#fff">C</text>
    </svg>

    <svg class="character math-girl" viewBox="0 0 240 240" xmlns="http://www.w3.org/2000/svg">
        <!-- Math Girl -->
        <!-- Head -->
        <circle cx="120" cy="70" r="50" fill="#FECDD3" />

        <!-- Hair -->
        <path d="M70,85 Q60,40 120,30 Q180,40 170,85 Z" fill="#7F1D1D" />
        <path d="M75,40 Q85,20 105,25" stroke="#7F1D1D" stroke-width="10" stroke-linecap="round" fill="none" />
        <path d="M165,40 Q155,20 135,25" stroke="#7F1D1D" stroke-width="10" stroke-linecap="round" fill="none" />

        <!-- Face -->
        <circle cx="100" cy="65" r="6" fill="#1E293B" />
        <circle cx="140" cy="65" r="6" fill="#1E293B" />

        <!-- Smile -->
        <path d="M105,85 Q120,100 135,85" stroke="#1E293B" stroke-width="3" fill="none" />

        <!-- Blush -->
        <circle cx="90" cy="80" r="8" fill="#FECACA" opacity="0.7" />
        <circle cx="150" cy="80" r="8" fill="#FECACA" opacity="0.7" />

        <!-- Body -->
        <path d="M85,120 Q120,140 155,120 L160,190 Q120,210 80,190 Z" fill="#F472B6" />

        <!-- Arms -->
        <path d="M85,130 Q65,150 60,180" stroke="#FECDD3" stroke-width="15" stroke-linecap="round" fill="none" />
        <path d="M155,130 Q175,150 180,180" stroke="#FECDD3" stroke-width="15" stroke-linecap="round"
            fill="none" />

        <!-- Math Symbols on Dress -->
        <text x="105" y="160" font-family="serif" font-size="16" font-weight="bold" fill="white">2+2=4</text>
        <text x="110" y="180" font-family="serif" font-size="14" font-weight="bold" fill="white">πr²</text>
    </svg>

    <svg class="character math-boy" viewBox="0 0 240 240" xmlns="http://www.w3.org/2000/svg">
        <!-- Math Boy -->
        <!-- Head -->
        <circle cx="120" cy="70" r="50" fill="#FDE68A" />

        <!-- Hair -->
        <path d="M80,50 Q100,20 120,20 Q140,20 160,50" fill="#78350F" />
        <path d="M80,50 L90,45 L100,52 L110,44 L120,53 L130,44 L140,52 L150,45 L160,50" fill="#78350F" />

        <!-- Face -->
        <circle cx="100" cy="65" r="6" fill="#1E293B" />
        <circle cx="140" cy="65" r="6" fill="#1E293B" />

        <!-- Smile -->
        <path d="M105,85 Q120,95 135,85" stroke="#1E293B" stroke-width="3" fill="none" />

        <!-- Body -->
        <rect x="90" y="120" width="60" height="80" fill="#3B82F6" />

        <!-- Arms -->
        <path d="M90,130 Q70,150 65,180" stroke="#FDE68A" stroke-width="15" stroke-linecap="round" fill="none" />
        <path d="M150,130 Q170,150 175,180" stroke="#FDE68A" stroke-width="15" stroke-linecap="round"
            fill="none" />

        <!-- Math Notebook -->
        <rect x="125" y="145" width="35" height="40" fill="white" stroke="#1E293B" stroke-width="2" />
        <line x1="130" y1="155" x2="155" y2="155" stroke="#1E293B" stroke-width="1" />
        <line x1="130" y1="165" x2="155" y2="165" stroke="#1E293B" stroke-width="1" />
        <line x1="130" y1="175" x2="155" y2="175" stroke="#1E293B" stroke-width="1" />
        <text x="135" y="152" font-family="monospace" font-size="8" fill="#1E293B">x²+y²</text>
        <text x="138" y="172" font-family="monospace" font-size="8" fill="#1E293B">∑i=1</text>
    </svg>

    <svg class="character pi-wizard" viewBox="0 0 240 240" xmlns="http://www.w3.org/2000/svg">
        <!-- Pi Wizard -->
        <!-- Wizard Hat -->
        <path d="M120,30 L80,100 L160,100 Z" fill="#7E22CE" />
        <circle cx="120" cy="95" r="10" fill="#F0ABFC" />

        <!-- Head -->
        <circle cx="120" cy="120" r="30" fill="#DDD6FE" />

        <!-- Face -->
        <circle cx="110" cy="115" r="4" fill="#4C1D95" />
        <circle cx="130" cy="115" r="4" fill="#4C1D95" />
        <path d="M110,130 Q120,140 130,130" stroke="#4C1D95" stroke-width="2" fill="none" />

        <!-- Beard -->
        <path d="M95,125 Q120,170 145,125" fill="#A1A1AA" />

        <!-- Pi Symbol on Robe -->
        <path d="M90,150 L150,150 M96,150 L96,190 M144,150 L144,190" stroke="#7E22CE" stroke-width="8"
            stroke-linecap="round" fill="none" />

        <!-- Magic Wand -->
        <line x1="70" y1="140" x2="90" y2="120" stroke="#78350F" stroke-width="4" />
        <circle cx="65" cy="145" r="5" fill="#FBBF24" />
    </svg>

    <!-- Login Form Card -->
    <div class="login-container w-full max-w-md rounded-2xl p-8 space-y-6">
        <div class="text-center">
            <h2
                class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 via-purple-500 to-blue-500">
                Login ke Mathporia
            </h2>
            <p class="mt-3 text-gray-600">Masukkan email dan password Anda untuk masuk</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Role Selection -->
            <div class="input-field">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Masuk sebagai</label>
                <select id="role" name="role" required
                    class="block w-full px-4 py-3 rounded-lg focus:outline-none">
                    <option value="siswa">Siswa</option>
                    <option value="guru">Guru</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Email -->
            <div class="input-field">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input id="email" type="email" name="email" required autofocus autocomplete="username"
                    class="block w-full px-4 py-3 rounded-lg focus:outline-none" placeholder="emailanda@example.com">
            </div>

            <!-- Password -->
            <div class="input-field">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full px-4 py-3 rounded-lg focus:outline-none" placeholder="••••••••">
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded-md border-gray-300 text-indigo-600 focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-gray-600">Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}"
                    class="text-indigo-600 hover:text-indigo-800 transition font-medium">
                    Lupa password?
                </a>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="login-btn w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 transform">
                    Masuk
                </button>
            </div>
        </form>

        <p class="text-center text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold transition">
                Daftar sekarang
            </a>
        </p>
    </div>

    <!-- JavaScript for dynamic effects -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mathWorld = document.getElementById('mathWorld');

            // Add floating math formulas
            const formulas = ['∫', '∑', '√', 'π', '∞', '∂', 'Δ', 'λ', 'θ', 'n!', 'x²', 'y=mx+b'];

            formulas.forEach(formula => {
                createFloatingFormula(formula);
            });

            // Create sparkly particles
            for (let i = 0; i < 50; i++) {
                createParticle();
            }

            // Interact with characters on hover
            document.querySelectorAll('.character').forEach(char => {
                char.addEventListener('mouseover', function() {
                    this.style.filter = 'drop-shadow(0 0 10px rgba(255, 255, 255, 0.8))';
                });

                char.addEventListener('mouseout', function() {
                    this.style.filter = 'drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2))';
                });
            });

            // Function to create floating formulas
            function createFloatingFormula(text) {
                const formula = document.createElement('div');
                formula.className = 'math-element formula';
                formula.textContent = text;
                formula.style.left = Math.random() * 100 + '%';
                formula.style.top = Math.random() * 100 + '%';
                formula.style.opacity = Math.random() * 0.5 + 0.2;
                formula.style.fontSize = Math.floor(Math.random() * 24 + 12) + 'px';

                // Animation
                const duration = Math.random() * 100 + 50;
                formula.style.animation = `float ${duration}s linear infinite`;

                mathWorld.appendChild(formula);
            }

            // Function to create particles
            function createParticle() {
                const particle = document.createElement('div');
                particle.className = 'math-element particle';

                // Random size
                const size = Math.random() * 6 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';

                // Random position
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';

                // Random opacity
                particle.style.opacity = Math.random() * 0.7 + 0.3;

                // Add sparkle effect
                const duration = Math.random() * 50 + 10;
                const delay = Math.random() * 10;
                particle.style.animation = `float ${duration}s ease-in-out infinite ${delay}s`;

                mathWorld.appendChild(particle);
            }

            // Add interactivity to input fields
            const inputFields = document.querySelectorAll('input, select');
            inputFields.forEach(field => {
                field.addEventListener('focus', function() {
                    // Create small burst of particles around input
                    for (let i = 0; i < 5; i++) {
                        const particle = document.createElement('div');
                        particle.className = 'particle';
                        particle.style.position = 'absolute';
                        particle.style.width = '8px';
                        particle.style.height = '8px';
                        particle.style.backgroundColor = 'rgba(99, 102, 241, 0.7)';
                        particle.style.borderRadius = '50%';

                        const rect = this.getBoundingClientRect();
                        particle.style.left = (rect.left + Math.random() * rect.width) + 'px';
                        particle.style.top = (rect.top + Math.random() * rect.height) + 'px';

                        // Animation
                        particle.style.animation = 'float 2s ease-out forwards';
                        particle.style.opacity = '1';
                        document.body.appendChild(particle);

                        // Remove after animation
                        setTimeout(() => {
                            document.body.removeChild(particle);
                        }, 2000);
                    }
                });
            });
        });
    </script>
</body>

</html>

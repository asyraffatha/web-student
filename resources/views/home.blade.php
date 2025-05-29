<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Mathporia - Dashboard</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .pulse-animation {
            animation: pulse 2s infinite;
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

        .bounce-animation {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            53%,
            80%,
            100% {
                transform: translate3d(0, 0, 0);
            }

            40%,
            43% {
                transform: translate3d(0, -10px, 0);
            }

            70% {
                transform: translate3d(0, -5px, 0);
            }

            90% {
                transform: translate3d(0, -2px, 0);
            }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .sidebar-item {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .sidebar-item:hover::before {
            left: 100%;
        }

        .progress-bar {
            background: linear-gradient(90deg, #4ade80, #22c55e);
            border-radius: 10px;
            height: 8px;
            position: relative;
            overflow: hidden;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .notification-dot {
            animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        @keyframes ping {

            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar dengan animasi -->
        <aside class="w-64 bg-white shadow-2xl relative overflow-y-auto flex-shrink-0">
            <!-- Background pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0"
                    style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0,0,0,.1) 10px, rgba(0,0,0,.1) 20px);">
                </div>
            </div>

            <!-- Logo dengan animasi float -->
            <div class="p-6 border-b border-gray-200 relative z-10">
                <div class="flex items-center justify-center">
                    <div class="float-animation bg-gradient-to-r from-blue-500 to-purple-600 p-3 rounded-xl shadow-lg">
                        <i class="fas fa-calculator text-white text-2xl"></i>
                    </div>
                    <div class="flex items-center justify-between">
                        <img src="{{ asset('images/LogoT.png') }}" alt="Logo Mathporia"
                            class="max-h-24 w-auto flex-shrink-0">
                    </div>
                </div>
            </div>

            <!-- Search Bar dengan efek focus -->
            <div class="p-4 relative z-10">
                <div class="relative group">
                    <input type="text"
                        class="w-full bg-gray-100 text-gray-800 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300 shadow-inner"
                        placeholder="Cari materi...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i
                            class="fas fa-search text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300"></i>
                    </div>
                </div>
            </div>

            <nav class="mt-2 px-4 relative z-10">
                <!-- Navigation dengan hover effects -->
                <div class="space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('home') }}"
                        class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md">
                        <i class="fas fa-home mr-3 text-lg"></i>
                        <span>Dashboard</span>
                        <div class="ml-auto w-2 h-2 bg-white rounded-full pulse-animation"></div>
                    </a>

                    <!-- Take Material Dropdown -->
                    <div class="space-y-1">
                        <button onclick="toggleDropdown('material')"
                            class="sidebar-item w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-green-500 hover:to-green-600 hover:text-white focus:outline-none transition-all duration-300">
                            <div class="flex items-center">
                                <i class="fas fa-book-open mr-3 text-lg"></i>
                                <span>Materi Belajar</span>
                            </div>
                            <i id="material-arrow" class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div class="hidden space-y-1 pl-8 material-dropdown" id="material-dropdown">
                            <a href="{{ route('material') }}"
                                class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-green-100 hover:text-green-700 transition-all duration-200">
                                <i class="fas fa-list-ul mr-2 text-xs"></i>
                                Daftar Materi
                            </a>
                            <a href="{{ route('discussion') }}"
                                class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-green-100 hover:text-green-700 transition-all duration-200">
                                <i class="fas fa-comments mr-2 text-xs"></i>
                                Diskusi dengan Guru
                                <span
                                    class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full notification-dot">2</span>
                            </a>
                        </div>
                    </div>

                    <!-- Quiz Dropdown -->
                    <div class="space-y-1">
                        <button onclick="toggleDropdown('quiz')"
                            class="sidebar-item w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-purple-500 hover:to-purple-600 hover:text-white focus:outline-none transition-all duration-300">
                            <div class="flex items-center">
                                <i class="fas fa-question-circle mr-3 text-lg"></i>
                                <span>Kuis & Latihan</span>
                            </div>
                            <i id="quiz-arrow" class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div class="hidden space-y-1 pl-8" id="quiz-dropdown">
                            <a href="{{ route('quizzes.index') }}"
                                class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-purple-100 hover:text-purple-700 transition-all duration-200">
                                <i class="fas fa-play mr-2 text-xs"></i>
                                Mulai Kuis
                                <span
                                    class="ml-auto bg-yellow-400 text-yellow-800 text-xs px-2 py-1 rounded-full">Hot!</span>
                            </a>
                            <a href="https://www.desmos.com/scientific"
                                class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-purple-100 hover:text-purple-700 transition-all duration-200">
                                <i class="fas fa-calculator mr-2 text-xs"></i>
                                Kalkulator Ilmiah
                            </a>
                            <a href="#"
                                class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-purple-100 hover:text-purple-700 transition-all duration-200">
                                <i class="fas fa-history mr-2 text-xs"></i>
                                Riwayat Nilai
                            </a>
                        </div>
                    </div>

                    <!-- Members Dropdown -->
                    <div class="space-y-1">
                        <button onclick="toggleDropdown('member')"
                            class="sidebar-item w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-orange-500 hover:to-orange-600 hover:text-white focus:outline-none transition-all duration-300">
                            <div class="flex items-center">
                                <i class="fas fa-users mr-3 text-lg"></i>
                                <span>Komunitas</span>
                            </div>
                            <i id="member-arrow" class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div class="hidden space-y-1 pl-8" id="member-dropdown">
                            <a href="{{ route('forums.index') }}"
                                class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-orange-100 hover:text-orange-700 transition-all duration-200">
                                <i class="fas fa-comment-dots mr-2 text-xs"></i>
                                Forum Diskusi
                                <span class="ml-auto bg-green-500 text-white text-xs px-2 py-1 rounded-full">5</span>
                            </a>
                            <a href="#"
                                class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-orange-100 hover:text-orange-700 transition-all duration-200">
                                <i class="fas fa-user-friends mr-2 text-xs"></i>
                                Grup Belajar
                            </a>
                        </div>
                    </div>

                    <!-- Calendar -->
                    <a href="{{ route('calendar.index') }}"
                        class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-pink-500 hover:to-pink-600 hover:text-white transition-all duration-300">
                        <i class="fas fa-calendar-alt mr-3 text-lg"></i>
                        <span>Kalender</span>
                    </a>

                    <!-- Information -->
                    <a href="{{ route('setting.information') }}"
                        class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-indigo-600 hover:text-white transition-all duration-300">
                        <i class="fas fa-info-circle mr-3 text-lg"></i>
                        <span>Informasi</span>
                    </a>
                </div>
            </nav>

            <!-- User Profile dengan animasi -->
            <div class="mt-8 p-4 bg-gradient-to-r from-blue-50 to-purple-50 border-t border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="relative">
                        <img class="h-11 w-12 rounded-full"
                            src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : 'https://via.placeholder.com/256' }}"
                            alt="{{ Auth::user()->name }}">
                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white">
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                        <span
                            class="inline-block mt-1 px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs font-semibold">
                            Kelas: {{ Auth::user()->kelas }}
                        </span>
                    </div>
                </div>

                <!-- Progress indicator -->
                <div class="mb-4">
                    <div class="flex justify-between text-xs text-gray-600 mb-1">
                        <span>Progress Belajar</span>
                        <span>75%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="progress-bar w-3/4"></div>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="flex space-x-2">
                    <a href="{{ route('setting.form') }}"
                        class="flex-1 text-center bg-gradient-to-r from-gray-500 to-gray-600 text-white py-2 px-3 rounded-lg text-xs font-medium hover:from-gray-600 hover:to-gray-700 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-cog mr-1"></i> Setting
                    </a>

                    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit" onclick="confirmLogout(event)"
                            class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white py-2 px-3 rounded-lg text-xs font-medium hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content dengan background interaktif -->
        <main class="flex-1 relative min-h-screen overflow-y-auto">
            <!-- Animated background -->
            <div class="absolute inset-0 gradient-bg">
                <div class="absolute inset-0 opacity-10">
                    <div
                        class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full mix-blend-multiply filter blur-xl animate-pulse">
                    </div>
                    <div
                        class="absolute top-40 right-20 w-24 h-24 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2000">
                    </div>
                    <div
                        class="absolute bottom-40 left-20 w-28 h-28 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-4000">
                    </div>
                </div>
            </div>

            <div class="relative z-10 p-8 pb-16">
                <!-- Header dengan greeting interaktif -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">
                                <span class="inline-block bounce-animation">👋</span>
                                Selamat Datang, {{ Auth::user()->name }}!
                            </h1>
                            <p class="text-blue-100 text-lg" id="greeting-text">Siap belajar matematika hari ini?</p>
                        </div>
                        <div class="text-right text-white">
                            <div class="text-sm opacity-80">Hari ini</div>
                            <div class="text-2xl font-bold" id="current-time"></div>
                            <div class="text-sm opacity-80" id="current-date"></div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards dengan animasi hover -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div
                        class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white border-opacity-20">
                        <div class="flex items-center">
                            <div class="bg-gradient-to-r from-green-400 to-green-600 p-3 rounded-xl">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-600 text-sm">Kuis Selesai</p>
                                <p class="text-2xl font-bold text-gray-800">12</p>
                            </div>
                        </div>
                        <div class="mt-4 text-green-600 text-sm font-medium">
                            <i class="fas fa-arrow-up mr-1"></i> +2 dari minggu lalu
                        </div>
                    </div>

                    <div
                        class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white border-opacity-20">
                        <div class="flex items-center">
                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-xl">
                                <i class="fas fa-star text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-600 text-sm">Rata-rata Nilai</p>
                                <p class="text-2xl font-bold text-gray-800">85</p>
                            </div>
                        </div>
                        <div class="mt-4 text-blue-600 text-sm font-medium">
                            <i class="fas fa-trophy mr-1"></i> Target tercapai!
                        </div>
                    </div>

                    <div
                        class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white border-opacity-20">
                        <div class="flex items-center">
                            <div class="bg-gradient-to-r from-purple-400 to-purple-600 p-3 rounded-xl">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-600 text-sm">Waktu Belajar</p>
                                <p class="text-2xl font-bold text-gray-800">45m</p>
                            </div>
                        </div>
                        <div class="mt-4 text-purple-600 text-sm font-medium">
                            <i class="fas fa-fire mr-1"></i> Streak 7 hari!
                        </div>
                    </div>
                </div>

                <!-- Timeline Section dengan animasi -->
                <section class="mb-8">
                    <div class="flex items-center mb-4">
                        <div
                            class="bg-white bg-opacity-20 backdrop-blur-md px-4 py-2 rounded-xl border border-white border-opacity-30">
                            <h2 class="text-xl font-semibold text-white flex items-center">
                                <i class="fas fa-calendar-check mr-2 bounce-animation"></i>
                                Timeline Penting
                            </h2>
                        </div>
                    </div>

                    <div
                        class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white border-opacity-20">
                        <div class="flex items-start space-x-4">
                            <div class="bg-gradient-to-r from-red-400 to-red-600 p-3 rounded-xl flex-shrink-0">
                                <i class="fas fa-exclamation text-white"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-semibold text-gray-900 text-lg">Quiz 1 - Operasi Bilangan</h3>
                                    <span
                                        class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium pulse-animation">
                                        Deadline!
                                    </span>
                                </div>
                                <p class="text-gray-700 text-sm mb-3">Latihan Minggu 1: Operasi hitung bilangan bulat
                                    dan pecahan.</p>
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-clock mr-1"></i>
                                        10 January, 23:59 PM
                                    </div>
                                    <button
                                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-play mr-1"></i> Mulai Quiz
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Recent Activity dengan empty state yang menarik -->
                <section>
                    <div class="flex items-center mb-4">
                        <div
                            class="bg-white bg-opacity-20 backdrop-blur-md px-4 py-2 rounded-xl border border-white border-opacity-30">
                            <h2 class="text-xl font-semibold text-white flex items-center">
                                <i class="fas fa-history mr-2"></i>
                                Aktivitas Terbaru
                            </h2>
                        </div>
                    </div>

                    <div
                        class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-8 rounded-2xl shadow-xl border border-white border-opacity-20 text-center">
                        <div class="float-animation mb-4">
                            <i class="fas fa-rocket text-6xl text-gray-300"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Siap Memulai Petualangan?</h3>
                        <p class="text-gray-500 mb-6">Belum ada aktivitas hari ini. Yuk mulai belajar dan kerjakan quiz
                            pertamamu!</p>
                        <button
                            class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-xl font-medium hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-play mr-2"></i>
                            Mulai Belajar Sekarang
                        </button>
                    </div>
                </section>

                <!-- Additional content to test scrolling -->
                <section class="mt-8">
                    <div class="flex items-center mb-4">
                        <div
                            class="bg-white bg-opacity-20 backdrop-blur-md px-4 py-2 rounded-xl border border-white border-opacity-30">
                            <h2 class="text-xl font-semibold text-white flex items-center">
                                <i class="fas fa-trophy mr-2"></i>
                                Pencapaian Terbaru
                            </h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div
                            class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white border-opacity-20">
                            <div class="flex items-center">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 p-3 rounded-xl">
                                    <i class="fas fa-medal text-white text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-800">Quiz Master</h3>
                                    <p class="text-gray-600 text-sm">Selesaikan 10 quiz berturut-turut</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white border-opacity-20">
                            <div class="flex items-center">
                                <div class="bg-gradient-to-r from-green-400 to-green-600 p-3 rounded-xl">
                                    <i class="fas fa-fire text-white text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-800">Streak Champion</h3>
                                    <p class="text-gray-600 text-sm">Belajar 7 hari berturut-turut</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tips section -->
                <section class="mt-8">
                    <div class="flex items-center mb-4">
                        <div
                            class="bg-white bg-opacity-20 backdrop-blur-md px-4 py-2 rounded-xl border border-white border-opacity-30">
                            <h2 class="text-xl font-semibold text-white flex items-center">
                                <i class="fas fa-lightbulb mr-2"></i>
                                Tips Belajar Hari Ini
                            </h2>
                        </div>
                    </div>

                    <div
                        class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white border-opacity-20">
                        <div class="flex items-start space-x-4">
                            <div class="bg-gradient-to-r from-indigo-400 to-indigo-600 p-3 rounded-xl flex-shrink-0">
                                <i class="fas fa-brain text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Teknik Pomodoro untuk Matematika</h3>
                                <p class="text-gray-700 text-sm">Belajar selama 25 menit, istirahat 5 menit. Ulangi 4
                                    kali untuk hasil optimal!</p>
                                <div class="mt-3 flex space-x-2">
                                    <span
                                        class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs">#FokusBelajar</span>
                                    <span
                                        class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">#TipsEfektif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script>
        // Update time and greeting
        function updateTimeAndGreeting() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            const dateStr = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            document.getElementById('current-time').textContent = timeStr;
            document.getElementById('current-date').textContent = dateStr;

            // Dynamic greeting based on time
            const hour = now.getHours();
            let greeting = "Selamat belajar!";
            if (hour < 12) greeting = "Selamat pagi! Semangat belajar!";
            else if (hour < 15) greeting = "Selamat siang! Tetap fokus!";
            else if (hour < 18) greeting = "Selamat sore! Jangan lupa istirahat!";
            else greeting = "Selamat malam! Waktunya review!";

            document.getElementById('greeting-text').textContent = greeting;
        }

        // Dropdown functionality with smooth animations
        function toggleDropdown(type) {
            const dropdown = document.getElementById(type + '-dropdown');
            const arrow = document.getElementById(type + '-arrow');

            dropdown.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');

            // Add slide animation
            if (!dropdown.classList.contains('hidden')) {
                dropdown.style.maxHeight = '0';
                dropdown.style.overflow = 'hidden';
                dropdown.style.transition = 'max-height 0.3s ease-out';
                setTimeout(() => {
                    dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
                }, 10);
            }
        }

        // Logout confirmation
        function confirmLogout(event) {
            event.preventDefault(); // Cegah form submit langsung
            if (confirm("Apakah Anda yakin ingin logout? 🤔")) {
                alert("Logout berhasil! Sampai jumpa! 👋");
                document.getElementById('logout-form').submit();
            }
        }

        // Initialize
        updateTimeAndGreeting();
        setInterval(updateTimeAndGreeting, 1000);

        // Add some interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effects to cards
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => {
                card.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // Add typing effect to greeting (optional)
            const greetingEl = document.getElementById('greeting-text');
            const originalText = greetingEl.textContent;
            let i = 0;

            function typeWriter() {
                if (i < originalText.length) {
                    greetingEl.textContent = originalText.substring(0, i + 1);
                    i++;
                    setTimeout(typeWriter, 50);
                }
            }

            // Uncomment to enable typing effect
            // greetingEl.textContent = '';
            // typeWriter();
        });

        // Add floating elements animation
        function createFloatingElements() {
            const main = document.querySelector('main');
            for (let i = 0; i < 5; i++) {
                const element = document.createElement('div');
                element.className = 'absolute w-2 h-2 bg-white opacity-20 rounded-full animate-pulse';
                element.style.left = Math.random() * 100 + '%';
                element.style.top = Math.random() * 100 + '%';
                element.style.animationDelay = Math.random() * 2 + 's';
                main.appendChild(element);
            }
        }

        createFloatingElements();
    </script>
</body>

</html>

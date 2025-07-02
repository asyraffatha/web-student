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

        @media (max-width: 768px) {
            .sidebar-mobile .p-6 {
                padding: 1rem !important;
            }

            .sidebar-mobile .p-4 {
                padding: 0.75rem !important;
            }

            .sidebar-mobile .w-40,
            .sidebar-mobile .h-40 {
                width: 5rem !important;
                height: 5rem !important;
            }

            .sidebar-mobile .max-h-24 {
                max-height: 2.5rem !important;
            }

            .sidebar-mobile .text-2xl {
                font-size: 1rem !important;
            }

            .sidebar-mobile .rounded-2xl {
                border-radius: 0.75rem !important;
            }

            .sidebar-mobile .mt-8 {
                margin-top: 1rem !important;
            }
        }

        @media (max-width: 768px) {
            .sidebar-mobile {
                transform: translateX(-100%);
                transition: transform 0.3s;
                overflow-y: auto !important;
                width: 65vw !important;
                max-width: 240px;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 50;
                position: fixed;
                background: #fff;
                box-shadow: 2px 0 16px rgba(0, 0, 0, 0.08);
            }

            .sidebar-mobile.active {
                transform: translateX(0);
            }

            .sidebar-backdrop {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.3);
                z-index: 40;
            }

            .desktop-sidebar {
                display: none !important;
            }

            .mobile-header {
                display: flex !important;
            }

            main {
                margin-left: 0 !important;
                padding: 1rem !important;
            }

            .grid-cols-1,
            .md\:grid-cols-3 {
                grid-template-columns: 1fr !important;
            }

            .p-8 {
                padding: 1.25rem !important;
            }

            .pb-16 {
                padding-bottom: 2.5rem !important;
            }

            .text-4xl {
                font-size: 1.5rem !important;
            }

            .text-2xl {
                font-size: 1.125rem !important;
            }

            .rounded-2xl {
                border-radius: 1rem !important;
            }
        }

        @media (max-width: 480px) {

            .w-40,
            .h-40 {
                width: 7rem !important;
                height: 7rem !important;
            }

            .max-h-24 {
                max-height: 3.5rem !important;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Mobile Header -->
    <div class="mobile-header fixed top-0 left-0 w-full flex items-center justify-between bg-white shadow z-40 px-4 py-3"
        style="display:none;">
        <button id="openSidebar" class="text-2xl text-blue-600 focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
        <span class="font-bold text-blue-700 text-lg">Mathporia</span>
        <img src="{{ asset('images/LogoT.png') }}" alt="Logo" class="h-8 w-auto">
    </div>
    <!-- Sidebar dengan animasi -->
    <div id="sidebarBackdrop" class="sidebar-backdrop hidden" onclick="closeSidebar()"></div>
    <aside id="sidebar"
        class="w-64 bg-white shadow-2xl fixed top-0 left-0 h-screen overflow-y-auto flex-shrink-0 z-30 desktop-sidebar">
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

        <div class="p-4 relative z-10">
            <div class="relative w-40 h-40 mx-auto">
                <!-- Central hub -->
                <div
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-16 bg-white border-2 border-gray-200 rounded-full shadow-lg flex items-center justify-center cursor-pointer hover:shadow-xl transition-shadow duration-300">
                    <span class="text-2xl">🏠</span>
                </div>

                <!-- Orbiting elements -->
                <div class="absolute inset-0 animate-spin-slow">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full shadow-lg flex items-center justify-center cursor-pointer hover:scale-110 transition-transform duration-300">
                        <span class="text-white text-lg">📚</span>
                    </div>
                </div>

                <div class="absolute inset-0 animate-spin-slow" style="animation-delay: -2s;">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-gradient-to-br from-green-400 to-green-500 rounded-full shadow-lg flex items-center justify-center cursor-pointer hover:scale-110 transition-transform duration-300">
                        <span class="text-white text-lg">🎯</span>
                    </div>
                </div>

                <div class="absolute inset-0 animate-spin-slow" style="animation-delay: -4s;">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-500 rounded-full shadow-lg flex items-center justify-center cursor-pointer hover:scale-110 transition-transform duration-300">
                        <span class="text-white text-lg">⭐</span>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes spin-slow {
                from {
                    transform: rotate(0deg);
                }

                to {
                    transform: rotate(360deg);
                }
            }

            .animate-spin-slow {
                animation: spin-slow 12s linear infinite;
            }
        </style>

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
                        <a href="{{ route('discussion.index') }}"
                            class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-green-100 hover:text-green-700 transition-all duration-200">
                            <i class="fas fa-comments mr-2 text-xs"></i>
                            Diskusi dengan Guru
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
                        <a href="{{ route('siswa.fiturquiz') }}"
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
                        <a href="{{ route('quizzes.index') }}"
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
                        </a>
                        {{-- <a href="#"
                            class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-orange-100 hover:text-orange-700 transition-all duration-200">
                            <i class="fas fa-user-friends mr-2 text-xs"></i>
                            Grup Belajar
                        </a> --}}
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
                    <span>{{ $progress }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="progress-bar" style="width: {{ $progress }}%"></div>
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
    <aside id="sidebarMobile" class="sidebar-mobile" style="display:none;">
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

        <div class="p-4 relative z-10">
            <div class="relative w-40 h-40 mx-auto">
                <!-- Central hub -->
                <div
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-16 bg-white border-2 border-gray-200 rounded-full shadow-lg flex items-center justify-center cursor-pointer hover:shadow-xl transition-shadow duration-300">
                    <span class="text-2xl">🏠</span>
                </div>

                <!-- Orbiting elements -->
                <div class="absolute inset-0 animate-spin-slow">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full shadow-lg flex items-center justify-center cursor-pointer hover:scale-110 transition-transform duration-300">
                        <span class="text-white text-lg">📚</span>
                    </div>
                </div>

                <div class="absolute inset-0 animate-spin-slow" style="animation-delay: -2s;">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-gradient-to-br from-green-400 to-green-500 rounded-full shadow-lg flex items-center justify-center cursor-pointer hover:scale-110 transition-transform duration-300">
                        <span class="text-white text-lg">🎯</span>
                    </div>
                </div>

                <div class="absolute inset-0 animate-spin-slow" style="animation-delay: -4s;">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-500 rounded-full shadow-lg flex items-center justify-center cursor-pointer hover:scale-110 transition-transform duration-300">
                        <span class="text-white text-lg">⭐</span>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes spin-slow {
                from {
                    transform: rotate(0deg);
                }

                to {
                    transform: rotate(360deg);
                }
            }

            .animate-spin-slow {
                animation: spin-slow 12s linear infinite;
            }
        </style>

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
                    <button onclick="toggleDropdown('material-mobile')"
                        class="sidebar-item w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-green-500 hover:to-green-600 hover:text-white focus:outline-none transition-all duration-300">
                        <div class="flex items-center">
                            <i class="fas fa-book-open mr-3 text-lg"></i>
                            <span>Materi Belajar</span>
                        </div>
                        <i id="material-arrow-mobile"
                            class="fas fa-chevron-down transition-transform duration-300"></i>
                    </button>
                    <div class="hidden space-y-1 pl-8 material-dropdown" id="material-dropdown-mobile">
                        <a href="{{ route('material') }}"
                            class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-green-100 hover:text-green-700 transition-all duration-200">
                            <i class="fas fa-list-ul mr-2 text-xs"></i>
                            Daftar Materi
                        </a>
                        <a href="{{ route('discussion.index') }}"
                            class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-green-100 hover:text-green-700 transition-all duration-200">
                            <i class="fas fa-comments mr-2 text-xs"></i>
                            Diskusi dengan Guru
                        </a>
                    </div>
                </div>

                <!-- Quiz Dropdown -->
                <div class="space-y-1">
                    <button onclick="toggleDropdown('quiz-mobile')"
                        class="sidebar-item w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-purple-500 hover:to-purple-600 hover:text-white focus:outline-none transition-all duration-300">
                        <div class="flex items-center">
                            <i class="fas fa-question-circle mr-3 text-lg"></i>
                            <span>Kuis & Latihan</span>
                        </div>
                        <i id="quiz-arrow-mobile" class="fas fa-chevron-down transition-transform duration-300"></i>
                    </button>
                    <div class="hidden space-y-1 pl-8" id="quiz-dropdown-mobile">
                        <a href="{{ route('siswa.fiturquiz') }}"
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
                        <a href="{{ route('quiz.results') }}"
                            class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-purple-100 hover:text-purple-700 transition-all duration-200">
                            <i class="fas fa-history mr-2 text-xs"></i>
                            Riwayat Nilai
                        </a>
                    </div>
                </div>

                <!-- Members Dropdown -->
                <div class="space-y-1">
                    <button onclick="toggleDropdown('member-mobile')"
                        class="sidebar-item w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-orange-500 hover:to-orange-600 hover:text-white focus:outline-none transition-all duration-300">
                        <div class="flex items-center">
                            <i class="fas fa-users mr-3 text-lg"></i>
                            <span>Komunitas</span>
                        </div>
                        <i id="member-arrow-mobile" class="fas fa-chevron-down transition-transform duration-300"></i>
                    </button>
                    <div class="hidden space-y-1 pl-8" id="member-dropdown-mobile">
                        <a href="{{ route('forums.index') }}"
                            class="sidebar-item group flex items-center px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-orange-100 hover:text-orange-700 transition-all duration-200">
                            <i class="fas fa-comment-dots mr-2 text-xs"></i>
                            Forum Diskusi
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
    <main class="flex-1 relative min-h-screen overflow-y-auto ml-64" style="transition:margin 0.3s;">
        <div class="relative z-10 p-8 pb-16" style="margin-top:0;">
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
                                <p class="text-gray-600 text-sm">Total Kuis Diselesaikan</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $totalKuisSelesai }} Kuis</p>
                            </div>
                        </div>

                        @if ($totalKuisSelesai > $kuisSebelumnya)
                            <div class="mt-4 text-green-600 text-sm font-medium">
                                <i class="fas fa-arrow-up mr-1"></i> +{{ $totalKuisSelesai - $kuisSebelumnya }} dari
                                minggu lalu
                            </div>
                        @elseif($totalKuisSelesai < $kuisSebelumnya)
                            <div class="mt-4 text-red-600 text-sm font-medium">
                                <i class="fas fa-arrow-down mr-1"></i> -{{ $kuisSebelumnya - $totalKuisSelesai }} dari
                                minggu lalu
                            </div>
                        @else
                            <div class="mt-4 text-gray-600 text-sm font-medium">
                                <i class="fas fa-minus mr-1"></i> Tidak ada perubahan dari minggu lalu
                            </div>
                        @endif
                    </div>

                    <div
                        class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white border-opacity-20">
                        <div class="flex items-center">
                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-3 rounded-xl">
                                <i class="fas fa-star text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-600 text-sm">Rata-rata Nilai</p>
                                <p class="text-2xl font-bold text-gray-800">{{ round($rataRataNilai, 1) }}</p>
                            </div>
                        </div>

                        @if ($rataRataNilai > $nilaiSebelumnya)
                            <div class="mt-4 text-green-600 text-sm font-medium">
                                <i class="fas fa-arrow-up mr-1"></i>
                                +{{ round($rataRataNilai - $nilaiSebelumnya, 1) }} dari minggu lalu
                            </div>
                        @elseif($rataRataNilai < $nilaiSebelumnya)
                            <div class="mt-4 text-red-600 text-sm font-medium">
                                <i class="fas fa-arrow-down mr-1"></i>
                                -{{ round($nilaiSebelumnya - $rataRataNilai, 1) }} dari minggu lalu
                            </div>
                        @else
                            <div class="mt-4 text-gray-600 text-sm font-medium">
                                <i class="fas fa-minus mr-1"></i> Tidak ada perubahan dari minggu lalu
                            </div>
                        @endif
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

                    {{-- Loop Materi --}}
                    @foreach ($materis as $materi)
                        <div
                            class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white border-opacity-20 mb-4">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="bg-gradient-to-r from-yellow-400 to-yellow-600 p-3 rounded-xl flex-shrink-0">
                                    <i class="fas fa-book text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h3 class="font-semibold text-gray-900 text-lg">Materi: {{ $materi->judul }}
                                        </h3>
                                        <span
                                            class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium pulse-animation">
                                            Deadline!
                                        </span>
                                    </div>
                                    <p class="text-gray-700 text-sm mb-3">{{ $materi->deskripsi }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-500">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ \Carbon\Carbon::parse($materi->deadline)->translatedFormat('d F Y, H:i') }}
                                        </div>
                                        <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                            class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105">
                                            <i class="fas fa-eye mr-1"></i> Lihat Materi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Loop Quiz --}}
                    @foreach ($quizzes as $quiz)
                        @if ($quiz->is_completed)
                            @continue {{-- Lewati kuis yang sudah dikerjakan --}}
                        @endif

                        <div
                            class="card-hover bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white border-opacity-20 mb-4">
                            <div class="flex items-start space-x-4">
                                <div class="bg-gradient-to-r from-red-400 to-red-600 p-3 rounded-xl flex-shrink-0">
                                    <i class="fas fa-exclamation text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h3 class="font-semibold text-gray-900 text-lg">Quiz: {{ $quiz->title }}</h3>
                                    </div>

                                    <p class="text-gray-700 text-sm mb-3">Kuis untuk kelas {{ $quiz->kelas }}</p>

                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-500">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ \Carbon\Carbon::parse($quiz->deadline)->translatedFormat('d F Y, H:i') }}
                                        </div>
                                        <a href="{{ route('quizzes.show', $quiz->id) }}"
                                            class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105">
                                            <i class="fas fa-play mr-1"></i> Mulai Quiz
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                        <a href="{{ route('siswa.fiturquiz') }}"
                            class="inline-block bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-xl font-medium hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-play mr-2"></i>
                            Mulai Belajar Sekarang
                        </a>
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
                            <div class="bg-gradient-to-r {{ $todayTip['warna'] }} p-3 rounded-xl flex-shrink-0">
                                <i class="{{ $todayTip['icon'] }} text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">{{ $todayTip['judul'] }}</h3>
                                <p class="text-gray-700 text-sm">{{ $todayTip['deskripsi'] }}</p>
                                <div class="mt-3 flex space-x-2">
                                    @foreach ($todayTip['tags'] as $tag)
                                        <span
                                            class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </main>
    </div>

    <script>
        // Sidebar mobile logic
        function openSidebar() {
            document.getElementById('sidebarMobile').style.display = 'block';
            setTimeout(() => {
                document.getElementById('sidebarMobile').classList.add('active');
                document.getElementById('sidebarBackdrop').classList.remove('hidden');
            }, 10);
        }

        function closeSidebar() {
            document.getElementById('sidebarMobile').classList.remove('active');
            document.getElementById('sidebarBackdrop').classList.add('hidden');
            setTimeout(() => {
                document.getElementById('sidebarMobile').style.display = 'none';
            }, 300);
        }

        function handleSidebarDisplay() {
            if (window.innerWidth <= 768) {
                document.querySelector('.desktop-sidebar').style.display = 'none';
                document.querySelector('.mobile-header').style.display = 'flex';
                document.getElementById('sidebarMobile').style.display = 'none';
                document.getElementById('sidebarMobile').classList.remove('active');
                document.getElementById('sidebarBackdrop').classList.add('hidden');
            } else {
                document.querySelector('.desktop-sidebar').style.display = '';
                document.querySelector('.mobile-header').style.display = 'none';
                document.getElementById('sidebarMobile').style.display = 'none';
                document.getElementById('sidebarMobile').classList.remove('active');
                document.getElementById('sidebarBackdrop').classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            handleSidebarDisplay();
            document.getElementById('openSidebar').onclick = openSidebar;
            document.getElementById('sidebarBackdrop').onclick = closeSidebar;
            window.addEventListener('resize', handleSidebarDisplay);
        });
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
            // type: 'material', 'quiz', 'member', 'material-mobile', dst.
            let dropdown, arrow;
            if (type.endsWith('-mobile')) {
                dropdown = document.getElementById(type + '-dropdown');
                arrow = document.getElementById(type + '-arrow');
            } else {
                dropdown = document.getElementById(type + '-dropdown');
                arrow = document.getElementById(type + '-arrow');
            }
            // Fallback jika id di atas tidak ditemukan (untuk kompatibilitas lama)
            if (!dropdown) dropdown = document.getElementById(type.replace('-mobile', '') + '-dropdown-mobile');
            if (!arrow) arrow = document.getElementById(type.replace('-mobile', '') + '-arrow-mobile');

            if (!dropdown || !arrow) return;

            dropdown.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');

            // Optional: animasi slide
            if (!dropdown.classList.contains('hidden')) {
                dropdown.style.maxHeight = '0';
                dropdown.style.overflow = 'hidden';
                dropdown.style.transition = 'max-height 0.3s ease-out';
                setTimeout(() => {
                    dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
                }, 10);
            } else {
                dropdown.style.maxHeight = '';
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

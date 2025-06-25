<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Mathporia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .progress-bar {
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }

            100% {
                background-position: calc(200px + 100%) 0;
            }
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
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

        .pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 text-gray-800 flex min-h-screen"
    x-data="dashboardData()">

    <!-- Sidebar -->
    <aside
        class="w-64 bg-white/80 backdrop-blur-lg shadow-2xl flex flex-col justify-between sticky top-0 h-screen transition-all duration-300 border-r border-white/20"
        x-data="{ open: false }" :class="open ? 'w-64' : 'w-20 md:w-64'">
        <div>
            <!-- Logo Section -->
            <div class="px-6 py-6 border-b border-gray-100/50 bg-white flex justify-center">
                <img src="{{ asset('images/LogoT.png') }}" alt="Logo" class="h-16 w-auto object-contain">
            </div>

            <!-- Welcome Section -->
            <div class="px-6 py-4">
                <div
                    class="flex items-center space-x-3 p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 p-2 rounded-full shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="hidden md:block text-sm">
                        <h5 class="font-medium text-gray-800">Welcome</h5>
                        <p class="text-gray-600 text-xs">{{ $guru->name }}</p>

                        @if ($kelasDiampu->count())
                            <p class="text-[11px] text-sky-700 mt-1">
                                {{ $kelasDiampu->pluck('nama')->implode(', ') }}
                            </p>
                        @else
                            <p class="text-[11px] text-sky-700 mt-1">Belum mengampu kelas</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2 px-4">
                <a href="{{ route('guru.dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-600 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="hidden md:block font-medium">Dashboard</span>
                </a>

                <!-- Manage Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3 rounded-xl text-purple-600 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition group">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="hidden md:block font-medium">Manage</span>
                        </div>
                        <svg class="w-4 h-4 hidden md:block transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" class="ml-6 mt-2 space-y-1">
                        <a href="{{ route('materi.create') }}"
                            class="flex items-center px-4 py-2 rounded-lg text-purple-600 hover:bg-purple-50 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="hidden md:block">Materials</span>
                        </a>
                        <a href="{{ route('quiz.create') }}"
                            class="flex items-center px-4 py-2 rounded-lg text-purple-600 hover:bg-purple-50 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span class="hidden md:block">Quizzes</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('goals') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-amber-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-orange-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span class="hidden md:block font-medium">Goals</span>
                </a>

                <a href="{{ route('discussion.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-600 hover:bg-gradient-to-r hover:from-blue-50 hover:to-sky-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 8h2a2 2 0 012 2v7a2 2 0 01-2 2h-7l-4 4v-4H7a2 2 0 01-2-2V10a2 2 0 012-2h2" />
                    </svg>
                    <span class="hidden md:block font-medium">Diskusi</span>
                </a>


                {{-- <a href="#"
                    class="flex items-center px-4 py-3 rounded-xl text-emerald-600 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M5.121 17.804A10.96 10.96 0 0112 15c2.389 0 4.584.78 6.308 2.098M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="hidden md:block font-medium">Profile</span>
                </a> --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="flex items-center px-4 py-3 rounded-xl hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 text-red-600 transition group w-full text-left mt-4">
                        <svg class="w-5 h-5 text-red-500 group-hover:text-red-600 mr-3" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="hidden md:block font-medium">Logout</span>
                    </button>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
        <!-- Top Navigation -->
        <nav
            class="bg-white/80 backdrop-blur-lg shadow-lg px-6 py-4 flex items-center justify-between sticky top-0 z-10 border-b border-white/20">
            <div class="flex items-center">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                    Dashboard</h1>
            </div>
            {{-- <div class="flex items-center space-x-4">
                <button class="p-2 rounded-full hover:bg-gray-100 transition-all duration-200 relative">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">3</span>
                </button>
            </div> --}}
        </nav>

        <!-- Content Area -->
        <div class="p-6 space-y-8">
            <!-- Welcome Banner -->
            <section
                class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 rounded-3xl shadow-2xl p-8 text-white">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <h2 class="text-3xl font-bold mb-2 animate__animated animate__fadeInUp">Welcome to Your
                            Dashboard</h2>
                        <p class="text-lg text-blue-100 animate__animated animate__fadeInUp animate__delay-1s">Track
                            your progress and manage your educational content with ease.</p>
                    </div>
                    <div class="floating-animation">
                        <a href="{{ route('goals') }}"
                            class="bg-white/20 hover:bg-white/30 backdrop-blur-lg text-white font-semibold px-6 py-3 rounded-2xl transition-all duration-300 border border-white/30 shadow-lg hover:shadow-xl flex items-center justify-center">
                            <span class="flex items-center">
                                View Progress
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32">
                </div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24">
                </div>
            </section>

            <!-- Statistics Cards -->
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Materials -->
                @php
                    // Misalnya target maksimal materi adalah 50
                    $targetMaterials = 50;

                    // Hitung progress dan batasi maksimum 100%
                    $progress =
                        $targetMaterials > 0 ? min(100, round(($totalMaterials / $targetMaterials) * 100, 2)) : 0;
                @endphp

                <div
                    class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 border-l-4 border-blue-500 card-hover relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-20 h-20 bg-blue-50 rounded-full -translate-y-10 translate-x-10">
                    </div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm text-gray-500 font-medium mb-2">Total Materials</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $totalMaterials }}</h3>
                            </div>
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-2xl shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full progress-bar"
                                style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                </div>

                @php
                    // Target maksimum kuis
                    $targetQuizzes = 30;

                    // Hitung progress dan batasi maksimal 100%
                    $quizProgress = $targetQuizzes > 0 ? min(100, round(($totalQuizzes / $targetQuizzes) * 100, 2)) : 0;
                @endphp

                <!-- Total Quizzes -->
                <div
                    class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 border-l-4 border-purple-500 card-hover relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-20 h-20 bg-purple-50 rounded-full -translate-y-10 translate-x-10">
                    </div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm text-gray-500 font-medium mb-2">Total Quizzes</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $totalQuizzes }}</h3>
                            </div>
                            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-3 rounded-2xl shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2m0 0l2-2m-2 2v-6" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full progress-bar"
                                style="width: {{ $quizProgress }}%">
                            </div>
                        </div>
                        <!-- Jika ingin tampil persentase -->
                        {{-- <p class="text-sm text-purple-700 mt-1">{{ $quizProgress }}%</p> --}}
                    </div>
                </div>

                <!-- Students -->
                <div
                    class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 border-l-4 border-emerald-500 card-hover relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-20 h-20 bg-emerald-50 rounded-full -translate-y-10 translate-x-10">
                    </div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm text-gray-500 font-medium mb-2">Students</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $totalSiswa }}</h3>
                            </div>
                            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 p-3 rounded-2xl shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                        <div x-data="{ stats: { students: {{ $totalSiswa }} } }">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 h-2 rounded-full progress-bar"
                                    :style="`width: ${(stats.students / 150) * 100}%`"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completion Rate -->
                <div x-data="{ stats: { completionRate: {{ $rataRataNilai }} } }"
                    class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 border-l-4 border-amber-500 card-hover relative overflow-hidden">

                    <div
                        class="absolute top-0 right-0 w-20 h-20 bg-amber-50 rounded-full -translate-y-10 translate-x-10">
                    </div>

                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm text-gray-500 font-medium mb-2">Completion Rate</p>
                                <h3 class="text-3xl font-bold text-gray-800" x-text="stats.completionRate + '%'"></h3>
                            </div>
                            <div class="bg-gradient-to-r from-amber-500 to-amber-600 p-3 rounded-2xl shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-amber-500 to-amber-600 h-2 rounded-full progress-bar"
                                :style="`width: ${stats.completionRate}%`"></div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- <!-- Recent Activity -->
            <section class="bg-white/80 backdrop-blur-lg p-8 rounded-3xl shadow-xl border border-white/20">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-800">Recent Activity</h3>
                    <button class="text-blue-600 hover:text-blue-800 font-semibold flex items-center group">
                        View All
                        <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                <div class="space-y-4">
                    <template x-for="activity in recentActivities" :key="activity.id">
                        <div
                            class="flex items-center p-4 bg-gradient-to-r from-gray-50 to-slate-50 rounded-2xl border border-gray-100 hover:shadow-md transition-all duration-300">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg"
                                    :class="activity.iconBg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"
                                        x-html="activity.icon"></svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800" x-text="activity.title"></h4>
                                <p class="text-sm text-gray-600" x-text="activity.description"></p>
                                <p class="text-xs text-gray-400 mt-1" x-text="activity.time"></p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="px-3 py-1 text-xs font-medium rounded-full" :class="activity.statusColor"
                                    x-text="activity.status"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </section> --}}

            <!-- Quick Actions -->
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Create Material -->
                <div
                    class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-3xl text-white shadow-xl card-hover">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-xl font-bold">Create Material</h4>
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <p class="text-blue-100 mb-6">Add new learning materials for your students</p>
                    <a href="{{ route('materi.create') }}"
                        class="bg-white/20 hover:bg-white/30 text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 border border-white/30 inline-block">
                        Get Started
                    </a>
                </div>

                <div
                    class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-3xl text-white shadow-xl card-hover">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-xl font-bold">Create Quiz</h4>
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="text-purple-100 mb-6">Design interactive quizzes to test knowledge</p>
                    <a href="{{ route('quiz.create') }}"
                        class="bg-white/20 hover:bg-white/30 text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 border border-white/30 inline-block">
                        Create Now
                    </a>
                </div>

                <div
                    class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-6 rounded-3xl text-white shadow-xl card-hover">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-xl font-bold">View Reports</h4>
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <p class="text-emerald-100 mb-6">Analyze student performance and progress</p>
                    <a href="{{ route('goals') }}"
                        class="bg-white/20 hover:bg-white/30 text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 border border-white/30 inline-block text-center">
                        View Analytics
                    </a>
                </div>
            </section>
        </div>
    </main>


    <script>
        function dashboardData() {
            return {
                teacherName: 'Dr. Sarah Johnson',
                classesText: 'Teaching 5 classes',
                showMaterialModal: false,
                showQuizModal: false,
                showProgress: false,
                stats: {
                    materials: 24,
                    quizzes: 18,
                    students: 142,
                    completionRate: 87
                },
                practiceAreas: {
                    needHelp: 12,
                    practicing: 89,
                    mastered: 41
                },
                recentActivities: [{
                        id: 1,
                        title: 'New Quiz Completed',
                        description: 'Linear Equations quiz completed by 23 students',
                        time: '2 hours ago',
                        status: 'Completed',
                        statusColor: 'bg-green-100 text-green-800',
                        iconBg: 'bg-gradient-to-r from-green-500 to-emerald-500',
                        icon: '<path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'
                    },
                    {
                        id: 2,
                        title: 'Material Updated',
                        description: 'Geometry fundamentals material was updated',
                        time: '4 hours ago',
                        status: 'Updated',
                        statusColor: 'bg-blue-100 text-blue-800',
                        iconBg: 'bg-gradient-to-r from-blue-500 to-indigo-500',
                        icon: '<path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />'
                    },
                    {
                        id: 3,
                        title: 'Student Progress',
                        description: 'Alex Chen achieved 95% in Calculus basics',
                        time: '6 hours ago',
                        status: 'Achievement',
                        statusColor: 'bg-yellow-100 text-yellow-800',
                        iconBg: 'bg-gradient-to-r from-yellow-500 to-orange-500',
                        icon: '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />'
                    },
                    {
                        id: 4,
                        title: 'New Assignment',
                        description: 'Trigonometry practice assignment was created',
                        time: '1 day ago',
                        status: 'New',
                        statusColor: 'bg-purple-100 text-purple-800',
                        iconBg: 'bg-gradient-to-r from-purple-500 to-pink-500',
                        icon: '<path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />'
                    }
                ],
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</body>

</html>

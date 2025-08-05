@extends('layouts.app')

@section('title', 'Dashboard Gamifikasi - Mathporia')

@push('styles')
<style>
    .sidebar {
        position: fixed;
        left: -350px;
        top: 50%;
        transform: translateY(-50%);
        width: 350px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1000;
        overflow-y: auto;
    }
    
    .sidebar.open {
        left: 20px;
    }
    
    .sidebar-toggle {
        position: fixed;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1001;
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 12px;
        padding: 12px;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .sidebar-toggle:hover {
        transform: translateY(-50%) scale(1.05);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
    }
    
    .sidebar-toggle.sidebar-open {
        left: 370px;
    }
    
    .sidebar-toggle svg {
        width: 24px;
        height: 24px;
        transition: transform 0.3s ease;
    }
    
    .sidebar-toggle.sidebar-open svg {
        transform: rotate(180deg);
    }
    
    .sidebar-header {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-title {
        color: #4f46e5;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .sidebar-subtitle {
        color: #6b7280;
        font-size: 0.9rem;
    }
    
    .stats-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    /* Badge Display */
    .badge-display {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(245, 158, 11, 0.05));
        padding: 15px;
        border-radius: 16px;
        font-weight: 700;
        color: #f59e0b;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
        font-size: 1rem;
        border: 1px solid rgba(245, 158, 11, 0.2);
        transition: all 0.3s ease;
    }
    
    .badge-display:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
    }
    
    .badge-icon {
        font-size: 1.8rem;
        filter: drop-shadow(0 2px 4px rgba(245, 158, 11, 0.3));
    }
    
    .badge-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ef4444;
        color: white;
        font-size: 0.7rem;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
    }
    
    /* Points Display */
    .points-display {
        display: flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
        padding: 15px;
        border-radius: 16px;
        font-weight: 700;
        color: #3b82f6;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        font-size: 1rem;
        border: 1px solid rgba(59, 130, 246, 0.2);
        transition: all 0.3s ease;
    }
    
    .points-display:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
    }
    
    .points-icon {
        font-size: 1.8rem;
        filter: drop-shadow(0 2px 4px rgba(59, 130, 246, 0.3));
    }
    
    /* Experience Display */
    .experience-display {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
        padding: 20px;
        border-radius: 16px;
        font-weight: 700;
        color: #10b981;
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.2);
        font-size: 1rem;
        border: 1px solid rgba(16, 185, 129, 0.2);
        transition: all 0.3s ease;
    }
    
    .experience-display:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    }
    
    .exp-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }
    
    .exp-icon {
        font-size: 1.8rem;
        filter: drop-shadow(0 2px 4px rgba(16, 185, 129, 0.3));
    }
    
    .exp-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    
    .exp-amount {
        font-size: 1.1rem;
        color: #10b981;
        font-weight: 600;
    }
    
    .next-level {
        font-size: 0.8rem;
        color: #10b981;
        opacity: 0.8;
        background: rgba(16, 185, 129, 0.15);
        padding: 4px 8px;
        border-radius: 8px;
    }
    
    /* Progress Bar */
    .progress-container {
        margin-top: 8px;
    }
    
    .progress-bar {
        position: relative;
        height: 12px;
        background: rgba(16, 185, 129, 0.15);
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        margin-bottom: 10px;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .progress-bar:hover {
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 0 0 2px rgba(16, 185, 129, 0.3);
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #10b981, #34d399);
        border-radius: 8px;
        position: relative;
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
    }
    
    .progress-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: shimmer 2s infinite;
    }
    
    .progress-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 0.7rem;
        font-weight: 600;
        color: #065f46;
        text-shadow: 0 1px 2px rgba(255, 255, 255, 0.8);
        z-index: 2;
    }
    
    .progress-details {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: #10b981;
        opacity: 0.8;
    }
    
    /* Animations */
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
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
    
    .sidebar.open .stats-container > * {
        animation: slideIn 0.5s ease forwards;
    }
    
    .sidebar.open .stats-container > *:nth-child(1) { animation-delay: 0.1s; }
    .sidebar.open .stats-container > *:nth-child(2) { animation-delay: 0.2s; }
    .sidebar.open .stats-container > *:nth-child(3) { animation-delay: 0.3s; }
    
    .main-content {
        margin-left: 0;
        transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .main-content.sidebar-open {
        margin-left: 390px;
    }
    
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .overlay.show {
        opacity: 1;
        visibility: visible;
    }
    
    @media (max-width: 768px) {
        .sidebar {
            left: -350px;
        }
        
        .sidebar.open {
            left: 20px;
        }
        
        .main-content {
            margin-left: 0;
        }
        
        .sidebar-toggle {
            display: flex;
        }
    }
</style>
@endpush

@section('content')
<!-- Sidebar Toggle Button -->
<button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<!-- Overlay for mobile -->
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2 class="sidebar-title">Status Pengguna</h2>
            <p class="sidebar-subtitle">Lacak progress dan pencapaian Anda</p>
        </div>
        
        <div class="stats-container">
            <!-- Badge Display -->
            <div class="badge-display">
                <span class="badge-icon">🏅</span>
                <div>
                    <div style="font-size: 0.9rem; color: #f59e0b;">{{ Auth::user()->getLevelTitle() }}</div>
                    <div style="font-size: 0.8rem; color: #f59e0b; opacity: 0.8;">Level {{ Auth::user()->getLevel() }}</div>
                </div>
                @if(Auth::user()->getEarnedBadges()->count() > 0)
                <div class="badge-count">{{ Auth::user()->getEarnedBadges()->count() }}</div>
                @endif
            </div>
            
            <!-- Points Display -->
            <div class="points-display">
                <span class="points-icon">⭐</span>
                <div>
                    <div style="font-size: 0.9rem; color: #3b82f6;">{{ number_format(Auth::user()->getTotalPoints()) }}</div>
                    <div style="font-size: 0.8rem; color: #3b82f6; opacity: 0.8;">Poin</div>
                </div>
            </div>
            
            <!-- Experience Display -->
            <div class="experience-display">
                <div class="exp-header">
                    <span class="exp-icon">📈</span>
                    <div style="flex: 1;">
                        <div class="exp-info">
                            <span class="exp-amount">{{ number_format(Auth::user()->userPoint?->experience ?? 0) }} XP</span>
                            <span class="next-level">Level {{ Auth::user()->getLevel() + 1 }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="progress-bar" onclick="showExpDetails()" title="Klik untuk detail EXP">
                    @php
                        $currentExp = Auth::user()->userPoint?->experience ?? 0;
                        $nextLevelExp = Auth::user()->userPoint?->experience_to_next_level ?? 100;
                        $progressPercentage = $nextLevelExp > 0 ? ($currentExp / $nextLevelExp) * 100 : 0;
                    @endphp
                    <div class="progress-fill" style="width: {{ $progressPercentage }}%"></div>
                    <div class="progress-text">{{ number_format($progressPercentage, 1) }}%</div>
                </div>
                
                <!-- Progress Details -->
                <div class="progress-details">
                    <span>{{ number_format($currentExp) }}/{{ number_format($nextLevelExp) }}</span>
                    <span style="font-weight: 600;">{{ number_format(100 - $progressPercentage, 1) }}% tersisa</span>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Main Content -->
<div class="main-content" id="mainContent">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-8 mb-8">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">🏆 Dashboard Gamifikasi</h1>
                    <p class="text-blue-100 text-lg">Lihat progress belajar dan capaian Anda</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold">{{ Auth::user()->name }}</div>
                    <div class="text-blue-100">Level {{ Auth::user()->getLevel() }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Content Area -->
        <div class="space-y-8">
            <!-- Badge Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <span class="text-2xl mr-2">🏅</span>
                        Lencana
                    </h3>
                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $stats['badges_earned'] }}/{{ $stats['total_badges'] }}
                    </div>
                </div>
                
                @if($badges['earned']->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach($badges['earned']->take(6) as $userBadge)
                        <div class="group relative">
                            <div class="bg-gradient-to-br from-yellow-200 to-yellow-400 rounded-xl p-4 text-center transform hover:scale-110 transition-all duration-300 cursor-pointer shadow-lg hover:shadow-xl">
                                <div class="text-4xl mb-2">{{ $userBadge->badge->icon ?? '🏅' }}</div>
                                <div class="text-xs font-semibold text-gray-800">{{ $userBadge->badge->name }}</div>
                                <div class="text-xs text-gray-600 mt-1">{{ $userBadge->days_since_earned }} hari lalu</div>
                            </div>
                            
                            <!-- Badge Tooltip -->
                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 bg-gray-900 text-white text-xs rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 whitespace-nowrap">
                                {{ $userBadge->badge->description }}
                                <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-6xl mb-4">😢</div>
                        <p class="text-gray-500 text-lg">Belum ada badge yang diperoleh</p>
                        <p class="text-gray-400 text-sm mt-2">Mulai belajar untuk mendapatkan badge pertama Anda!</p>
                    </div>
                @endif
            </div>



            <!-- Boss Quiz Badges Section -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="text-2xl mr-2">⚔️</span>
                    Boss Quiz Badges
                    <span class="ml-2 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                        SPECIAL
                    </span>
                </h3>
                
                @php
                    $bossQuizBadges = $badges['earned']->filter(function($userBadge) {
                        return $userBadge->badge->category === 'boss_quiz';
                    });
                    $availableBossBadges = $badges['available']->filter(function($badge) {
                        return $badge->category === 'boss_quiz';
                    });
                @endphp
                
                @if($bossQuizBadges->count() > 0)
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-700 mb-3 flex items-center">
                            <span class="text-xl mr-2">🏆</span>
                            Badge Boss Quiz yang Diperoleh
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($bossQuizBadges as $userBadge)
                            <div class="group relative">
                                <div class="bg-gradient-to-br from-yellow-200 via-orange-200 to-red-200 rounded-xl p-4 text-center transform hover:scale-110 transition-all duration-300 cursor-pointer shadow-lg hover:shadow-xl border-2 border-yellow-300">
                                    <div class="text-4xl mb-2 animate-pulse">{{ $userBadge->badge->icon }}</div>
                                    <div class="text-xs font-semibold text-gray-800">{{ $userBadge->badge->name }}</div>
                                    <div class="text-xs text-gray-600 mt-1">{{ $userBadge->days_since_earned }} hari lalu</div>
                                    
                                    <!-- Special Boss Quiz Indicator -->
                                    <div class="absolute -top-2 -right-2 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                                        BOSS
                                    </div>
                                </div>
                                
                                <!-- Badge Tooltip -->
                                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 bg-gray-900 text-white text-xs rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 whitespace-nowrap">
                                    {{ $userBadge->badge->description }}
                                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                <!-- Available Boss Quiz Badges -->
                @if($availableBossBadges->count() > 0)
                <div class="border-t border-gray-200 pt-6">
                    <h4 class="text-md font-semibold text-gray-700 mb-3 flex items-center">
                        <span class="text-xl mr-2">🔒</span>
                        Badge Boss Quiz yang Tersedia
                    </h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($availableBossBadges->take(8) as $badge)
                        <div class="bg-gray-100 rounded-xl p-4 text-center opacity-60 relative">
                            <div class="text-4xl mb-2">🔒</div>
                            <div class="text-xs font-semibold text-gray-600">{{ $badge->name }}</div>
                            <div class="text-xs text-gray-500 mt-1">Belum diperoleh</div>
                            
                            <!-- Boss Quiz Indicator -->
                            <div class="absolute -top-2 -right-2 bg-gray-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                                BOSS
                            </div>
                        </div>
                        @endforeach
                        @if($availableBossBadges->count() > 8)
                        <div class="bg-gray-100 rounded-xl p-4 text-center opacity-60 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-2xl mb-1">+{{ $availableBossBadges->count() - 8 }}</div>
                                <div class="text-xs text-gray-600">Badge Boss lainnya</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Boss Quiz Progress Info -->
                    <div class="mt-4 p-4 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg border border-yellow-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h5 class="font-semibold text-gray-800 mb-1">🎯 Progress Boss Quiz</h5>
                                <p class="text-sm text-gray-600">Kalahkan Boss Quiz dengan nilai >90 untuk mendapatkan badge!</p>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-yellow-600">{{ $bossQuizBadges->count() }}</div>
                                <div class="text-xs text-gray-500">Badge diperoleh</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Available Badges Preview -->
            @if($badges['available']->filter(function($badge) { return $badge->category !== 'boss_quiz'; })->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="text-2xl mr-2">🔒</span>
                    Badge yang Tersedia
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($badges['available']->filter(function($badge) { return $badge->category !== 'boss_quiz'; })->take(6) as $badge)
                    <div class="bg-gray-100 rounded-xl p-4 text-center opacity-60">
                        <div class="text-4xl mb-2">🔒</div>
                        <div class="text-xs font-semibold text-gray-600">{{ $badge->name }}</div>
                        <div class="text-xs text-gray-500 mt-1">Belum diperoleh</div>
                    </div>
                    @endforeach
                    @if($badges['available']->filter(function($badge) { return $badge->category !== 'boss_quiz'; })->count() > 6)
                    <div class="bg-gray-100 rounded-xl p-4 text-center opacity-60 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-2xl mb-1">+{{ $badges['available']->filter(function($badge) { return $badge->category !== 'boss_quiz'; })->count() - 6 }}</div>
                            <div class="text-xs text-gray-600">Badge lainnya</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Progress Bar - Compact Design -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8 h-32 flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                            <span class="text-white text-sm font-bold">📈</span>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-gray-800">{{ number_format($stats['experience']) }} XP</div>
                            <div class="text-sm text-gray-600">Progress ke Level {{ $stats['level'] + 1 }}</div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Level {{ $stats['level'] + 1 }}
                    </div>
                </div>
                
                <!-- Interactive Progress Bar -->
                <div class="relative">
                    <!-- Background Bar -->
                    <div class="w-full h-8 bg-gray-100 rounded-full overflow-hidden border-2 border-gray-200 relative shadow-inner">
                        <!-- Progress Fill - Dynamic Color based on percentage -->
                        <div class="h-full rounded-full transition-all duration-2000 ease-out relative overflow-hidden flex items-center justify-center" 
                             style="width: {{ $stats['progress_to_next_level'] }}%; background: {{ $stats['progress_to_next_level'] > 0 ? 'linear-gradient(90deg, #10b981 0%, #059669 50%, #047857 100%)' : 'transparent' }}">
                            
                            <!-- Animated Shimmer Effect -->
                            @if($stats['progress_to_next_level'] > 0)
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-30 animate-pulse transform -skew-x-12"></div>
                            
                            <!-- Glowing Edge -->
                            <div class="absolute right-0 top-0 bottom-0 w-2 bg-gradient-to-b from-transparent via-white to-transparent opacity-60"></div>
                            
                            <!-- Progress Text Inside Bar -->
                            <div class="relative z-10 text-white text-xs font-bold px-2">
                                {{ number_format($stats['progress_to_next_level'], 1) }}%
                            </div>
                            @endif
                        </div>
                        
                        <!-- Remaining Progress (White) -->
                        <div class="absolute top-0 right-0 h-full bg-white rounded-r-full transition-all duration-2000 ease-out"
                             style="width: {{ 100 - $stats['progress_to_next_level'] }}%">
                        </div>
                        
                        <!-- Progress Indicator -->
                        @if($stats['progress_to_next_level'] > 0)
                        <div class="absolute top-1/2 transform -translate-y-1/2 w-4 h-4 bg-green-500 rounded-full border-2 border-white shadow-lg transition-all duration-2000 ease-out"
                             style="left: calc({{ $stats['progress_to_next_level'] }}% - 8px);">
                            <div class="absolute inset-0 bg-green-400 rounded-full animate-ping opacity-75"></div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Progress Details -->
                    <div class="flex justify-between mt-3 text-xs">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-gray-600">Progress: {{ number_format($stats['experience']) }}/{{ number_format($stats['experience_to_next_level']) }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                            <span class="font-semibold text-gray-500">{{ number_format(100 - $stats['progress_to_next_level'], 1) }}% tersisa</span>
                        </div>
                    </div>
                    
                    <!-- XP Needed for Next Level -->
                    <div class="text-center mt-2">
                        <span class="text-xs text-gray-500">
                            Butuh {{ number_format($stats['experience_to_next_level'] - $stats['experience']) }} XP lagi untuk naik level
                        </span>
                    </div>
                </div>
            </div>

            <!-- Leaderboard Preview -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Papan Peringkat</h3>
                    <a href="{{ route('gamification.leaderboard') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua</a>
                </div>
                
                @if($leaderboard->count() > 0)
                    <div class="space-y-2">
                        @foreach($leaderboard->take(5) as $index => $user)
                        <div class="flex items-center justify-between p-3 {{ $index < 3 ? 'bg-gradient-to-r from-yellow-50 to-yellow-100' : 'bg-gray-50' }} rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold
                                    {{ $index === 0 ? 'bg-yellow-400 text-white' : 
                                       ($index === 1 ? 'bg-gray-300 text-white' : 
                                       ($index === 2 ? 'bg-orange-400 text-white' : 'bg-gray-200 text-gray-700')) }}">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">Level {{ $user->userPoint->level ?? 1 }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-800">{{ number_format($user->userPoint->points ?? 0) }}</p>
                                <p class="text-xs text-gray-500">poin</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($userRanking > 0)
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                            <p class="text-sm text-blue-800">Peringkat Anda: <span class="font-bold">#{{ $userRanking }}</span></p>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada data peringkat</p>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('gamification.badges') }}" 
                       class="flex items-center justify-center p-4 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200">
                        <span class="text-2xl mr-2">🏅</span>
                        <span class="font-medium">Lihat Lencana</span>
                    </a>
                    
                    <a href="{{ route('gamification.leaderboard') }}" 
                       class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-200">
                        <span class="text-2xl mr-2">🏆</span>
                        <span class="font-medium">Papan Peringkat</span>
                    </a>
                    
                    <a href="{{ route('gamification.point-history') }}" 
                       class="flex items-center justify-center p-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200">
                        <span class="text-2xl mr-2">📊</span>
                        <span class="font-medium">Riwayat Poin</span>
                    </a>
                                 </div>
             </div>
         </div>
     </div>
</div>

@push('scripts')
<script>
// Sidebar functionality
let sidebarOpen = false;

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('overlay');
    
    sidebarOpen = !sidebarOpen;
    
    if (sidebarOpen) {
        // Open sidebar
        sidebar.classList.add('open');
        mainContent.classList.add('sidebar-open');
        sidebarToggle.classList.add('sidebar-open');
        overlay.classList.add('show');
    } else {
        // Close sidebar
        sidebar.classList.remove('open');
        mainContent.classList.remove('sidebar-open');
        sidebarToggle.classList.remove('sidebar-open');
        overlay.classList.remove('show');
    }
}

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('overlay');
    
    sidebar.classList.remove('open');
    mainContent.classList.remove('sidebar-open');
    sidebarToggle.classList.remove('sidebar-open');
    overlay.classList.remove('show');
    sidebarOpen = false;
}



// Close sidebar on mobile when clicking outside
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    
    if (window.innerWidth <= 768) {
        if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            closeSidebar();
        }
    }
});

// Handle window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('overlay');
        
        sidebar.classList.remove('open');
        mainContent.classList.remove('sidebar-open');
        sidebarToggle.classList.remove('sidebar-open');
        overlay.classList.remove('show');
        sidebarOpen = true;
    }
});

// Initialize sidebar
document.addEventListener('DOMContentLoaded', function() {
    // Auto-open sidebar after 2 seconds for demo
    setTimeout(() => {
        if (!sidebarOpen) {
            toggleSidebar();
        }
    }, 2000);
    
    // Update progress bar animation
    const progressFill = document.querySelector('.progress-fill');
    if (progressFill) {
        const currentWidth = progressFill.style.width;
        progressFill.style.width = '0%';
        
        setTimeout(() => {
            progressFill.style.width = currentWidth;
        }, 500);
    }
});

// EXP Details Function
function showExpDetails() {
    const currentExp = {{ Auth::user()->userPoint?->experience ?? 0 }};
    const nextLevelExp = {{ Auth::user()->userPoint?->experience_to_next_level ?? 100 }};
    const currentLevel = {{ Auth::user()->getLevel() }};
    const progressPercentage = {{ (Auth::user()->userPoint?->experience ?? 0) > 0 && (Auth::user()->userPoint?->experience_to_next_level ?? 100) > 0 ? ((Auth::user()->userPoint?->experience ?? 0) / (Auth::user()->userPoint?->experience_to_next_level ?? 100)) * 100 : 0 }};
    
    alert(`Detail EXP:\n\nCurrent Level: ${currentLevel}\nCurrent XP: ${currentExp.toLocaleString()}\nNext Level XP: ${nextLevelExp.toLocaleString()}\nProgress: ${progressPercentage.toFixed(1)}%\n\nKeep learning to reach the next level!`);
}

// Auto refresh stats every 30 seconds
setInterval(function() {
    fetch('{{ route("gamification.stats") }}')
        .then(response => response.json())
        .then(data => {
            // Update stats display
            document.querySelector('[data-stat="points"]').textContent = data.points.toLocaleString();
            document.querySelector('[data-stat="level"]').textContent = data.level;
            document.querySelector('[data-stat="experience"]').textContent = data.experience;
            document.querySelector('[data-stat="experience-to-next"]').textContent = data.experience_to_next_level;
            document.querySelector('[data-stat="progress"]').style.width = data.progress_to_next_level + '%';
            document.querySelector('[data-stat="progress-text"]').textContent = data.progress_to_next_level.toFixed(1) + '% menuju Level ' + (data.level + 1);
        })
        .catch(error => console.error('Error updating stats:', error));
}, 30000);
</script>
@endpush
@endsection 
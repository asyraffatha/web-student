@extends('layouts.app')

@section('title', 'Badges - Mathporia')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">🏅 Badge Collection</h1>
        <p class="text-gray-600">Kumpulkan badge untuk membuktikan kemampuan Anda</p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Badges</p>
                    <p class="text-3xl font-bold">{{ $badges['earned']->count() }}/{{ $allBadges->count() }}</p>
                </div>
                <div class="text-4xl">🏅</div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Completion Rate</p>
                    <p class="text-3xl font-bold">{{ $allBadges->count() > 0 ? round(($badges['earned']->count() / $allBadges->count()) * 100, 1) : 0 }}%</p>
                </div>
                <div class="text-4xl">📊</div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Recent Badge</p>
                    <p class="text-lg font-bold">{{ $badges['earned']->first() ? $badges['earned']->first()->badge->name : 'None' }}</p>
                </div>
                <div class="text-4xl">🎉</div>
            </div>
        </div>
    </div>

    <!-- Experience Progress Bar -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <span class="text-2xl mr-2">📈</span>
            Experience Progress
        </h3>
        
        @php
            $user = auth()->user();
            $userPoint = $user->userPoint;
            $currentExp = $userPoint ? $userPoint->experience : 0;
            $nextLevelExp = $userPoint ? $userPoint->experience_to_next_level : 100;
            $progressPercentage = $nextLevelExp > 0 ? ($currentExp / $nextLevelExp) * 100 : 0;
        @endphp
        
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-sm font-medium text-gray-700">Level {{ $user->getLevel() }} → Level {{ $user->getLevel() + 1 }}</span>
                <span class="text-sm font-medium text-gray-700">{{ number_format($currentExp) }}/{{ number_format($nextLevelExp) }} XP</span>
            </div>
            
            <!-- Progress Bar -->
            <div class="relative">
                <div class="w-full h-4 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full transition-all duration-1000 ease-out relative overflow-hidden" 
                         style="width: {{ $progressPercentage }}%">
                        
                        <!-- Animated Shimmer Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-30 animate-pulse transform -skew-x-12"></div>
                        
                        <!-- Glowing Edge -->
                        <div class="absolute right-0 top-0 bottom-0 w-1 bg-gradient-to-b from-transparent via-white to-transparent opacity-60"></div>
                    </div>
                </div>
                
                <!-- Progress Indicator -->
                @if($progressPercentage > 0)
                <div class="absolute top-1/2 transform -translate-y-1/2 w-6 h-6 bg-green-500 rounded-full border-2 border-white shadow-lg transition-all duration-1000 ease-out"
                     style="left: calc({{ $progressPercentage }}% - 12px);">
                    <div class="absolute inset-0 bg-green-400 rounded-full animate-ping opacity-75"></div>
                </div>
                @endif
            </div>
            
            <div class="text-center">
                <span class="text-sm text-gray-600">
                    {{ number_format($progressPercentage, 1) }}% Complete • {{ number_format($nextLevelExp - $currentExp) }} XP needed for next level
                </span>
            </div>
        </div>
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
                    Badge Boss Quiz yang Diperoleh ({{ $bossQuizBadges->count() }})
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($bossQuizBadges as $userBadge)
                    <div class="group relative">
                        <div class="bg-gradient-to-br from-yellow-200 via-orange-200 to-red-200 rounded-xl p-6 text-center transform hover:scale-105 transition-all duration-300 cursor-pointer shadow-lg hover:shadow-xl border-2 border-yellow-300">
                            <div class="text-6xl mb-4 animate-pulse">{{ $userBadge->badge->icon }}</div>
                            <h4 class="text-lg font-bold text-gray-800 mb-2">{{ $userBadge->badge->name }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ $userBadge->badge->description }}</p>
                            <div class="text-xs text-gray-500">Diperoleh {{ $userBadge->days_since_earned }} hari lalu</div>
                            
                            <!-- Special Boss Quiz Indicator -->
                            <div class="absolute -top-2 -right-2 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                                BOSS
                            </div>
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
                Badge Boss Quiz yang Tersedia ({{ $availableBossBadges->count() }})
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($availableBossBadges as $badge)
                <div class="bg-gray-100 rounded-xl p-6 text-center opacity-60 relative">
                    <div class="text-6xl mb-4">🔒</div>
                    <h4 class="text-lg font-bold text-gray-600 mb-2">{{ $badge->name }}</h4>
                    <p class="text-sm text-gray-500 mb-3">{{ $badge->description }}</p>
                    <div class="text-xs text-gray-400">Belum diperoleh</div>
                    
                    <!-- Boss Quiz Indicator -->
                    <div class="absolute -top-2 -right-2 bg-gray-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                        BOSS
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Boss Quiz Progress Info -->
            <div class="mt-6 p-6 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg border border-yellow-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h5 class="font-semibold text-gray-800 mb-2">🎯 Cara Mendapatkan Badge Boss Quiz</h5>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Kalahkan Boss Quiz dengan nilai >90</li>
                            <li>• Setiap Boss Quiz yang berhasil memberikan 1 progress</li>
                            <li>• Badge akan otomatis diberikan saat kriteria terpenuhi</li>
                        </ul>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-yellow-600">{{ $bossQuizBadges->count() }}</div>
                        <div class="text-sm text-gray-500">Badge diperoleh</div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Regular Badges Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <span class="text-2xl mr-2">🏅</span>
            Regular Badges
        </h3>
        
        @php
            $regularBadges = $badges['earned']->filter(function($userBadge) {
                return $userBadge->badge->category !== 'boss_quiz';
            });
            $availableRegularBadges = $badges['available']->filter(function($badge) {
                return $badge->category !== 'boss_quiz';
            });
        @endphp
        
        @if($regularBadges->count() > 0)
            <div class="mb-6">
                <h4 class="text-md font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="text-xl mr-2">✅</span>
                    Badge yang Diperoleh ({{ $regularBadges->count() }})
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($regularBadges as $userBadge)
                    <div class="group relative">
                        <div class="bg-gradient-to-br from-blue-200 to-purple-200 rounded-xl p-6 text-center transform hover:scale-105 transition-all duration-300 cursor-pointer shadow-lg hover:shadow-xl border-2 border-blue-300">
                            <div class="text-6xl mb-4">{{ $userBadge->badge->icon }}</div>
                            <h4 class="text-lg font-bold text-gray-800 mb-2">{{ $userBadge->badge->name }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ $userBadge->badge->description }}</p>
                            <div class="text-xs text-gray-500">Diperoleh {{ $userBadge->days_since_earned }} hari lalu</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
        
        <!-- Available Regular Badges -->
        @if($availableRegularBadges->count() > 0)
        <div class="border-t border-gray-200 pt-6">
            <h4 class="text-md font-semibold text-gray-700 mb-3 flex items-center">
                <span class="text-xl mr-2">🔒</span>
                Badge yang Tersedia ({{ $availableRegularBadges->count() }})
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($availableRegularBadges as $badge)
                <div class="bg-gray-100 rounded-xl p-6 text-center opacity-60">
                    <div class="text-6xl mb-4">🔒</div>
                    <h4 class="text-lg font-bold text-gray-600 mb-2">{{ $badge->name }}</h4>
                    <p class="text-sm text-gray-500 mb-3">{{ $badge->description }}</p>
                    <div class="text-xs text-gray-400">Belum diperoleh</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Back to Dashboard -->
    <div class="text-center">
        <a href="{{ route('gamification.dashboard') }}" 
           class="inline-block bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 hover:scale-105 hover:shadow-lg">
            🏠 Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection 
@extends('layouts.app')

@section('title', 'Lencana & Pencapaian - Mathporia')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">🏅 Lencana & Pencapaian</h1>
        <p class="text-gray-600">Lihat semua lencana yang telah Anda dapatkan</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium">Lencana Diperoleh</p>
                    <p class="text-3xl font-bold">{{ $badges['total_earned'] }}</p>
                </div>
                <div class="text-4xl">🏅</div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Lencana</p>
                    <p class="text-3xl font-bold">{{ $badges['total_available'] + $badges['total_earned'] }}</p>
                </div>
                <div class="text-4xl">🎯</div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Progress</p>
                    <p class="text-3xl font-bold">{{ $badges['total_earned'] > 0 ? round(($badges['total_earned'] / ($badges['total_available'] + $badges['total_earned'])) * 100) : 0 }}%</p>
                </div>
                <div class="text-4xl">📊</div>
            </div>
        </div>
    </div>

    <!-- Progress Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <span class="text-2xl mr-2">📈</span>
            Progress Experience & Level
        </h3>
        
        <!-- Level Progress -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Current Level -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-semibold text-green-800">Current Level</h4>
                    <span class="text-2xl">🎯</span>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-600 mb-2">{{ $stats['level'] }}</div>
                    <div class="text-sm text-green-700">{{ $stats['level_title'] }}</div>
                </div>
            </div>
            
            <!-- Next Level -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-semibold text-blue-800">Next Level</h4>
                    <span class="text-2xl">🚀</span>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">{{ $stats['level'] + 1 }}</div>
                    <div class="text-sm text-blue-700">{{ $stats['next_level_title'] ?? 'Pembelajar' }}</div>
                </div>
            </div>
        </div>
        
        <!-- Experience Progress Bar -->
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-semibold text-purple-800">Experience Progress</h4>
                <div class="text-right">
                    <div class="text-2xl font-bold text-purple-600">{{ number_format($stats['progress_to_next_level'], 1) }}%</div>
                    <div class="text-sm text-purple-600">Progress</div>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="relative mb-4">
                <div class="w-full h-6 bg-purple-200 rounded-full overflow-hidden border-2 border-purple-300 relative">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-20"></div>
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 3px, rgba(147,51,234,0.05) 3px, rgba(147,51,234,0.05) 6px);"></div>
                    
                    <!-- Progress Fill with Advanced Effects -->
                    <div class="h-full bg-gradient-to-r from-purple-500 via-purple-400 to-purple-300 rounded-full transition-all duration-1500 ease-out relative overflow-hidden shadow-lg" 
                         style="width: {{ $stats['progress_to_next_level'] }}%">
                        
                        <!-- Animated Shimmer -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-40 animate-pulse transform -skew-x-12"></div>
                        
                        <!-- Glowing Edge -->
                        <div class="absolute right-0 top-0 bottom-0 w-1 bg-gradient-to-b from-transparent via-white to-transparent opacity-60 shadow-lg"></div>
                        
                        <!-- Floating Particles -->
                        <div class="absolute inset-0">
                            <div class="absolute top-1/2 left-1/4 w-2 h-2 bg-white rounded-full animate-ping shadow-lg"></div>
                            <div class="absolute top-1/2 left-1/2 w-1.5 h-1.5 bg-white rounded-full animate-ping shadow-lg" style="animation-delay: 0.3s;"></div>
                            <div class="absolute top-1/2 left-3/4 w-1 h-1 bg-white rounded-full animate-ping shadow-lg" style="animation-delay: 0.6s;"></div>
                        </div>
                        
                        <!-- Level Up Indicator -->
                        @if($stats['progress_to_next_level'] > 90)
                        <div class="absolute right-2 top-1/2 transform -translate-y-1/2 w-3 h-3 bg-yellow-400 rounded-full animate-pulse shadow-lg border-2 border-white"></div>
                        @endif
                    </div>
                    
                    <!-- Progress Text -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-white bg-opacity-95 backdrop-blur-sm px-4 py-1 rounded-full shadow-lg border border-purple-200">
                            <span class="text-sm font-bold text-purple-800">
                                {{ number_format($stats['experience']) }} / {{ number_format($stats['experience_to_next_level']) }} XP
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Progress Labels -->
                <div class="flex justify-between mt-2 text-sm text-purple-600">
                    <span>Level {{ $stats['level'] }}</span>
                    <span class="font-semibold">{{ number_format($stats['progress_to_next_level'], 1) }}%</span>
                    <span>Level {{ $stats['level'] + 1 }}</span>
                </div>
            </div>
            
            <!-- XP Details -->
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="bg-white bg-opacity-50 rounded-lg p-3">
                    <div class="text-lg font-bold text-purple-600">{{ number_format($stats['experience']) }}</div>
                    <div class="text-xs text-purple-600">Current XP</div>
                </div>
                <div class="bg-white bg-opacity-50 rounded-lg p-3">
                    <div class="text-lg font-bold text-purple-600">{{ number_format($stats['experience_to_next_level'] - $stats['experience']) }}</div>
                    <div class="text-xs text-purple-600">XP Needed</div>
                </div>
                <div class="bg-white bg-opacity-50 rounded-lg p-3">
                    <div class="text-lg font-bold text-purple-600">{{ number_format($stats['experience_to_next_level']) }}</div>
                    <div class="text-xs text-purple-600">Next Level</div>
                </div>
            </div>
        </div>
        
        <!-- Level Up Motivation -->
        @if($stats['progress_to_next_level'] > 70)
        <div class="mt-4 p-4 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-lg border border-yellow-300">
            <div class="flex items-center space-x-3">
                <span class="text-3xl">🎉</span>
                <div>
                    <div class="font-semibold text-yellow-800">Hampir Naik Level!</div>
                    <div class="text-sm text-yellow-700">Tinggal {{ number_format($stats['experience_to_next_level'] - $stats['experience']) }} XP lagi untuk mencapai Level {{ $stats['level'] + 1 }}</div>
                </div>
            </div>
        </div>
        @elseif($stats['progress_to_next_level'] > 30)
        <div class="mt-4 p-4 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-lg border border-blue-300">
            <div class="flex items-center space-x-3">
                <span class="text-3xl">💪</span>
                <div>
                    <div class="font-semibold text-blue-800">Keep Going!</div>
                    <div class="text-sm text-blue-700">Anda sudah {{ number_format($stats['progress_to_next_level'], 1) }}% menuju level berikutnya</div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Earned Badges -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <span class="text-2xl mr-2">🏆</span>
            Lencana yang Telah Diperoleh
        </h3>
        
        @if($badges['earned']->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($badges['earned'] as $userBadge)
                <div class="group relative">
                    <div class="bg-gradient-to-br from-yellow-200 via-yellow-300 to-yellow-400 rounded-2xl p-6 text-center transform hover:scale-105 transition-all duration-300 cursor-pointer shadow-lg hover:shadow-2xl border-2 border-yellow-300">
                        <!-- Badge Icon with Animation -->
                        <div class="relative mb-4">
                            <div class="text-6xl animate-bounce">{{ $userBadge->badge->icon ?? '🏅' }}</div>
                            <div class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center animate-pulse">
                                ✓
                            </div>
                        </div>
                        
                        <!-- Badge Info -->
                        <h4 class="text-lg font-bold text-gray-800 mb-2">{{ $userBadge->badge->name }}</h4>
                        <p class="text-sm text-gray-600 mb-3">{{ $userBadge->badge->description }}</p>
                        
                        <!-- Earned Date -->
                        <div class="bg-yellow-100 rounded-lg p-2">
                            <div class="text-xs text-yellow-800 font-medium">Diperoleh</div>
                            <div class="text-xs text-yellow-700">{{ $userBadge->formatted_earned_date }}</div>
                            <div class="text-xs text-yellow-600">{{ $userBadge->days_since_earned }} hari yang lalu</div>
                        </div>
                        
                        <!-- Category Badge -->
                        <div class="mt-3">
                            <span class="inline-block px-2 py-1 text-xs font-medium rounded-full
                                {{ $userBadge->badge->category === 'achievement' ? 'bg-green-100 text-green-800' : 
                                   ($userBadge->badge->category === 'milestone' ? 'bg-blue-100 text-blue-800' : 
                                   'bg-purple-100 text-purple-800') }}">
                                {{ ucfirst($userBadge->badge->category) }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Hover Effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    
                    <!-- Sparkle Effect -->
                    <div class="absolute top-2 right-2 text-yellow-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        ✨
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-8xl mb-6 animate-bounce">😢</div>
                <p class="text-gray-500 text-xl mb-2">Belum ada lencana yang diperoleh</p>
                <p class="text-gray-400 text-sm mb-6">Mulai belajar untuk mendapatkan lencana pertama Anda!</p>
                <div class="flex justify-center space-x-4">
                    <div class="text-center">
                        <div class="text-3xl mb-2">📚</div>
                        <div class="text-xs text-gray-500">Selesaikan materi</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl mb-2">📝</div>
                        <div class="text-xs text-gray-500">Kerjakan quiz</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl mb-2">💬</div>
                        <div class="text-xs text-gray-500">Berpartisipasi forum</div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Available Badges -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <span class="text-2xl mr-2">🔒</span>
            Lencana yang Tersedia
        </h3>
        
        @if($badges['available']->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($badges['available'] as $badge)
                <div class="group relative">
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl p-6 text-center transform hover:scale-105 transition-all duration-300 cursor-pointer shadow-lg border-2 border-gray-300 opacity-75 hover:opacity-90">
                        <!-- Badge Icon -->
                        <div class="relative mb-4">
                            <div class="text-6xl filter grayscale">{{ $badge->icon ?? '🔒' }}</div>
                            <div class="absolute -top-2 -right-2 bg-gray-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center">
                                🔒
                            </div>
                        </div>
                        
                        <!-- Badge Info -->
                        <h4 class="text-lg font-bold text-gray-600 mb-2">{{ $badge->name }}</h4>
                        <p class="text-sm text-gray-500 mb-3">{{ $badge->description }}</p>
                        
                        <!-- Criteria -->
                        <div class="bg-gray-50 rounded-lg p-2">
                            <div class="text-xs text-gray-600 font-medium">Kriteria</div>
                            <div class="text-xs text-gray-500">
                                @foreach($badge->criteria as $criterion)
                                    <div class="mt-1">
                                        {{ ucfirst($criterion['type'] ?? 'unknown') }}: {{ $criterion['value'] ?? 0 }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Category Badge -->
                        <div class="mt-3">
                            <span class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-gray-200 text-gray-600">
                                {{ ucfirst($badge->category) }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Lock Effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-400 to-gray-500 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300"></div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-8xl mb-6">🎉</div>
                <p class="text-green-600 text-xl mb-2 font-bold">Selamat!</p>
                <p class="text-gray-500 text-sm">Anda telah memperoleh semua lencana yang tersedia!</p>
            </div>
        @endif
    </div>

    <!-- All Badges by Category -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Semua Lencana berdasarkan Kategori</h3>
        
        <div class="space-y-6">
            <!-- Achievement Badges -->
            <div>
                <h4 class="text-md font-semibold text-gray-700 mb-3">🏆 Achievement Badges</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($allBadges->where('category', 'achievement') as $badge)
                    <div class="flex items-center space-x-3 p-3 {{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? 'bg-yellow-50 border border-yellow-200' : 'bg-gray-50 border border-gray-200' }} rounded-lg">
                        <div class="w-10 h-10 {{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? 'bg-yellow-200' : 'bg-gray-200' }} rounded-full flex items-center justify-center">
                            <span class="text-lg">{{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? '🏅' : '🔒' }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium {{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? 'text-gray-800' : 'text-gray-600' }}">{{ $badge->name }}</p>
                            <p class="text-xs text-gray-500">{{ $badge->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Milestone Badges -->
            <div>
                <h4 class="text-md font-semibold text-gray-700 mb-3">🎯 Milestone Badges</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($allBadges->where('category', 'milestone') as $badge)
                    <div class="flex items-center space-x-3 p-3 {{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? 'bg-yellow-50 border border-yellow-200' : 'bg-gray-50 border border-gray-200' }} rounded-lg">
                        <div class="w-10 h-10 {{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? 'bg-yellow-200' : 'bg-gray-200' }} rounded-full flex items-center justify-center">
                            <span class="text-lg">{{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? '🏅' : '🔒' }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium {{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? 'text-gray-800' : 'text-gray-600' }}">{{ $badge->name }}</p>
                            <p class="text-xs text-gray-500">{{ $badge->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Special Badges -->
            <div>
                <h4 class="text-md font-semibold text-gray-700 mb-3">⭐ Special Badges</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($allBadges->where('category', 'special') as $badge)
                    <div class="flex items-center space-x-3 p-3 {{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? 'bg-yellow-50 border border-yellow-200' : 'bg-gray-50 border border-gray-200' }} rounded-lg">
                        <div class="w-10 h-10 {{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? 'bg-yellow-200' : 'bg-gray-200' }} rounded-full flex items-center justify-center">
                            <span class="text-lg">{{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? '🏅' : '🔒' }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium {{ $badges['earned']->where('badge_id', $badge->id)->count() > 0 ? 'text-gray-800' : 'text-gray-600' }}">{{ $badge->name }}</p>
                            <p class="text-xs text-gray-500">{{ $badge->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8 text-center">
        <a href="{{ route('gamification.dashboard') }}" 
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
            <span class="mr-2">←</span>
            Kembali ke Dashboard
        </a>
    </div>
</div>

@push('scripts')
<script>
// Function to get criteria description (placeholder)
function getCriteriaDescription(badge) {
    // This would be implemented in the backend
    return 'Kriteria khusus';
}
</script>
@endpush
@endsection 
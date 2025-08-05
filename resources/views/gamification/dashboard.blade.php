@extends('layouts.app')

@section('title', 'Dashboard Gamifikasi - Mathporia')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">🏆 Dashboard Gamifikasi</h1>
        <p class="text-gray-600">Lihat progress belajar dan capaian Anda</p>
    </div>

    <!-- Stats Cards - Consistent Size and Color -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Points -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white h-32 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Poin</p>
                    <p class="text-3xl font-bold">{{ number_format($stats['points']) }}</p>
                </div>
                <div class="text-4xl">⭐</div>
            </div>
        </div>

        <!-- Level -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white h-32 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Level</p>
                    <p class="text-3xl font-bold">{{ $stats['level'] }}</p>
                    <p class="text-green-100 text-sm">{{ $stats['level_title'] }}</p>
                </div>
                <div class="text-4xl">🎯</div>
            </div>
        </div>

        <!-- Experience Progress -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white h-32 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Experience</p>
                    <p class="text-3xl font-bold">{{ $stats['experience'] }}</p>
                    <p class="text-purple-100 text-sm">/ {{ $stats['experience_to_next_level'] }}</p>
                </div>
                <div class="text-4xl">📈</div>
            </div>
        </div>

        <!-- Badges -->
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-6 text-white h-32 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium">Lencana</p>
                    <p class="text-3xl font-bold">{{ $stats['badges_earned'] }}</p>
                    <p class="text-yellow-100 text-sm">/ {{ $stats['total_badges'] }}</p>
                </div>
                <div class="text-4xl">🏅</div>
            </div>
        </div>
    </div>

    <!-- Cute Badge Showcase -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <span class="text-2xl mr-2">🎖️</span>
            Badge Collection
        </h3>
        
        @if($badges['earned']->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($badges['earned'] as $userBadge)
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
        
        <!-- Available Badges Preview -->
        @if($badges['available']->count() > 0)
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h4 class="text-md font-semibold text-gray-700 mb-3 flex items-center">
                <span class="text-xl mr-2">🔒</span>
                Badge yang Tersedia
            </h4>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($badges['available']->take(6) as $badge)
                <div class="bg-gray-100 rounded-xl p-4 text-center opacity-60">
                    <div class="text-4xl mb-2">🔒</div>
                    <div class="text-xs font-semibold text-gray-600">{{ $badge->name }}</div>
                    <div class="text-xs text-gray-500 mt-1">Belum diperoleh</div>
                </div>
                @endforeach
                @if($badges['available']->count() > 6)
                <div class="bg-gray-100 rounded-xl p-4 text-center opacity-60 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-2xl mb-1">+{{ $badges['available']->count() - 6 }}</div>
                        <div class="text-xs text-gray-600">Badge lainnya</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

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
        
        <!-- Compact Progress Bar -->
        <div class="relative">
            <!-- Background Bar -->
            <div class="w-full h-6 bg-white rounded-full overflow-hidden border border-gray-200 relative">
                <!-- Progress Fill - Gradasi Hijau -->
                <div class="h-full bg-gradient-to-r from-green-500 via-green-400 to-green-300 rounded-full transition-all duration-1500 ease-out relative overflow-hidden" 
                     style="width: {{ $stats['progress_to_next_level'] }}%">
                    
                    <!-- Animated Shimmer Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-30 animate-pulse transform -skew-x-12"></div>
                    
                    <!-- Glowing Edge -->
                    <div class="absolute right-0 top-0 bottom-0 w-1 bg-gradient-to-b from-transparent via-white to-transparent opacity-60"></div>
                </div>
                
                <!-- Progress Text Overlay - Dihilangkan -->
            </div>
            
            <!-- Progress Details -->
            <div class="flex justify-between mt-2 text-xs text-gray-500">
                <span>{{ number_format($stats['experience']) }}/{{ number_format($stats['experience_to_next_level']) }}</span>
                <span class="font-semibold text-green-600">{{ number_format(100 - $stats['progress_to_next_level'], 1) }}% tersisa</span>
            </div>
        </div>
    </div>

    <!-- Detailed Stats Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <span class="text-2xl mr-2">📊</span>
            Statistik Detail
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Experience Details -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-semibold text-green-800">📈 Experience</h4>
                    <span class="text-2xl">🎯</span>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-green-700">Current XP:</span>
                        <span class="font-bold text-green-800">{{ number_format($stats['experience']) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-green-700">Next Level:</span>
                        <span class="font-bold text-green-800">{{ number_format($stats['experience_to_next_level']) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-green-700">Progress:</span>
                        <span class="font-bold text-green-800">{{ number_format($stats['progress_to_next_level'], 1) }}%</span>
                    </div>
                </div>
            </div>
            
            <!-- Points Details -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-semibold text-blue-800">⭐ Points</h4>
                    <span class="text-2xl">💎</span>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-blue-700">Total Points:</span>
                        <span class="font-bold text-blue-800">{{ number_format($stats['points']) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-blue-700">Level:</span>
                        <span class="font-bold text-blue-800">{{ $stats['level'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-blue-700">Title:</span>
                        <span class="font-bold text-blue-800">{{ $stats['level_title'] }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Badge Details -->
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-semibold text-yellow-800">🏅 Badges</h4>
                    <span class="text-2xl">🎖️</span>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-yellow-700">Earned:</span>
                        <span class="font-bold text-yellow-800">{{ $stats['badges_earned'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-yellow-700">Available:</span>
                        <span class="font-bold text-yellow-800">{{ $stats['total_badges'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-yellow-700">Progress:</span>
                        <span class="font-bold text-yellow-800">{{ $stats['total_badges'] > 0 ? round(($stats['badges_earned'] / $stats['total_badges']) * 100) : 0 }}%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Activities -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
            @if($recentActivities->count() > 0)
                <div class="space-y-3">
                    @foreach($recentActivities as $activity)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 text-sm font-bold">+{{ $activity->points_earned }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $activity->description }}</p>
                                <p class="text-xs text-gray-500">{{ $activity->formatted_date }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Belum ada aktivitas</p>
            @endif
        </div>

        <!-- Recent Achievements -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pencapaian Terbaru</h3>
            @if($recentAchievements->count() > 0)
                <div class="space-y-3">
                    @foreach($recentAchievements as $achievement)
                    <div class="flex items-center space-x-3 p-3 bg-yellow-50 rounded-lg">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            <span class="text-yellow-600 text-lg">🏅</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $achievement->badge->name }}</p>
                            <p class="text-xs text-gray-500">{{ $achievement->formatted_earned_date }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Belum ada pencapaian</p>
            @endif
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

@push('scripts')
<script>
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
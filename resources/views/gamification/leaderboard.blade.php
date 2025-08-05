@extends('layouts.app')

@section('title', 'Papan Peringkat - Mathporia')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">🏆 Papan Peringkat</h1>
        <p class="text-gray-600">Lihat peringkat siswa berdasarkan poin yang dikumpulkan</p>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('gamification.leaderboard', ['type' => 'all_time']) }}" 
               class="px-4 py-2 rounded-lg font-medium transition-colors duration-200 {{ $type === 'all_time' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Sepanjang Waktu
            </a>
            <a href="{{ route('gamification.leaderboard', ['type' => 'weekly']) }}" 
               class="px-4 py-2 rounded-lg font-medium transition-colors duration-200 {{ $type === 'weekly' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Mingguan
            </a>
            <a href="{{ route('gamification.leaderboard', ['type' => 'monthly']) }}" 
               class="px-4 py-2 rounded-lg font-medium transition-colors duration-200 {{ $type === 'monthly' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Bulanan
            </a>
        </div>
    </div>

    <!-- User Ranking -->
    @if($userRanking > 0)
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-6 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold mb-2">Peringkat Anda</h3>
                <p class="text-3xl font-bold">#{{ $userRanking }}</p>
                <p class="text-blue-100 text-sm">dari {{ $leaderboard->count() }} siswa</p>
            </div>
            <div class="text-6xl">🎯</div>
        </div>
    </div>
    @endif

    <!-- Leaderboard Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Peringkat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Siswa
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Level & Badges
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Poin & Experience
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Progress
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($leaderboard as $index => $entry)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <!-- Rank -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($index < 3)
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold
                                        {{ $index === 0 ? 'bg-yellow-500' : ($index === 1 ? 'bg-gray-400' : 'bg-orange-500') }}">
                                        {{ $index + 1 }}
                                    </div>
                                @else
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                @endif
                            </div>
                        </td>

                        <!-- User Info -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($entry->user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $entry->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $entry->user->email }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Level & Badges -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <!-- Level Badge -->
                                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                                    Level {{ $entry->user->getLevel() }}
                                </div>
                                
                                <!-- Badge Count -->
                                <div class="flex items-center space-x-1">
                                    <span class="text-lg">🏅</span>
                                    <span class="text-sm font-medium text-gray-700">{{ $entry->user->getEarnedBadges()->count() }}</span>
                                </div>
                                
                                <!-- Top Badges Preview -->
                                <div class="flex space-x-1">
                                    @foreach($entry->user->getEarnedBadges()->take(3) as $userBadge)
                                    <div class="relative group">
                                        <div class="text-lg cursor-pointer">{{ $userBadge->badge->icon ?? '🏅' }}</div>
                                        <!-- Badge Tooltip -->
                                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 whitespace-nowrap">
                                            {{ $userBadge->badge->name }}
                                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </td>

                        <!-- Points & Experience -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="space-y-2">
                                <!-- Points -->
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg">⭐</span>
                                    <span class="text-sm font-medium text-gray-900">{{ number_format($entry->points) }}</span>
                                    <span class="text-xs text-gray-500">poin</span>
                                </div>
                                
                                <!-- Experience -->
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg">📈</span>
                                    <span class="text-sm font-medium text-gray-900">{{ number_format($entry->user->userPoint?->experience ?? 0) }}</span>
                                    <span class="text-xs text-gray-500">XP</span>
                                </div>
                            </div>
                        </td>

                        <!-- Progress -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="space-y-2">
                                <!-- Progress Bar -->
                                <div class="relative">
                                    <div class="w-full h-4 bg-gray-200 rounded-full overflow-hidden border border-gray-300 relative">
                                        <!-- Background Pattern -->
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-15"></div>
                                        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 2px, rgba(16,185,129,0.03) 2px, rgba(16,185,129,0.03) 4px);"></div>
                                        
                                        <!-- Progress Fill with Advanced Effects -->
                                        <div class="h-full bg-gradient-to-r from-green-500 via-green-400 to-green-300 rounded-full transition-all duration-500 ease-out relative overflow-hidden shadow-md" 
                                             style="width: {{ $entry->user->getProgressToNextLevel() }}%">
                                            
                                            <!-- Animated Shimmer -->
                                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-30 animate-pulse transform -skew-x-12"></div>
                                            
                                            <!-- Glowing Edge -->
                                            <div class="absolute right-0 top-0 bottom-0 w-0.5 bg-gradient-to-b from-transparent via-white to-transparent opacity-50 shadow-sm"></div>
                                            
                                            <!-- Progress Particles -->
                                            <div class="absolute inset-0">
                                                <div class="absolute top-1/2 left-1/4 w-1 h-1 bg-white rounded-full animate-ping shadow-sm"></div>
                                                <div class="absolute top-1/2 left-1/2 w-0.5 h-0.5 bg-white rounded-full animate-ping shadow-sm" style="animation-delay: 0.3s;"></div>
                                                <div class="absolute top-1/2 left-3/4 w-0.5 h-0.5 bg-white rounded-full animate-ping shadow-sm" style="animation-delay: 0.6s;"></div>
                                            </div>
                                            
                                            <!-- Level Up Indicator -->
                                            @if($entry->user->getProgressToNextLevel() > 90)
                                            <div class="absolute right-1 top-1/2 transform -translate-y-1/2 w-2 h-2 bg-yellow-400 rounded-full animate-pulse shadow-sm border border-white"></div>
                                            @endif
                                        </div>
                                        
                                        <!-- Progress Text Overlay -->
                                                                <!-- Progress Text Overlay - Dihilangkan -->
                                    </div>
                                    
                                    <!-- Progress Details -->
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ number_format($entry->user->userPoint?->experience ?? 0) }}/{{ number_format($entry->user->userPoint?->experience_to_next_level ?? 100) }} XP
                                    </div>
                                    
                                    <!-- Level Up Indicator -->
                                    @if($entry->user->getProgressToNextLevel() > 90)
                                    <div class="text-xs text-green-600 font-medium flex items-center mt-1">
                                        <span class="mr-1">🚀</span> Hampir naik level!
                                    </div>
                                    @elseif($entry->user->getProgressToNextLevel() > 50)
                                    <div class="text-xs text-blue-600 font-medium flex items-center mt-1">
                                        <span class="mr-1">💪</span> Progress bagus!
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Siswa</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $leaderboard->count() }}</p>
                </div>
                <div class="text-3xl">👥</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Rata-rata Poin</p>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ $leaderboard->count() > 0 ? number_format($leaderboard->avg(function($user) { return $user->userPoint->points ?? 0; })) : 0 }}
                    </p>
                </div>
                <div class="text-3xl">📊</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Poin Tertinggi</p>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ $leaderboard->count() > 0 ? number_format($leaderboard->max(function($user) { return $user->userPoint->points ?? 0; })) : 0 }}
                    </p>
                </div>
                <div class="text-3xl">🏅</div>
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
// Auto refresh leaderboard every 60 seconds
setInterval(function() {
    fetch('{{ route("gamification.leaderboard-data") }}?type={{ $type }}')
        .then(response => response.json())
        .then(data => {
            // Update leaderboard data
            console.log('Leaderboard updated:', data);
        })
        .catch(error => console.error('Error updating leaderboard:', error));
}, 60000);
</script>
@endpush
@endsection 
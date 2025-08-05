@extends('layouts.app')

@section('title', 'Riwayat Poin - Mathporia')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">📊 Riwayat Poin</h1>
        <p class="text-gray-600">Lihat semua aktivitas yang memberikan poin</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Points Earned -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Poin</p>
                    <p class="text-3xl font-bold">{{ number_format($summary['total_points']) }}</p>
                </div>
                <div class="text-4xl">⭐</div>
            </div>
        </div>

        <!-- Total Experience -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Experience</p>
                    <p class="text-3xl font-bold">{{ number_format($summary['total_experience']) }}</p>
                </div>
                <div class="text-4xl">📈</div>
            </div>
        </div>

        <!-- Activities Count -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Aktivitas</p>
                    <p class="text-3xl font-bold">{{ $summary['activities_count'] }}</p>
                </div>
                <div class="text-4xl">🎯</div>
            </div>
        </div>

        <!-- Average Points per Activity -->
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium">Rata-rata Poin</p>
                    <p class="text-3xl font-bold">{{ number_format($summary['average_points'], 1) }}</p>
                </div>
                <div class="text-4xl">📊</div>
            </div>
        </div>
    </div>

    <!-- Detailed Stats Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <span class="text-2xl mr-2">📊</span>
            Statistik Detail Aktivitas
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Quiz Activities -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-semibold text-blue-800">📝 Quiz Activities</h4>
                    <span class="text-2xl">🎯</span>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-blue-700">Total Quiz:</span>
                        <span class="font-bold text-blue-800">{{ $summary['quiz_activities'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-blue-700">Perfect Scores:</span>
                        <span class="font-bold text-blue-800">{{ $summary['perfect_scores'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-blue-700">High Scores:</span>
                        <span class="font-bold text-blue-800">{{ $summary['high_scores'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Material Activities -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-semibold text-green-800">📚 Material Activities</h4>
                    <span class="text-2xl">📖</span>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-green-700">Materials Completed:</span>
                        <span class="font-bold text-green-800">{{ $summary['material_activities'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-green-700">Videos Watched:</span>
                        <span class="font-bold text-green-800">{{ $summary['video_activities'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-green-700">Documents Read:</span>
                        <span class="font-bold text-green-800">{{ $summary['document_activities'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Engagement Activities -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-semibold text-purple-800">💬 Engagement Activities</h4>
                    <span class="text-2xl">🎮</span>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-purple-700">Daily Logins:</span>
                        <span class="font-bold text-purple-800">{{ $summary['login_activities'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-purple-700">Forum Posts:</span>
                        <span class="font-bold text-purple-800">{{ $summary['forum_activities'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-purple-700">Comments:</span>
                        <span class="font-bold text-purple-800">{{ $summary['comment_activities'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Options -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Aktivitas</h3>
        <div class="flex flex-wrap gap-4">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200" 
                    onclick="filterActivities('all')">
                Semua
            </button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200" 
                    onclick="filterActivities('quiz')">
                Kuis
            </button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200" 
                    onclick="filterActivities('learning')">
                Pembelajaran
            </button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200" 
                    onclick="filterActivities('engagement')">
                Engagement
            </button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200" 
                    onclick="filterActivities('special')">
                Khusus
            </button>
        </div>
    </div>

    <!-- Activity List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Riwayat Aktivitas</h3>
        </div>
        
        @if($activities->count() > 0)
            <div class="divide-y divide-gray-200" id="activities-list">
                @foreach($activities as $activity)
                <div class="p-6 hover:bg-gray-50 transition-colors duration-200 activity-item" 
                     data-category="{{ $activity->pointActivity->category ?? 'other' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <!-- Activity Icon -->
                            <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold
                                {{ $activity->pointActivity->category === 'quiz' ? 'bg-blue-500' : 
                                   ($activity->pointActivity->category === 'learning' ? 'bg-green-500' : 
                                   ($activity->pointActivity->category === 'engagement' ? 'bg-purple-500' : 
                                   ($activity->pointActivity->category === 'special' ? 'bg-yellow-500' : 'bg-gray-500'))) }}">
                                {{ $activity->pointActivity->category === 'quiz' ? '📝' : 
                                   ($activity->pointActivity->category === 'learning' ? '📚' : 
                                   ($activity->pointActivity->category === 'engagement' ? '💬' : 
                                   ($activity->pointActivity->category === 'special' ? '⭐' : '📊'))) }}
                            </div>
                            
                            <!-- Activity Details -->
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <h4 class="font-semibold text-gray-800">{{ $activity->description }}</h4>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        {{ $activity->pointActivity->category === 'quiz' ? 'bg-blue-100 text-blue-800' : 
                                           ($activity->pointActivity->category === 'learning' ? 'bg-green-100 text-green-800' : 
                                           ($activity->pointActivity->category === 'engagement' ? 'bg-purple-100 text-purple-800' : 
                                           ($activity->pointActivity->category === 'special' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800'))) }}">
                                        {{ ucfirst($activity->pointActivity->category ?? 'other') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500">{{ $activity->pointActivity->description }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $activity->formatted_date }}</p>
                            </div>
                        </div>
                        
                        <!-- Points Earned -->
                        <div class="text-right">
                            <div class="flex items-center space-x-2">
                                <span class="text-2xl font-bold text-green-600">+{{ $activity->points_earned }}</span>
                                <span class="text-sm text-gray-500">poin</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Metadata (if any) -->
                    @if($activity->metadata && count($activity->metadata) > 0)
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <div class="flex flex-wrap gap-2">
                            @foreach($activity->metadata as $key => $value)
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">
                                {{ ucfirst($key) }}: {{ is_array($value) ? json_encode($value) : $value }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="p-8 text-center">
                <div class="text-6xl mb-4">📊</div>
                <p class="text-gray-500 text-lg">Belum ada aktivitas yang tercatat</p>
                <p class="text-gray-400 text-sm mt-2">Mulai belajar untuk mendapatkan poin pertama Anda!</p>
            </div>
        @endif
    </div>

    <!-- Activity Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <!-- Category Breakdown -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Poin berdasarkan Kategori</h3>
            <div class="space-y-3">
                @php
                    $categoryStats = $activities->groupBy('pointActivity.category')->map(function($group) {
                        return [
                            'count' => $group->count(),
                            'points' => $group->sum('points_earned')
                        ];
                    });
                @endphp
                
                @foreach($categoryStats as $category => $stats)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold
                            {{ $category === 'quiz' ? 'bg-blue-500' : 
                               ($category === 'learning' ? 'bg-green-500' : 
                               ($category === 'engagement' ? 'bg-purple-500' : 
                               ($category === 'special' ? 'bg-yellow-500' : 'bg-gray-500'))) }}">
                            {{ $category === 'quiz' ? '📝' : 
                               ($category === 'learning' ? '📚' : 
                               ($category === 'engagement' ? '💬' : 
                               ($category === 'special' ? '⭐' : '📊'))) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ ucfirst($category) }}</p>
                            <p class="text-sm text-gray-500">{{ $stats['count'] }} aktivitas</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-800">{{ number_format($stats['points']) }}</p>
                        <p class="text-sm text-gray-500">poin</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas 7 Hari Terakhir</h3>
            <div class="space-y-3">
                @php
                    $last7Days = collect();
                    for($i = 6; $i >= 0; $i--) {
                        $date = now()->subDays($i);
                        $dayActivities = $activities->where('created_at', '>=', $date->startOfDay())
                                                   ->where('created_at', '<', $date->copy()->addDay()->startOfDay());
                        $last7Days->put($date->format('Y-m-d'), [
                            'date' => $date->format('d M'),
                            'points' => $dayActivities->sum('points_earned'),
                            'count' => $dayActivities->count()
                        ]);
                    }
                @endphp
                
                @foreach($last7Days as $date => $data)
                <div class="flex items-center justify-between p-3 {{ $data['points'] > 0 ? 'bg-green-50' : 'bg-gray-50' }} rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold
                            {{ $data['points'] > 0 ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600' }}">
                            {{ $data['points'] > 0 ? '✓' : '-' }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $data['date'] }}</p>
                            <p class="text-sm text-gray-500">{{ $data['count'] }} aktivitas</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold {{ $data['points'] > 0 ? 'text-green-600' : 'text-gray-500' }}">
                            {{ number_format($data['points']) }}
                        </p>
                        <p class="text-sm text-gray-500">poin</p>
                    </div>
                </div>
                @endforeach
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
function filterActivities(category) {
    const activities = document.querySelectorAll('.activity-item');
    const buttons = document.querySelectorAll('[onclick^="filterActivities"]');
    
    // Update button styles
    buttons.forEach(button => {
        button.className = button.className.replace('bg-blue-600 text-white', 'bg-gray-100 text-gray-700');
        button.className = button.className.replace('hover:bg-blue-700', 'hover:bg-gray-200');
    });
    
    // Highlight active button
    event.target.className = event.target.className.replace('bg-gray-100 text-gray-700', 'bg-blue-600 text-white');
    event.target.className = event.target.className.replace('hover:bg-gray-200', 'hover:bg-blue-700');
    
    // Filter activities
    activities.forEach(activity => {
        const activityCategory = activity.dataset.category;
        if (category === 'all' || activityCategory === category) {
            activity.style.display = 'block';
        } else {
            activity.style.display = 'none';
        }
    });
}
</script>
@endpush
@endsection 
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GamificationService;
use App\Models\User;
use App\Models\Badge;
use App\Models\PointActivity;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class GamificationController extends Controller
{
    protected $gamificationService;

    public function __construct(GamificationService $gamificationService)
    {
        $this->gamificationService = $gamificationService;
    }

    /**
     * Show user's gamification dashboard
     */
    public function dashboard(): View
    {
        $user = auth()->user();
        $stats = $this->gamificationService->getUserStats($user);
        $badges = $this->gamificationService->getAvailableBadges($user);
        $leaderboard = $this->gamificationService->getLeaderboard('all_time', 10);
        $userRanking = $this->gamificationService->getUserRanking($user);
        $recentActivities = $this->gamificationService->getUserPointHistory($user, 10);
        $recentAchievements = $this->gamificationService->getRecentAchievements($user, 5);

        return view('gamification.dashboard', compact(
            'stats',
            'badges',
            'leaderboard',
            'userRanking',
            'recentActivities',
            'recentAchievements'
        ));
    }

    /**
     * Show user's badges
     */
    public function badges(): View
    {
        $user = auth()->user();
        $badges = $this->gamificationService->getAvailableBadges($user);
        $allBadges = Badge::active()->get();

        return view('gamification.badges', compact('badges', 'allBadges'));
    }

    /**
     * Show leaderboard
     */
    public function leaderboard(Request $request): View
    {
        $type = $request->get('type', 'all_time');
        $leaderboard = $this->gamificationService->getLeaderboard($type, 50);
        $userRanking = $this->gamificationService->getUserRanking(auth()->user());

        return view('gamification.leaderboard', compact('leaderboard', 'userRanking', 'type'));
    }

    /**
     * Show point history page
     */
    public function pointHistory()
    {
        $user = Auth::user();
        $activities = $this->gamificationService->getUserPointHistory($user);
        $pointActivities = $this->gamificationService->getAllPointActivities();
        
        // Calculate detailed summary
        $summary = $this->calculatePointHistorySummary($activities);
        
        return view('gamification.point-history', compact('activities', 'pointActivities', 'summary'));
    }

    /**
     * Calculate detailed summary for point history
     */
    private function calculatePointHistorySummary($activities)
    {
        $summary = [
            'total_points' => $activities->sum('points_earned'),
            'total_experience' => $activities->sum(function($activity) {
                return $activity->metadata['experience_earned'] ?? 0;
            }),
            'activities_count' => $activities->count(),
            'average_points' => $activities->count() > 0 ? $activities->sum('points_earned') / $activities->count() : 0,
            'quiz_activities' => 0,
            'perfect_scores' => 0,
            'high_scores' => 0,
            'material_activities' => 0,
            'video_activities' => 0,
            'document_activities' => 0,
            'login_activities' => 0,
            'forum_activities' => 0,
            'comment_activities' => 0,
        ];

        foreach ($activities as $activity) {
            $activityName = $activity->pointActivity->name ?? '';
            $metadata = $activity->metadata ?? [];

            // Quiz activities
            if (str_contains($activityName, 'quiz')) {
                $summary['quiz_activities']++;
                if (isset($metadata['score']) && $metadata['score'] == 100) {
                    $summary['perfect_scores']++;
                } elseif (isset($metadata['score']) && $metadata['score'] >= 80) {
                    $summary['high_scores']++;
                }
            }

            // Material activities
            if (str_contains($activityName, 'materi')) {
                $summary['material_activities']++;
                if (isset($metadata['material_type'])) {
                    if ($metadata['material_type'] === 'video') {
                        $summary['video_activities']++;
                    } elseif (in_array($metadata['material_type'], ['document', 'pdf', 'docx'])) {
                        $summary['document_activities']++;
                    }
                }
            }

            // Engagement activities
            if (str_contains($activityName, 'login')) {
                $summary['login_activities']++;
            } elseif (str_contains($activityName, 'forum')) {
                $summary['forum_activities']++;
            } elseif (str_contains($activityName, 'comment')) {
                $summary['comment_activities']++;
            }
        }

        return $summary;
    }

    /**
     * Get user stats via AJAX
     */
    public function getUserStats(): JsonResponse
    {
        $user = auth()->user();
        $stats = $this->gamificationService->getUserStats($user);

        return response()->json($stats);
    }

    /**
     * Award points via AJAX
     */
    public function awardPoints(Request $request): JsonResponse
    {
        $request->validate([
            'activity' => 'required|string',
            'description' => 'nullable|string',
            'metadata' => 'nullable|array',
        ]);

        try {
            $user = auth()->user();
            $history = $this->gamificationService->awardPoints(
                $user,
                $request->activity,
                $request->description,
                $request->metadata ?? []
            );

            $stats = $this->gamificationService->getUserStats($user);

            return response()->json([
                'success' => true,
                'message' => 'Poin berhasil ditambahkan!',
                'history' => $history,
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan poin: ' . $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Award quiz points
     */
    public function awardQuizPoints(Request $request): JsonResponse
    {
        $request->validate([
            'is_perfect_score' => 'boolean',
            'is_first_attempt' => 'boolean',
        ]);

        try {
            $user = auth()->user();
            $activities = $this->gamificationService->awardQuizPoints(
                $user,
                $request->boolean('is_perfect_score'),
                $request->boolean('is_first_attempt')
            );

            $stats = $this->gamificationService->getUserStats($user);

            return response()->json([
                'success' => true,
                'message' => 'Poin kuis berhasil ditambahkan!',
                'activities' => $activities,
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan poin kuis: ' . $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Award daily login points
     */
    public function awardDailyLoginPoints(): JsonResponse
    {
        try {
            $user = auth()->user();
            $history = $this->gamificationService->awardDailyLoginPoints($user);

            $stats = $this->gamificationService->getUserStats($user);

            return response()->json([
                'success' => true,
                'message' => 'Poin login harian berhasil ditambahkan!',
                'history' => $history,
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan poin login: ' . $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Check and award badges
     */
    public function checkBadges(): JsonResponse
    {
        try {
            $user = auth()->user();
            $awardedBadges = $this->gamificationService->checkAndAwardBadges($user);

            $stats = $this->gamificationService->getUserStats($user);

            return response()->json([
                'success' => true,
                'message' => count($awardedBadges) > 0 ? 'Selamat! Anda mendapatkan lencana baru!' : 'Belum ada lencana baru.',
                'awarded_badges' => $awardedBadges,
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memeriksa lencana: ' . $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Get leaderboard data via AJAX
     */
    public function getLeaderboardData(Request $request): JsonResponse
    {
        $type = $request->get('type', 'all_time');
        $limit = $request->get('limit', 10);
        
        $leaderboard = $this->gamificationService->getLeaderboard($type, $limit);
        $userRanking = $this->gamificationService->getUserRanking(auth()->user());

        return response()->json([
            'leaderboard' => $leaderboard,
            'user_ranking' => $userRanking,
        ]);
    }

    /**
     * Get point activities
     */
    public function getPointActivities(Request $request): JsonResponse
    {
        $category = $request->get('category');
        
        if ($category) {
            $activities = $this->gamificationService->getPointActivitiesByCategory($category);
        } else {
            $activities = $this->gamificationService->getAllPointActivities();
        }

        return response()->json($activities);
    }
}

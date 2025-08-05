<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;
use App\Models\UserBadge;
use Illuminate\Support\Facades\Log;

class BossQuizBadgeService
{
    /**
     * Check and award Boss Quiz badges to user
     */
    public function checkAndAwardBadges(User $user): array
    {
        $awardedBadges = [];
        
        // Get all Boss Quiz badges
        $bossQuizBadges = Badge::where('category', 'boss_quiz')
            ->where('is_active', true)
            ->get();
        
        foreach ($bossQuizBadges as $badge) {
            // Check if user already has this badge
            if ($badge->isEarnedByUser($user)) {
                continue;
            }
            
            // Check if user meets the criteria
            if ($badge->checkCriteria($user)) {
                try {
                    // Award the badge
                    $userBadge = UserBadge::create([
                        'user_id' => $user->id,
                        'badge_id' => $badge->id,
                        'earned_at' => now(),
                    ]);
                    
                    $awardedBadges[] = [
                        'badge' => $badge,
                        'user_badge' => $userBadge,
                        'message' => "Selamat! Anda mendapatkan badge '{$badge->name}' 🎉"
                    ];
                    
                    Log::info("Badge awarded: User {$user->id} earned badge {$badge->name}");
                    
                } catch (\Exception $e) {
                    Log::error("Failed to award badge: " . $e->getMessage());
                }
            }
        }
        
        return $awardedBadges;
    }
    
    /**
     * Get user's Boss Quiz statistics
     */
    public function getUserBossQuizStats(User $user): array
    {
        $bossQuizResults = $user->quizResults()
            ->whereHas('quiz', function($query) {
                $query->where('type', 'boss');
            })
            ->get();
        
        $totalBossQuizzes = $bossQuizResults->count();
        $perfectScores = $bossQuizResults->where('score', '>', 90)->count();
        $passedQuizzes = $bossQuizResults->where('passed', true)->count();
        
        // Get earned Boss Quiz badges
        $earnedBadges = $user->userBadges()
            ->whereHas('badge', function($query) {
                $query->where('category', 'boss_quiz');
            })
            ->with('badge')
            ->get();
        
        return [
            'total_boss_quizzes' => $totalBossQuizzes,
            'perfect_scores' => $perfectScores,
            'passed_quizzes' => $passedQuizzes,
            'earned_badges' => $earnedBadges,
            'average_score' => $totalBossQuizzes > 0 ? round($bossQuizResults->avg('score'), 1) : 0,
        ];
    }
    
    /**
     * Get available Boss Quiz badges for user
     */
    public function getAvailableBossQuizBadges(User $user): array
    {
        $allBossBadges = Badge::where('category', 'boss_quiz')
            ->where('is_active', true)
            ->get();
        
        $availableBadges = [];
        $earnedBadges = $user->userBadges()
            ->whereHas('badge', function($query) {
                $query->where('category', 'boss_quiz');
            })
            ->pluck('badge_id')
            ->toArray();
        
        foreach ($allBossBadges as $badge) {
            $isEarned = in_array($badge->id, $earnedBadges);
            $progress = $this->getBadgeProgress($user, $badge);
            
            $availableBadges[] = [
                'badge' => $badge,
                'is_earned' => $isEarned,
                'progress' => $progress,
            ];
        }
        
        return $availableBadges;
    }
    
    /**
     * Get progress towards a specific badge
     */
    private function getBadgeProgress(User $user, Badge $badge): array
    {
        $criteria = $badge->criteria[0] ?? null;
        if (!$criteria) {
            return ['current' => 0, 'required' => 0, 'percentage' => 0];
        }
        
        $current = 0;
        switch ($criteria['type']) {
            case 'boss_quiz_perfect':
                $current = $user->quizResults()
                    ->whereHas('quiz', function($query) {
                        $query->where('type', 'boss');
                    })
                    ->where('score', '>', 90)
                    ->count();
                break;
        }
        
        $required = $criteria['value'] ?? 0;
        $percentage = $required > 0 ? min(100, ($current / $required) * 100) : 0;
        
        return [
            'current' => $current,
            'required' => $required,
            'percentage' => round($percentage, 1)
        ];
    }
} 
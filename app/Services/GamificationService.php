<?php

namespace App\Services;

use App\Models\User;
use App\Models\PointActivity;
use App\Models\PointHistory;
use App\Models\Badge;
use App\Models\UserBadge;
use App\Models\Leaderboard;
use App\Models\LeaderboardEntry;
use App\Models\DailyChallenge;
use App\Models\UserChallenge;
use Illuminate\Support\Facades\DB;

class GamificationService
{
    /**
     * Award points to user for specific activity
     */
    public function awardPoints(User $user, string $activityName, string $description = null, array $metadata = []): ?PointHistory
    {
        try {
            DB::beginTransaction();
            
            $history = $user->addPoints(0, $activityName, $description, $metadata);
            
            // Check for badges after awarding points
            $awardedBadges = $user->checkAndAwardBadges();
            
            DB::commit();
            
            return $history;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Award points for quiz completion
     */
    public function awardQuizPoints(User $user, bool $isPerfectScore = false, bool $isFirstAttempt = false): array
    {
        $activities = ['quiz_completed'];
        $awardedActivities = [];

        if ($isPerfectScore) {
            $activities[] = 'quiz_perfect_score';
        }

        if ($isFirstAttempt) {
            $activities[] = 'quiz_first_attempt';
        }

        foreach ($activities as $activity) {
            $history = $this->awardPoints($user, $activity);
            if ($history) {
                $awardedActivities[] = $history;
            }
        }

        return $awardedActivities;
    }

    /**
     * Award points and experience based on quiz score with standard criteria
     */
    public function awardQuizPointsByScore(User $user, int $score, string $quizType = 'regular'): array
    {
        $awardedActivities = [];
        $userPoint = $user->getOrCreateUserPoint();
        
        // Base points and experience based on score
        $basePoints = $this->calculatePointsByScore($score, $quizType);
        $baseExperience = $this->calculateExperienceByScore($score, $quizType);
        
        // Award base points and experience
        $userPoint->addPoints($basePoints);
        $userPoint->addExperience($baseExperience);
        
        // Record the activity
        $activity = PointActivity::getActivityByName('quiz_completed');
        if ($activity) {
            $history = PointHistory::create([
                'user_id' => $user->id,
                'point_activity_id' => $activity->id,
                'points_earned' => $basePoints,
                'description' => "Menyelesaikan kuis dengan skor {$score}",
                'metadata' => [
                    'score' => $score,
                    'quiz_type' => $quizType,
                    'experience_earned' => $baseExperience,
                    'level_before' => $userPoint->level,
                    'level_after' => $userPoint->level
                ]
            ]);
            $awardedActivities[] = $history;
        }
        
        // Bonus for perfect score
        if ($score == 100) {
            $bonusPoints = $this->getBonusPoints('perfect_score', $quizType);
            $bonusExperience = $this->getBonusExperience('perfect_score', $quizType);
            
            $userPoint->addPoints($bonusPoints);
            $userPoint->addExperience($bonusExperience);
            
            $perfectActivity = PointActivity::getActivityByName('quiz_perfect_score');
            if ($perfectActivity) {
                $history = PointHistory::create([
                    'user_id' => $user->id,
                    'point_activity_id' => $perfectActivity->id,
                    'points_earned' => $bonusPoints,
                    'description' => "Skor sempurna! Bonus poin dan experience",
                    'metadata' => [
                        'bonus_experience' => $bonusExperience,
                        'quiz_type' => $quizType
                    ]
                ]);
                $awardedActivities[] = $history;
            }
        }
        
        // Bonus for high scores (80-99)
        if ($score >= 80 && $score < 100) {
            $bonusPoints = $this->getBonusPoints('high_score', $quizType);
            $bonusExperience = $this->getBonusExperience('high_score', $quizType);
            
            $userPoint->addPoints($bonusPoints);
            $userPoint->addExperience($bonusExperience);
            
            $history = PointHistory::create([
                'user_id' => $user->id,
                'point_activity_id' => $activity->id,
                'points_earned' => $bonusPoints,
                'description' => "Skor tinggi! Bonus poin dan experience",
                'metadata' => [
                    'bonus_experience' => $bonusExperience,
                    'quiz_type' => $quizType,
                    'score_range' => '80-99'
                ]
            ]);
            $awardedActivities[] = $history;
        }
        
        // Check for level up
        $levelUp = $userPoint->checkLevelUp();
        if ($levelUp) {
            $levelUpPoints = $this->getBonusPoints('level_up', $quizType);
            $levelUpExperience = $this->getBonusExperience('level_up', $quizType);
            
            $userPoint->addPoints($levelUpPoints);
            $userPoint->addExperience($levelUpExperience);
            
            $levelUpActivity = PointActivity::getActivityByName('level_up');
            if ($levelUpActivity) {
                $history = PointHistory::create([
                    'user_id' => $user->id,
                    'point_activity_id' => $levelUpActivity->id,
                    'points_earned' => $levelUpPoints,
                    'description' => "Selamat! Naik ke Level {$userPoint->level}",
                    'metadata' => [
                        'new_level' => $userPoint->level,
                        'level_up_experience' => $levelUpExperience,
                        'quiz_type' => $quizType
                    ]
                ]);
                $awardedActivities[] = $history;
            }
        }
        
        return $awardedActivities;
    }

    /**
     * Calculate points based on quiz score with standard criteria
     */
    private function calculatePointsByScore(int $score, string $quizType): int
    {
        $basePoints = match($quizType) {
            'boss' => 150,
            'teka-teki' => 80,
            'daily' => 60,
            default => 50
        };
        
        // Score multiplier
        $multiplier = match(true) {
            $score >= 100 => 2.0, // Perfect score
            $score >= 90 => 1.5,  // Excellent
            $score >= 80 => 1.2,  // Good
            $score >= 70 => 1.0,  // Average
            $score >= 60 => 0.8,  // Below average
            default => 0.5         // Failed
        };
        
        return (int) ($basePoints * $multiplier);
    }

    /**
     * Calculate experience based on quiz score with standard criteria
     */
    private function calculateExperienceByScore(int $score, string $quizType): int
    {
        $baseExperience = match($quizType) {
            'boss' => 200,
            'teka-teki' => 120,
            'daily' => 80,
            default => 100
        };
        
        // Score multiplier for experience
        $multiplier = match(true) {
            $score >= 100 => 3.0, // Perfect score
            $score >= 90 => 2.0,  // Excellent
            $score >= 80 => 1.5,  // Good
            $score >= 70 => 1.0,  // Average
            $score >= 60 => 0.8,  // Below average
            default => 0.3         // Failed
        };
        
        return (int) ($baseExperience * $multiplier);
    }

    /**
     * Get bonus points for special achievements
     */
    private function getBonusPoints(string $achievement, string $quizType): int
    {
        return match($achievement) {
            'perfect_score' => match($quizType) {
                'boss' => 300,
                'teka-teki' => 200,
                'daily' => 150,
                default => 100
            },
            'high_score' => match($quizType) {
                'boss' => 100,
                'teka-teki' => 80,
                'daily' => 60,
                default => 50
            },
            'level_up' => 200,
            default => 0
        };
    }

    /**
     * Get bonus experience for special achievements
     */
    private function getBonusExperience(string $achievement, string $quizType): int
    {
        return match($achievement) {
            'perfect_score' => match($quizType) {
                'boss' => 400,
                'teka-teki' => 300,
                'daily' => 200,
                default => 150
            },
            'high_score' => match($quizType) {
                'boss' => 150,
                'teka-teki' => 120,
                'daily' => 100,
                default => 80
            },
            'level_up' => 300,
            default => 0
        };
    }

    /**
     * Award points for daily login
     */
    public function awardDailyLoginPoints(User $user): ?PointHistory
    {
        return $this->awardPoints($user, 'daily_login', 'Login harian');
    }

    /**
     * Award points for material completion with standard criteria
     */
    public function awardMaterialPoints(User $user, string $materialType = 'regular'): ?PointHistory
    {
        $userPoint = $user->getOrCreateUserPoint();
        
        // Base points and experience for material completion
        $basePoints = match($materialType) {
            'video' => 20,
            'document' => 30,
            'interactive' => 40,
            default => 25
        };
        
        $baseExperience = match($materialType) {
            'video' => 30,
            'document' => 40,
            'interactive' => 60,
            default => 35
        };
        
        // Award points and experience
        $userPoint->addPoints($basePoints);
        $userPoint->addExperience($baseExperience);
        
        // Check for level up
        $levelUp = $userPoint->checkLevelUp();
        if ($levelUp) {
            $levelUpPoints = 100;
            $levelUpExperience = 150;
            
            $userPoint->addPoints($levelUpPoints);
            $userPoint->addExperience($levelUpExperience);
        }
        
        // Record the activity
        $activity = PointActivity::getActivityByName('materi_completed');
        if ($activity) {
            return PointHistory::create([
                'user_id' => $user->id,
                'point_activity_id' => $activity->id,
                'points_earned' => $basePoints,
                'description' => "Menyelesaikan materi {$materialType}",
                'metadata' => [
                    'material_type' => $materialType,
                    'experience_earned' => $baseExperience,
                    'level_up' => $levelUp,
                    'level_up_points' => $levelUp ? $levelUpPoints : 0,
                    'level_up_experience' => $levelUp ? $levelUpExperience : 0
                ]
            ]);
        }
        
        return null;
    }

    /**
     * Get detailed quiz reward information
     */
    public function getQuizRewardInfo(int $score, string $quizType = 'regular'): array
    {
        $basePoints = $this->calculatePointsByScore($score, $quizType);
        $baseExperience = $this->calculateExperienceByScore($score, $quizType);
        
        $bonusPoints = 0;
        $bonusExperience = 0;
        
        if ($score == 100) {
            $bonusPoints = $this->getBonusPoints('perfect_score', $quizType);
            $bonusExperience = $this->getBonusExperience('perfect_score', $quizType);
        } elseif ($score >= 80 && $score < 100) {
            $bonusPoints = $this->getBonusPoints('high_score', $quizType);
            $bonusExperience = $this->getBonusExperience('high_score', $quizType);
        }
        
        return [
            'score' => $score,
            'quiz_type' => $quizType,
            'base_points' => $basePoints,
            'base_experience' => $baseExperience,
            'bonus_points' => $bonusPoints,
            'bonus_experience' => $bonusExperience,
            'total_points' => $basePoints + $bonusPoints,
            'total_experience' => $baseExperience + $bonusExperience,
            'achievement' => $this->getAchievementByScore($score)
        ];
    }

    /**
     * Get achievement description based on score
     */
    private function getAchievementByScore(int $score): string
    {
        return match(true) {
            $score == 100 => 'Skor Sempurna! 🏆',
            $score >= 90 => 'Excellent! 🌟',
            $score >= 80 => 'Good Job! 👍',
            $score >= 70 => 'Nice Try! 😊',
            $score >= 60 => 'Keep Learning! 📚',
            default => 'Try Again! 💪'
        };
    }

    /**
     * Award points for video watching
     */
    public function awardVideoPoints(User $user): ?PointHistory
    {
        return $this->awardPoints($user, 'video_watched', 'Menonton video pembelajaran');
    }

    /**
     * Award points for forum participation
     */
    public function awardForumPoints(User $user): ?PointHistory
    {
        return $this->awardPoints($user, 'forum_participation', 'Berpartisipasi dalam forum diskusi');
    }

    /**
     * Award points for commenting
     */
    public function awardCommentPoints(User $user): ?PointHistory
    {
        return $this->awardPoints($user, 'comment_posted', 'Memberikan komentar');
    }

    /**
     * Get user's gamification stats
     */
    public function getUserStats(User $user): array
    {
        $userPoint = $user->getOrCreateUserPoint();
        
        return [
            'points' => $userPoint->points,
            'level' => $userPoint->level,
            'experience' => $userPoint->experience,
            'experience_to_next_level' => $userPoint->experience_to_next_level,
            'progress_to_next_level' => $userPoint->getProgressToNextLevel(),
            'level_title' => $userPoint->getLevelTitle(),
            'badges_earned' => $user->getEarnedBadges()->count(),
            'total_badges' => Badge::active()->count(),
            'recent_activities' => $user->pointHistories()
                ->with('pointActivity')
                ->latest()
                ->take(5)
                ->get(),
        ];
    }

    /**
     * Get leaderboard for specific type
     */
    public function getLeaderboard(string $type = 'all_time', int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return User::with('userPoint')
            ->whereHas('userPoint')
            ->get()
            ->sortByDesc(function ($user) {
                return $user->userPoint->points;
            })
            ->take($limit)
            ->values();
    }

    /**
     * Get user's ranking
     */
    public function getUserRanking(User $user): int
    {
        $users = User::with('userPoint')
            ->whereHas('userPoint')
            ->get()
            ->sortByDesc(function ($user) {
                return $user->userPoint->points;
            })
            ->values();

        $rank = $users->search(function ($item) use ($user) {
            return $item->id === $user->id;
        });

        return $rank !== false ? $rank + 1 : 0;
    }

    /**
     * Get available badges for user
     */
    public function getAvailableBadges(User $user): array
    {
        $availableBadges = $user->getAvailableBadges();
        $earnedBadges = $user->getEarnedBadges();

        return [
            'available' => $availableBadges,
            'earned' => $earnedBadges,
            'total_available' => $availableBadges->count(),
            'total_earned' => $earnedBadges->count(),
        ];
    }

    /**
     * Check and award badges for user
     */
    public function checkAndAwardBadges(User $user): array
    {
        return $user->checkAndAwardBadges();
    }

    /**
     * Get user's point history
     */
    public function getUserPointHistory(User $user, int $limit = 20): \Illuminate\Database\Eloquent\Collection
    {
        return $user->pointHistories()
            ->with('pointActivity')
            ->latest()
            ->take($limit)
            ->get();
    }

    /**
     * Get point activities by category
     */
    public function getPointActivitiesByCategory(string $category): \Illuminate\Database\Eloquent\Collection
    {
        return PointActivity::getActivitiesByCategory($category);
    }

    /**
     * Get all point activities
     */
    public function getAllPointActivities(): \Illuminate\Database\Eloquent\Collection
    {
        return PointActivity::active()->get();
    }

    /**
     * Get user's recent achievements
     */
    public function getRecentAchievements(User $user, int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return $user->userBadges()
            ->with('badge')
            ->latest('earned_at')
            ->take($limit)
            ->get();
    }
} 
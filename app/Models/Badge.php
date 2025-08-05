<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'category',
        'criteria',
        'is_active',
    ];

    protected $casts = [
        'criteria' => 'array',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function userBadges()
    {
        return $this->hasMany(UserBadge::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Methods
    public function isEarnedByUser(User $user): bool
    {
        return $this->userBadges()->where('user_id', $user->id)->exists();
    }

    public function checkCriteria(User $user): bool
    {
        if (!$this->is_active) {
            return false;
        }

        foreach ($this->criteria as $criterion) {
            if (!$this->evaluateCriterion($user, $criterion)) {
                return false;
            }
        }

        return true;
    }

    private function evaluateCriterion(User $user, array $criterion): bool
    {
        $type = $criterion['type'] ?? '';
        $value = $criterion['value'] ?? 0;
        $operator = $criterion['operator'] ?? '>=';

        switch ($type) {
            case 'quiz_completed':
                $count = $user->quizResults()->where('passed', true)->count();
                break;
            case 'quiz_perfect_score':
                $count = $user->quizResults()->where('score', 100)->count();
                break;
            case 'boss_quiz_perfect':
                $count = $user->quizResults()
                    ->whereHas('quiz', function($query) {
                        $query->where('type', 'boss');
                    })
                    ->where('score', '>', 90)
                    ->count();
                break;
            case 'login_streak':
                $count = $this->calculateLoginStreak($user);
                break;
            case 'total_points':
                $count = $user->userPoint?->points ?? 0;
                break;
            case 'level_reached':
                $count = $user->userPoint?->level ?? 0;
                break;
            case 'materi_completed':
                $count = $user->completedMateri()->count();
                break;
            default:
                return false;
        }

        return $this->compareValues($count, $operator, $value);
    }

    private function calculateLoginStreak(User $user): int
    {
        // Implementasi sederhana untuk login streak
        // Dalam implementasi nyata, perlu tracking login harian
        return 0; // Placeholder
    }

    private function compareValues($actual, $operator, $expected): bool
    {
        return match($operator) {
            '>=' => $actual >= $expected,
            '>' => $actual > $expected,
            '<=' => $actual <= $expected,
            '<' => $actual < $expected,
            '==' => $actual == $expected,
            '!=' => $actual != $expected,
            default => false,
        };
    }

    public function awardToUser(User $user): ?UserBadge
    {
        if ($this->isEarnedByUser($user)) {
            return null; // Already earned
        }

        if (!$this->checkCriteria($user)) {
            return null; // Criteria not met
        }

        return UserBadge::create([
            'user_id' => $user->id,
            'badge_id' => $this->id,
            'earned_at' => now(),
        ]);
    }
}

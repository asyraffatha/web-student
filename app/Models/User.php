<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'foto',
        'role',
        'kelas_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // ===== ROLE METHODS ===== //
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }

    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    // ===== ACCESSORS ===== //
    public function getRoleDisplayAttribute(): string
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'guru' => 'Guru',
            'siswa' => 'Siswa',
            default => 'Unknown'
        };
    }

    // ===== SCOPES ===== //
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // ===== RELATIONSHIPS ===== //
    public function quizResults()
    {
        return $this->hasMany(QuizResult::class);
    }

    public function kelasDiampu()
    {
        return $this->belongsToMany(Kelas::class, 'guru_kelas', 'user_id', 'kelas_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function setting()
    {
        return $this->hasOne(\App\Models\Setting::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // ===== GAMIFICATION RELATIONSHIPS ===== //
    public function userPoint()
    {
        return $this->hasOne(UserPoint::class);
    }

    public function pointHistories()
    {
        return $this->hasMany(PointHistory::class);
    }

    public function userBadges()
    {
        return $this->hasMany(UserBadge::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges');
    }

    public function leaderboardEntries()
    {
        return $this->hasMany(LeaderboardEntry::class);
    }

    public function userChallenges()
    {
        return $this->hasMany(UserChallenge::class);
    }

    // ===== GAMIFICATION METHODS ===== //
    public function getOrCreateUserPoint(): UserPoint
    {
        return $this->userPoint ?? UserPoint::create(['user_id' => $this->id]);
    }

    public function addPoints(int $points, string $activityName, string $description = null, array $metadata = []): PointHistory
    {
        $activity = PointActivity::getActivityByName($activityName);
        
        if (!$activity) {
            throw new \Exception("Activity '{$activityName}' not found");
        }

        return PointHistory::recordPoints($this, $activity, $description, $metadata);
    }

    public function checkAndAwardBadges(): array
    {
        $awardedBadges = [];
        $badges = Badge::active()->get();

        foreach ($badges as $badge) {
            if (!$badge->isEarnedByUser($this) && $badge->checkCriteria($this)) {
                $userBadge = $badge->awardToUser($this);
                if ($userBadge) {
                    $awardedBadges[] = $badge;
                }
            }
        }

        return $awardedBadges;
    }

    public function getEarnedBadges(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->badges()->active()->get();
    }

    public function getAvailableBadges(): \Illuminate\Database\Eloquent\Collection
    {
        return Badge::active()->whereDoesntHave('userBadges', function ($query) {
            $query->where('user_id', $this->id);
        })->get();
    }

    public function getTotalPoints(): int
    {
        return $this->userPoint?->points ?? 0;
    }

    public function getLevel(): int
    {
        return $this->userPoint?->level ?? 1;
    }

    public function getLevelTitle(): string
    {
        return $this->userPoint?->getLevelTitle() ?? 'Pemula';
    }

    public function getProgressToNextLevel(): float
    {
        return $this->userPoint?->getProgressToNextLevel() ?? 0;
    }

    // ===== CUSTOM METHODS ===== //
    public function gurus()
    {
        return $this->kelas?->guru ?? collect();
    }
}
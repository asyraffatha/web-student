<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points',
        'level',
        'experience',
        'experience_to_next_level',
    ];

    protected $casts = [
        'points' => 'integer',
        'level' => 'integer',
        'experience' => 'integer',
        'experience_to_next_level' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods
    public function addPoints(int $points): void
    {
        $this->increment('points', $points);
        $this->addExperience($points);
        $this->checkLevelUp();
    }

    public function addExperience(int $experience): void
    {
        $this->increment('experience', $experience);
        $this->checkLevelUp();
    }

    public function checkLevelUp(): bool
    {
        if ($this->experience >= $this->experience_to_next_level) {
            $this->level++;
            $this->experience -= $this->experience_to_next_level;
            $this->experience_to_next_level = $this->calculateNextLevelExperience();
            $this->save();
            return true;
        }
        return false;
    }

    public function calculateNextLevelExperience(): int
    {
        // Formula: base * (level ^ 1.5)
        return (int) (100 * pow($this->level + 1, 1.5));
    }

    public function getProgressToNextLevel(): float
    {
        return ($this->experience / $this->experience_to_next_level) * 100;
    }

    public function getLevelTitle(): string
    {
        $titles = [
            1 => 'Pemula',
            5 => 'Pembelajar',
            10 => 'Pencari Ilmu',
            15 => 'Ahli Matematika',
            20 => 'Master Matematika',
            25 => 'Legenda Matematika',
            30 => 'Matematikawan Sejati',
        ];

        foreach (array_reverse($titles) as $level => $title) {
            if ($this->level >= $level) {
                return $title;
            }
        }

        return 'Pemula';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'point_activity_id',
        'points_earned',
        'description',
        'metadata',
    ];

    protected $casts = [
        'points_earned' => 'integer',
        'metadata' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pointActivity()
    {
        return $this->belongsTo(PointActivity::class);
    }

    // Scopes
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByActivity($query, $activityId)
    {
        return $query->where('point_activity_id', $activityId);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->whereHas('pointActivity', function ($q) use ($category) {
            $q->where('category', $category);
        });
    }

    // Methods
    public static function recordPoints(User $user, PointActivity $activity, string $description = null, array $metadata = []): self
    {
        $history = self::create([
            'user_id' => $user->id,
            'point_activity_id' => $activity->id,
            'points_earned' => $activity->points,
            'description' => $description ?? $activity->description,
            'metadata' => $metadata,
        ]);

        // Update user points
        $userPoint = $user->userPoint ?? UserPoint::create(['user_id' => $user->id]);
        $userPoint->addPoints($activity->points);

        return $history;
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('d M Y H:i');
    }
}

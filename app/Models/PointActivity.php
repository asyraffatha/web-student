<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'points',
        'category',
        'is_active',
    ];

    protected $casts = [
        'points' => 'integer',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function pointHistories()
    {
        return $this->hasMany(PointHistory::class);
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
    public static function getActivityByName(string $name): ?self
    {
        return self::where('name', $name)->active()->first();
    }

    public static function getActivitiesByCategory(string $category): \Illuminate\Database\Eloquent\Collection
    {
        return self::byCategory($category)->active()->get();
    }
}

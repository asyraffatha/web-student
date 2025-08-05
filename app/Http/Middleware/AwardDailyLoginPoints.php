<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\GamificationService;
use Illuminate\Support\Facades\Cache;

class AwardDailyLoginPoints
{
    protected $gamificationService;

    public function __construct(GamificationService $gamificationService)
    {
        $this->gamificationService = $gamificationService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only award points for authenticated students
        if (auth()->check() && auth()->user()->isSiswa()) {
            $user = auth()->user();
            $today = now()->format('Y-m-d');
            $cacheKey = "daily_login_{$user->id}_{$today}";

            // Check if user hasn't received points for today
            if (!Cache::has($cacheKey)) {
                try {
                    // Award daily login points
                    $this->gamificationService->awardDailyLoginPoints($user);
                    
                    // Cache to prevent multiple awards on the same day
                    Cache::put($cacheKey, true, now()->endOfDay());
                    
                    // Check for badges
                    $awardedBadges = $this->gamificationService->checkAndAwardBadges($user);
                    
                    if (count($awardedBadges) > 0) {
                        session()->flash('new_badges', $awardedBadges);
                    }
                    
                } catch (\Exception $e) {
                    // Log error but don't break the request
                    \Log::error('Error awarding daily login points: ' . $e->getMessage());
                }
            }
        }

        return $response;
    }
}

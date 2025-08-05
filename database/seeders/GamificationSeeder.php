<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PointActivity;
use App\Models\Badge;

class GamificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPointActivities();
        $this->seedBadges();
    }

    private function seedPointActivities(): void
    {
        $activities = [
            // Quiz Activities
            [
                'name' => 'quiz_completed',
                'description' => 'Menyelesaikan kuis',
                'points' => 50,
                'category' => 'quiz',
            ],
            [
                'name' => 'quiz_perfect_score',
                'description' => 'Mendapatkan skor sempurna dalam kuis',
                'points' => 100,
                'category' => 'quiz',
            ],
            [
                'name' => 'quiz_first_attempt',
                'description' => 'Lulus kuis pada percobaan pertama',
                'points' => 75,
                'category' => 'quiz',
            ],
            [
                'name' => 'boss_quiz_completed',
                'description' => 'Menyelesaikan Boss Quiz',
                'points' => 150,
                'category' => 'quiz',
            ],
            [
                'name' => 'teka_teki_completed',
                'description' => 'Menyelesaikan Teka-teki',
                'points' => 80,
                'category' => 'quiz',
            ],
            [
                'name' => 'daily_quiz_completed',
                'description' => 'Menyelesaikan Daily Quiz',
                'points' => 60,
                'category' => 'quiz',
            ],
            
            // Learning Activities
            [
                'name' => 'materi_completed',
                'description' => 'Menyelesaikan materi pembelajaran',
                'points' => 30,
                'category' => 'learning',
            ],
            [
                'name' => 'video_watched',
                'description' => 'Menonton video pembelajaran',
                'points' => 20,
                'category' => 'learning',
            ],
            [
                'name' => 'materi_reviewed',
                'description' => 'Mengulang materi sebelumnya',
                'points' => 15,
                'category' => 'learning',
            ],
            
            // Engagement Activities
            [
                'name' => 'daily_login',
                'description' => 'Login harian',
                'points' => 10,
                'category' => 'engagement',
            ],
            [
                'name' => 'weekly_login_streak',
                'description' => 'Login 7 hari berturut-turut',
                'points' => 100,
                'category' => 'engagement',
            ],
            [
                'name' => 'forum_participation',
                'description' => 'Berpartisipasi dalam forum diskusi',
                'points' => 25,
                'category' => 'engagement',
            ],
            [
                'name' => 'comment_posted',
                'description' => 'Memberikan komentar',
                'points' => 15,
                'category' => 'engagement',
            ],
            [
                'name' => 'forum_created',
                'description' => 'Membuat forum diskusi baru',
                'points' => 40,
                'category' => 'engagement',
            ],
            
            // Special Activities
            [
                'name' => 'daily_challenge_completed',
                'description' => 'Menyelesaikan tantangan harian',
                'points' => 75,
                'category' => 'special',
            ],
            [
                'name' => 'level_up',
                'description' => 'Naik level',
                'points' => 200,
                'category' => 'special',
            ],
            [
                'name' => 'first_quiz_completed',
                'description' => 'Menyelesaikan kuis pertama',
                'points' => 50,
                'category' => 'special',
            ],
            [
                'name' => 'first_forum_post',
                'description' => 'Membuat post forum pertama',
                'points' => 30,
                'category' => 'special',
            ],
        ];

        foreach ($activities as $activity) {
            PointActivity::updateOrCreate(
                ['name' => $activity['name']],
                $activity
            );
        }
    }

    private function seedBadges(): void
    {
        $badges = [
            // Achievement Badges
            [
                'name' => 'Matematikawan Pemula',
                'description' => 'Menyelesaikan 5 materi awal',
                'icon' => '🎓',
                'category' => 'achievement',
                'criteria' => [
                    ['type' => 'materi_completed', 'operator' => '>=', 'value' => 5]
                ],
            ],
            [
                'name' => 'Juara Kuis',
                'description' => 'Mendapatkan skor sempurna dalam 3 kuis',
                'icon' => '🏆',
                'category' => 'achievement',
                'criteria' => [
                    ['type' => 'quiz_perfect_score', 'operator' => '>=', 'value' => 3]
                ],
            ],
            [
                'name' => 'Konsisten Belajar',
                'description' => 'Login dan belajar selama 7 hari berturut-turut',
                'icon' => '🔥',
                'category' => 'achievement',
                'criteria' => [
                    ['type' => 'login_streak', 'operator' => '>=', 'value' => 7]
                ],
            ],
            [
                'name' => 'Pembelajar Aktif',
                'description' => 'Menyelesaikan 10 kuis',
                'icon' => '⭐',
                'category' => 'achievement',
                'criteria' => [
                    ['type' => 'quiz_completed', 'operator' => '>=', 'value' => 10]
                ],
            ],
            
            // Boss Quiz Badges
            [
                'name' => 'Boss Slayer Pertama',
                'description' => 'Berhasil mengalahkan Boss Quiz pertama dengan nilai >90',
                'icon' => '⚔️',
                'category' => 'boss_quiz',
                'criteria' => [
                    ['type' => 'boss_quiz_perfect', 'operator' => '>=', 'value' => 1]
                ],
            ],
            [
                'name' => 'Boss Hunter',
                'description' => 'Mengalahkan 3 Boss Quiz dengan nilai >90',
                'icon' => '🗡️',
                'category' => 'boss_quiz',
                'criteria' => [
                    ['type' => 'boss_quiz_perfect', 'operator' => '>=', 'value' => 3]
                ],
            ],
            [
                'name' => 'Boss Master',
                'description' => 'Mengalahkan 5 Boss Quiz dengan nilai >90',
                'icon' => '👑',
                'category' => 'boss_quiz',
                'criteria' => [
                    ['type' => 'boss_quiz_perfect', 'operator' => '>=', 'value' => 5]
                ],
            ],
            [
                'name' => 'Boss Legend',
                'description' => 'Mengalahkan 10 Boss Quiz dengan nilai >90',
                'icon' => '🏅',
                'category' => 'boss_quiz',
                'criteria' => [
                    ['type' => 'boss_quiz_perfect', 'operator' => '>=', 'value' => 10]
                ],
            ],
            [
                'name' => 'Boss Destroyer',
                'description' => 'Mengalahkan 15 Boss Quiz dengan nilai >90',
                'icon' => '💎',
                'category' => 'boss_quiz',
                'criteria' => [
                    ['type' => 'boss_quiz_perfect', 'operator' => '>=', 'value' => 15]
                ],
            ],
            [
                'name' => 'Boss God',
                'description' => 'Mengalahkan 20 Boss Quiz dengan nilai >90',
                'icon' => '👑',
                'category' => 'boss_quiz',
                'criteria' => [
                    ['type' => 'boss_quiz_perfect', 'operator' => '>=', 'value' => 20]
                ],
            ],
            
            // Milestone Badges
            [
                'name' => 'Level 5',
                'description' => 'Mencapai level 5',
                'icon' => '🎯',
                'category' => 'milestone',
                'criteria' => [
                    ['type' => 'level_reached', 'operator' => '>=', 'value' => 5]
                ],
            ],
            [
                'name' => 'Level 10',
                'description' => 'Mencapai level 10',
                'icon' => '🎯',
                'category' => 'milestone',
                'criteria' => [
                    ['type' => 'level_reached', 'operator' => '>=', 'value' => 10]
                ],
            ],
            [
                'name' => 'Level 20',
                'description' => 'Mencapai level 20',
                'icon' => '🎯',
                'category' => 'milestone',
                'criteria' => [
                    ['type' => 'level_reached', 'operator' => '>=', 'value' => 20]
                ],
            ],
            
            // Special Badges
            [
                'name' => 'Poin Master',
                'description' => 'Mengumpulkan 1000 poin',
                'icon' => '💎',
                'category' => 'special',
                'criteria' => [
                    ['type' => 'total_points', 'operator' => '>=', 'value' => 1000]
                ],
            ],
            [
                'name' => 'Pembelajar Sejati',
                'description' => 'Menyelesaikan 20 materi dan 15 kuis',
                'icon' => '🌟',
                'category' => 'special',
                'criteria' => [
                    ['type' => 'materi_completed', 'operator' => '>=', 'value' => 20],
                    ['type' => 'quiz_completed', 'operator' => '>=', 'value' => 15]
                ],
            ],
        ];

        foreach ($badges as $badge) {
            Badge::updateOrCreate(
                ['name' => $badge['name']],
                $badge
            );
        }
    }
}

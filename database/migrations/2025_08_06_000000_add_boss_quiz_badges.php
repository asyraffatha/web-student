<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert Boss Quiz badges
        DB::table('badges')->insert([
            [
                'name' => 'Boss Slayer',
                'description' => 'Berhasil mengalahkan Boss Quiz dengan nilai sempurna (>90)',
                'icon' => '👑',
                'category' => 'boss_quiz',
                'criteria' => json_encode([
                    [
                        'type' => 'boss_quiz_perfect',
                        'value' => 1,
                        'operator' => '>='
                    ]
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Boss Master',
                'description' => 'Mengalahkan 3 Boss Quiz dengan nilai sempurna (>90)',
                'icon' => '🏆',
                'category' => 'boss_quiz',
                'criteria' => json_encode([
                    [
                        'type' => 'boss_quiz_perfect',
                        'value' => 3,
                        'operator' => '>='
                    ]
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Boss Legend',
                'description' => 'Mengalahkan 5 Boss Quiz dengan nilai sempurna (>90)',
                'icon' => '⭐',
                'category' => 'boss_quiz',
                'criteria' => json_encode([
                    [
                        'type' => 'boss_quiz_perfect',
                        'value' => 5,
                        'operator' => '>='
                    ]
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Boss Champion',
                'description' => 'Mengalahkan 10 Boss Quiz dengan nilai sempurna (>90)',
                'icon' => '💎',
                'category' => 'boss_quiz',
                'criteria' => json_encode([
                    [
                        'type' => 'boss_quiz_perfect',
                        'value' => 10,
                        'operator' => '>='
                    ]
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Boss God',
                'description' => 'Mengalahkan 20 Boss Quiz dengan nilai sempurna (>90)',
                'icon' => '🔥',
                'category' => 'boss_quiz',
                'criteria' => json_encode([
                    [
                        'type' => 'boss_quiz_perfect',
                        'value' => 20,
                        'operator' => '>='
                    ]
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('badges')->where('category', 'boss_quiz')->delete();
    }
}; 
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Jika kolom belum ada
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['guru', 'siswa'])->after('email');
            } else {
                // Jika kolom sudah ada, update ke enum jika perlu
                $table->enum('role', ['guru', 'siswa'])->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};


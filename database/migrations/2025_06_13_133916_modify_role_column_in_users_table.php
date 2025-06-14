<?php
// database/migrations/xxxx_modify_role_column_in_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ubah kolom role dari string ke enum
            $table->enum('role', ['admin', 'guru', 'siswa'])->default('siswa')->change();
            
            // Tambah kolom is_active
            $table->boolean('is_active')->default(true)->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan ke string
            $table->string('role')->default('siswa')->change();
            
            // Hapus kolom is_active
            $table->dropColumn('is_active');
        });
    }
};
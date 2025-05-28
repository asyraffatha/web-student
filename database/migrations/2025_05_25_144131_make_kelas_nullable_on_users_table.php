<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // butuh paket doctrine/dbal untuk change()
        Schema::table('users', function (Blueprint $table) {
            $table->string('kelas')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('kelas')->nullable(false)->change();
        });
    }
};

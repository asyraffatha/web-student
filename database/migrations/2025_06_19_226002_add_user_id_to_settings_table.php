<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    // Jangan buat kolom lagi karena sudah ada!
    Schema::table('settings', function (Blueprint $table) {
        // Pastikan hanya pasang FOREIGN KEY saja
        $table->unsignedBigInteger('user_id')->nullable();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};

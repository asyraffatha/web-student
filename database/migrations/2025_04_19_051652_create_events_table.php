<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Kolom ID untuk primary key
            $table->string('title'); // Kolom untuk judul acara
            $table->date('start'); // Kolom untuk tanggal mulai acara
            $table->date('end')->nullable(); // Kolom untuk tanggal akhir acara (nullable)
            $table->boolean('allDay')->default(true); // Kolom untuk menandakan apakah acara berlangsung sepanjang hari
            $table->timestamps(); // Kolom untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('events'); // Menghapus tabel jika migrasi dibatalkan
    }
};
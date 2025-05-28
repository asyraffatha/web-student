<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->string('question');
            $table->json('options')->nullable(); // Menggunakan nullable untuk menerima NULL jika tidak ada data
            $table->string('answer');
            $table->timestamps();
        });
    }
    
};

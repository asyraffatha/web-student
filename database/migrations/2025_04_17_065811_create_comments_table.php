<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->text('content');
        $table->unsignedBigInteger('forum_id');
        $table->unsignedBigInteger('user_id'); // ⬅️ inilah yang error karena belum ada
        $table->timestamps();

        // Foreign keys (optional tapi direkomendasikan)
        $table->foreign('forum_id')->references('id')->on('forums')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}  
}

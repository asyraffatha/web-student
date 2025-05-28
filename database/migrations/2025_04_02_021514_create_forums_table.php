<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumsTable extends Migration
{
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description'); // Pastikan ini ada
            $table->text('content');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pastikan ini ada
            $table->timestamps();
        });
    }   

    public function down()
    {
        Schema::table('forums', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}

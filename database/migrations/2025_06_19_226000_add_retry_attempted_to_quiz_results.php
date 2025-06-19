<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('quiz_results', function (Blueprint $table) {
            $table->boolean('retry_attempted')->default(false)->after('passed');
        });
    }

    public function down()
    {
        Schema::table('quiz_results', function (Blueprint $table) {
            $table->dropColumn('retry_attempted');
        });
    }
}; 
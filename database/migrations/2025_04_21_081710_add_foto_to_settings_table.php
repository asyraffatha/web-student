<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('settings', function (Blueprint $table) {
        $table->string('foto')->nullable()->after('jenis_kelamin');
    });
}
};

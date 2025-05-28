<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('nisn')->unique();
        $table->string('kelas');
        $table->date('tgl_lahir');
        $table->text('alamat');
        $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
        $table->timestamps();
    });
}

};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('sekolah');
            $table->string('jurusan');
            $table->string('kelas');
            $table->string('no_hp');
            $table->string('nis')->unique();
            $table->string('password');
            $table->foreignId('level_id')->default(2)->references('id')->on('level');
            $table->boolean('is_siswa')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
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
        Schema::create('absensi_siswa', function (Blueprint $table) {
            $table->id("id_absensi")->autoIncrement();
            $table->foreignId('id_siswa_absensi')->constrained('siswa', 'id_siswa')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('kehadiran', ['hadir', 'izin', 'sakit', 'alpa']);
            $table->date('tanggal');
            $table->time('jam_hadir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_siswa');
    }
};

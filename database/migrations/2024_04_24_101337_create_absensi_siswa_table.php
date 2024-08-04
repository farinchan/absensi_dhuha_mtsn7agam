<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi_siswa', function (Blueprint $table) {
            $table->id("id_absensi")->autoIncrement();
            $table->foreignId('id_siswa_absensi')->constrained('siswa', 'id_siswa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreignId('guru_id')->constrained('guru', 'id_guru')->onUpdate('NO ACTION')->onDelete('NO ACTION');;
            $table->enum('kehadiran', ['hadir', 'terlambat', 'haid']);
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

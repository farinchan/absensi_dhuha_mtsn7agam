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
            $table->id("id_siswa")->autoIncrement();
            $table->string('nisn', 20);
            $table->string('nama_lengkap', 50);
            $table->foreignId('id_kelas_siswa')->constrained( 'kelas', 'id_kelas')->onUpdate('cascade')->onDelete('cascade');;
            $table->string('alamat', 50);
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

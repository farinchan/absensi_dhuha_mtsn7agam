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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id("id_kelas")->autoIncrement();
            $table->string('nama_kelas', 10);
            $table->foreignId('guru_id')->constrained('guru', 'id_guru')->onUpdate('NO ACTION')->onDelete('NO ACTION');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};

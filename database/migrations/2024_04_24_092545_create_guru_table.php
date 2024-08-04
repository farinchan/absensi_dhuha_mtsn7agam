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
        Schema::create('guru', function (Blueprint $table) {
            $table->id("id_guru")->autoIncrement();
            $table->string('nip', 11);
            $table->string('nama_lengkap', 50);
            $table->string('mapel', 50);
            $table->string('no_hp', 15);
            $table->string('username', 50);
            $table->string('password', 255);
            $table->string('token', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};

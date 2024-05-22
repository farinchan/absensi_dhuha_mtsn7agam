<?php

namespace Database\Seeders;

use App\Models\Absensi_siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Guru::factory(20)->create();
        Kelas::factory(10)->create();
        Siswa::factory(60)->create();



        User::factory()->create([
            'name' => 'Fajri Rinaldi Chan',
            'email' => 'fajri@gariskode.com',
        ]);

        User::factory(10)->create();
        // Absensi_siswa::factory(100)->create();
        
    }
}

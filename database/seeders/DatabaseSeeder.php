<?php

namespace Database\Seeders;

use App\Models\Absensi_siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Faker\Factory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create();
        
        // Guru::factory(20)->create();

        // for ($i = 1; $i <= 10; $i++) {
        //     Kelas::factory()->create([
        //         'nama_kelas' => "VII $i",
        //         'guru_id' => $i,
        //     ]);
        // }

        // Siswa::factory(60)->create();
        // User::factory()->create([
        //     'name' => 'Fajri Rinaldi Chan',
        //     'email' => 'fajri@gariskode.com',
        // ]);
        // User::factory(3)->create();
        // Absensi_siswa::factory(100)->create();

        for ($i = 1; $i <= 28; $i++) {
            Absensi_siswa::create([
                'id_siswa_absensi' => rand(1, 60),
                'guru_id' => rand(1, 20),
                'kehadiran' => $faker->randomElement(['hadir', 'haid', 'terlambat']),
                'tanggal' => "2024-01-$i",
                'jam_hadir' => now()->timezone('Asia/Jakarta')->format('H:i:s'),
            ]);
        }
        for ($i = 1; $i <= 28; $i++) {
            Absensi_siswa::create([
                'id_siswa_absensi' => rand(1, 60),
                'guru_id' => rand(1, 20),
                'kehadiran' => $faker->randomElement(['hadir', 'haid', 'terlambat']),
                'tanggal' => "2024-02-$i",
                'jam_hadir' => now()->timezone('Asia/Jakarta')->format('H:i:s'),
            ]);
        }
        for ($i = 1; $i <= 28; $i++) {
            Absensi_siswa::create([
                'id_siswa_absensi' => rand(1, 60),
                'guru_id' => rand(1, 20),
                'kehadiran' => $faker->randomElement(['hadir', 'haid', 'terlambat']),
                'tanggal' => "2024-03-$i",
                'jam_hadir' => now()->timezone('Asia/Jakarta')->format('H:i:s'),
            ]);
        }
        for ($i = 1; $i <= 28; $i++) {
            Absensi_siswa::create([
                'id_siswa_absensi' => rand(1, 60),
                'guru_id' => rand(1, 20),
                'kehadiran' => $faker->randomElement(['hadir', 'haid', 'terlambat']),
                'tanggal' => "2024-04-$i",
                'jam_hadir' => now()->timezone('Asia/Jakarta')->format('H:i:s'),
            ]);
        }
        for ($i = 1; $i <= 28; $i++) {
            Absensi_siswa::create([
                'id_siswa_absensi' => rand(1, 60),
                'guru_id' => rand(1, 20), 
                'kehadiran' => $faker->randomElement(['hadir', 'haid', 'terlambat']),
                'tanggal' => "2024-05-$i",
                'jam_hadir' => now()->timezone('Asia/Jakarta')->format('H:i:s'),
            ]);
        }
        
    }
}

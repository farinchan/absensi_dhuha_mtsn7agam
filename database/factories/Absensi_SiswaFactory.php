<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Absensi_SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_siswa_absensi' => $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11']),
            'kehadiran' => $this->faker->randomElement(['Hadir', 'haid', 'Sakit', 'Alpa']),
            'tanggal' => $this->faker->unique()->date(),
            'jam_hadir' => $this->faker->unique()->time
        ];
    }
}

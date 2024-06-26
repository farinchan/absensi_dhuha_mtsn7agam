<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\siswa>
 */
class siswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nisn' => $this->faker->unique()->randomNumber(8),
            'nama_lengkap' => $this->faker->name,
            'id_kelas_siswa' => $this->faker->randomElement(['6', '2', '3', '4', '5']),
            'alamat' => $this->faker->text(50),
        ];
    }
}

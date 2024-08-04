<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kelas' => $this->faker->randomElement(['XII RPL 1', 'XII RPL 2', 'XII RPL 3', 'XII RPL 4', 'XII RPL 5']),
            'guru_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}

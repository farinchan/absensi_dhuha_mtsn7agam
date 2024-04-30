<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'nip' => $this->faker->unique()->randomNumber(8),
            'nama_lengkap' => $this->faker->name,
            'mapel' => $this->faker->randomElement(['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'IPA', 'IPS']),
            'no_hp' => "08123123123",
            'email' => $this->faker->unique()->safeEmail,
            'username' => $this->faker->unique()->userName,
            'password' => $this->faker->password,
            
        ];
    }
}

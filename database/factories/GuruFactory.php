<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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
            'mapel' => $this->faker->randomElement(['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'IPA', 'IPS', 'PKN', 'PJOK', 'Seni Budaya', 'Prakarya', 'Agama']),
            'no_hp' => $this->faker->e164PhoneNumber,
            'username' => $this->faker->unique()->userName,
            'password' => Hash::make('password'),
            'token' => Str::random($length = 50),
            
        ];
    }
}

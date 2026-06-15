<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $roles = ['student', 'counselor'];

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => fake()->randomElement($roles),
            'nim' => fake()->numerify('##########'),
            'jurusan' => fake()->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Manajemen', 'Psikologi']),
            'fakultas' => fake()->randomElement(['Ilmu Komputer', 'Ekonomi', 'Psikologi']),
            'semester' => fake()->numberBetween(1, 8),
            'phone' => fake()->phoneNumber(),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TodoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'user_id' => User::inRandomOrder()->first()->id,
            'is_complete' => fake()->boolean(), // ✅ kolom ini harus ada
        ];
    }
}

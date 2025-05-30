<?php

namespace Database\Factories;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'category_id' => Category::factory(),
            'is_complete' => $this->faker->boolean(), // true/false (completed/ongoing)
        ];
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Todo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Buat user dummy
        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // default password
        ]);

        // Create categories
        $categoryA = Category::create(['name' => 'Category A']);
        $categoryB = Category::create(['name' => 'Category B']);
        $categoryC = Category::create(['name' => 'Category C']);

        // Create todos
        Todo::create([
            'title' => 'Vestibular qui amet !',
            'category_id' => $categoryA->id,
            'is_complete' => false,
            'user_id' => $user->id,
        ]);

        Todo::create([
            'title' => 'Cumque ad non eum qy',
            'category_id' => $categoryC->id,
            'is_complete' => false,
            'user_id' => $user->id,
        ]);

        Todo::create([
            'title' => 'Qui consectetur repa',
            'category_id' => $categoryB->id,
            'is_complete' => false,
            'user_id' => $user->id,
        ]);

        Todo::create([
            'title' => 'Officiis cum voluptat',
            'category_id' => $categoryA->id,
            'is_complete' => false,
            'user_id' => $user->id,
        ]);
    }
}

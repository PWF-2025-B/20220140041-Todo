<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // <- Tambahkan baris ini
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Todo;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@admin.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'), // Di sinilah Hash dipakai
            'remember_token'    => Str::random(10),
            'is_admin'          => true,
        ]);

        User::factory(100)->create();
        Todo::factory(500)->create();
    }
}


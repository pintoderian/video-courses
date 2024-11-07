<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@dpinto.dev',
            'password' => bcrypt('password123'),
        ]);

        // Asignar el rol de usuario
        $user->assignRole('user');
    }
}

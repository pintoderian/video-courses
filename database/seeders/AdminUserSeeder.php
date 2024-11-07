<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Derian Pinto',
            'email' => 'me@dpinto.dev',
            'password' => bcrypt('password123'),
        ]);

        // Asignar el rol de admin
        $admin->assignRole('admin');
    }
}

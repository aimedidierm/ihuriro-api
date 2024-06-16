<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'role' => UserRole::GOVERNMENT->value,
            'password' => bcrypt('password'),
        ]);
    }
}

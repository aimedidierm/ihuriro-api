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
        $user = \App\Models\User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'role' => UserRole::GOVERNMENT->value,
            'password' => bcrypt('password'),
        ]);

        \App\Models\DashboardSetting::create([
            'option_1' => true,
            'option_2' => true,
            'option_3' => true,
            'option_4' => true,
            'user_id' => $user->id,
        ]);
    }
}

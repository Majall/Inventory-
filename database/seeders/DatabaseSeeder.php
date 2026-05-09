<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name'  => 'Test Admin',
            'email' => 'admin@example.com',
            'type'  => 'admin',
        ]);

        // Regular user
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'user@example.com',
            'type'  => 'user',
        ]);
    }
}

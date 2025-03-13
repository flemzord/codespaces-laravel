<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Welcome;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user if not exists
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Welcome messages
        Welcome::truncate(); // Clear existing welcome messages

        Welcome::create([
            'content' => 'Laravel！',
        ]);

        Welcome::create([
            'content' => 'PHP',
        ]);

        Welcome::create([
            'content' => 'Hello World',
        ]);
    }
}

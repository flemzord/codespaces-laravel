<?php

namespace Database\Seeders;

use App\Models\Welcome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WelcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Welcome::create([
            'content' => 'Cursorへようこそ！',
        ]);

        Welcome::create([
            'content' => '素晴らしい開発体験をお楽しみください！',
        ]);
    }
}

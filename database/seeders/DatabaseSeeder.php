<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '12345678'
        ]);

        //create one hero
        \App\Models\Hero::create([
            'title' => 'We are a digital Agency Serve#online Marketing|Web Design|Brand Identity',
            'subtitle' => 'We would direct you to limitless ideas and move your brand',
            'image' => 'https://via.placeholder.com/640x480.png/00ee11?text=est',
            'is_active' => true,

        ]);

        //call other seeders
        $this->call([
            GuestBookSeeder::class,
            HeroSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}

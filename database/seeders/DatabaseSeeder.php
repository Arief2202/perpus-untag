<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::insert([
            'name' => 'Admin 1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make("password"),
            'role' => 1,
        ]);
        User::insert([
            'name' => 'Super Admin 1',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make("password"),
            'role' => 2,
        ]);
        User::insert([
            'name' => 'Guest',
            'email' => 'guest@gmail.com',
            'password' => Hash::make("password"),
            'role' => 0,
        ]);
        User::insert([
            'name' => 'Arief',
            'email' => 'arief.d2202@gmail.com',
            'password' => Hash::make("password"),
            'role' => 1,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\userRole;
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
            'name' => 'Adam',
            'email' => 'Adam@gmail.com',
            'password' => '123456789',
        ]);

        $this->call([
            RoleSeeder::class,
        ]);
    }
}
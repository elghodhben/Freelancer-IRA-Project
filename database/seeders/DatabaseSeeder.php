<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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


<<<<<<< HEAD
       // $this->call(AdminTableSeeder::class);
        $this->call(UsersTableSeeder::class);
=======
        $this->call(AdminTableSeeder::class);
>>>>>>> 184cb556cfe738b593cd42a5497ceba887630191
    }
}

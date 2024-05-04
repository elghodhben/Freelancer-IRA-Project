<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'role' => 'admin',
            'created_at' => now(),
        ]);

        DB::table('roles')->insert([
            'role' => 'author',
            'created_at' => now(),
        ]);
    }
}

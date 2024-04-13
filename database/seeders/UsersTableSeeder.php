<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $password = Hash::make('123123');
        $user = [
            'name' => 'user',
            'email' => 'user@g.com',
            'password' => $password,
        ];

        \App\Models\User::insert($user);
    }
}

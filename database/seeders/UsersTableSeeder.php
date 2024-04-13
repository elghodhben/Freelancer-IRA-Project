<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'iyed'.Str::random(2).'@gmail.com',
            'password' => Hash::make('123456789'),
            'cin' => mt_rand(10000000, 99999999),
        ]);


    }
}

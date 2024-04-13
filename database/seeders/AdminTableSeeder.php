<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRecords =[
            [
            'name'=>'wafa',
            'photo'=>'',
            'email'=>'wafa@gmail.com',
            'password'=>'$2y$10$yRA9NiYRx8l.2lssXm9b0emW9f3D6MrFk9Po8xIuJlqclzXvOw.Qm'],
        ];

           \App\Models\Admin::insert($adminRecords);

    }
}

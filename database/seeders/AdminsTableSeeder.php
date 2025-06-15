<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Super Admin',
            'email' => 'ymrabu@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
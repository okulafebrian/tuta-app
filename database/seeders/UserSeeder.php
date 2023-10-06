<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'role_id' => '1',
                'name' => 'TUTA ADMIN',
                'email' => 'tuta@gmail.com',
                'email_verified_at' => '2023-09-17 15:20:56',
                'password' => Hash::make('abc123')
            ],
        ]);
    }
}
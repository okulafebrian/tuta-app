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
                'role_id' => '2',
                'name' => 'Shop Admin',
                'email' => 'shop@tuta.co.id',
                'phone_number' => null,
                'phone_verified_at' => null,
                'password' => Hash::make('shopTUTA555')
            ],
            [
                'role_id' => '3',
                'name' => 'IT Admin',
                'email' => 'it@tuta.co.id',
                'phone_number' => null,
                'phone_verified_at' => null,
                'password' => Hash::make('itTUTA555')
            ]
        ]);
    }
}

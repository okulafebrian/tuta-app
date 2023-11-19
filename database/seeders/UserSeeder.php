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
                'first_name' => 'TUTA SUPERADMIN',
                'last_name' => null,
                'email' => 'tutamandiriindonesia@gmail.com',
                'phone' => null,
                'phone_verified_at' => null,
                'password' => Hash::make('abc123')
            ],
            [
                'role_id' => '1',
                'first_name' => 'Vincent',
                'last_name' => 'Febrien',
                'email' => null,
                'phone' => '+6285156028260',
                'phone_verified_at' => now(),
                'password' => null
            ],
        ]);
    }
}

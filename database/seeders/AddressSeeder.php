<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            [
                'user_id' => '1',
                'name' => 'TUTA OFFICIAL SHOP',
                'phone_number' => '+6281110019979',
                'province_id' => 16,
                'city_id' => 269,
                'district_id' => 4063,
                'zip_code_id' => 7178,
                'detail' => 'GREEN LAKE CITY RUKAN CBD BLOK F NOMOR 022',
                'is_main' => 1,
            ]
        ]);
    }
}

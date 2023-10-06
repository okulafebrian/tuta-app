<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoeVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shoe_variants')->insert([
            [
                'shoe_id' => 1,
                'size_id' => 1,
                'color_id' => 4,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
            [
                'shoe_id' => 1,
                'size_id' => 2,
                'color_id' => 3,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
            [
                'shoe_id' => 1,
                'size_id' => 3,
                'color_id' => 2,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
            [
                'shoe_id' => 2,
                'size_id' => 4,
                'color_id' => 1,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
            [
                'shoe_id' => 2,
                'size_id' => 5,
                'color_id' => 1,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
            [
                'shoe_id' => 3,
                'size_id' => 5,
                'color_id' => 2,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
            [
                'shoe_id' => 4,
                'size_id' => 4,
                'color_id' => 3,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
            [
                'shoe_id' => 4,
                'size_id' => 3,
                'color_id' => 4,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
            [
                'shoe_id' => 5,
                'size_id' => 2,
                'color_id' => 3,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
            [
                'shoe_id' => 5,
                'size_id' => 1,
                'color_id' => 2,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
            [
                'shoe_id' => 5,
                'size_id' => 4,
                'color_id' => 4,
                'price' => 0,
                'discount_price' => 0,
                'stock' => 20,
            ],
        ]);
    }
}

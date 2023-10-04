<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Sneakers',
                'photo' => 'Sneakers.jpeg'
            ],
            [
                'name' => 'Sandal',
                'photo' => 'Sandal.jpeg'
            ],
            [   'name' => 'Sepatu Oxford',
                'photo' => 'Sepatu Oxford.jpeg'
            ],
            [   'name' => 'Boots',
                'photo' => 'Boots.jpeg'
            ],
            [   'name' => 'Sepatu Flat', 
                'photo' => 'Sepatu Flat.jpeg'
            ]
        ]);
    }
}

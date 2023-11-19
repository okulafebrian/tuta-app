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
                'slug' => 'sneakers',
                'photo' => 'sneakers.webp'
            ],
            [
                'name' => 'Sandal',
                'slug' => 'sandal',
                'photo' => 'sandal.webp'
            ],
            [   'name' => 'Sepatu Oxford',
                'slug' => 'sepatu-oxford',
                'photo' => 'sepatu-oxford.webp'
            ],
            [   'name' => 'Boots',
                'slug' => 'boots',
                'photo' => 'boots.webp'
            ],
            [   'name' => 'Sepatu Flat',
                'slug' => 'sepatu-flat',
                'photo' => 'sepatu-flat.webp'
            ]
        ]);
    }
}

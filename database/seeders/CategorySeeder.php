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
            ],
            [
                'name' => 'Sandal',
                'slug' => 'sandal',
            ],
            [   'name' => 'Sepatu Oxford',
                'slug' => 'sepatu-oxford',
            ],
            [   'name' => 'Boots',
                'slug' => 'boots',
            ],
            [   'name' => 'Sepatu Flat',
                'slug' => 'sepatu-flat',
            ]
        ]);
    }
}

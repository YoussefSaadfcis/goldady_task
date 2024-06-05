<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'category 1.1',
            'user_id' => 1

        ]);
        Category::create([
            'name' => 'category 2.1',
            'user_id' => 1

        ]);
        Category::create([
            'name' => 'category 1.2',
            'user_id' => 2

        ]);
        Category::create([
            'name' => 'category 2.2',
            'user_id' => 2

        ]);
    }
}

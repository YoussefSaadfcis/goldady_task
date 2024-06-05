<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'title post 1',
            'body' => 'body post 1',
            'image' => "temp image",
            'user_id' => 1,
            'category_id' => 1,

        ]);
        Post::create([
            'title' => 'title post 2',
            'body' => 'body post 2',
            'image' => "temp image",
            'user_id' => 1,
            'category_id' => 2,

        ]);
        Post::create([
            'title' => 'title post 1',
            'body' => 'body post 1',
            'image' => "temp image",
            'user_id' => 2,
            'category_id' => 3,
        ]);
        Post::create([
            'title' => 'title post 1',
            'body' => 'body post 1',
            'image' => "temp image",
            'user_id' => 2,
            'category_id' => 4,
        ]);
    }
}

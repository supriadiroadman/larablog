<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post1 = Post::create([
            'user_id' => '1',
            'category_id' => '1',
            'title' => 'Post 1',
            'slug' => Str::slug('Post 1'),
            'content' => 'Content 1',
            'image' => 'post-1.jpg',
        ]);

        $post2 =  Post::create([
            'user_id' => '2',
            'category_id' => '2',
            'title' => 'Post 2',
            'slug' => Str::slug('Post 2'),
            'content' => 'Content 2',
            'image' => 'post-2.jpg',
        ]);

        $post3 =    Post::create([
            'user_id' => '2',
            'category_id' => '3',
            'title' => 'Post 3',
            'slug' => Str::slug('Post 3'),
            'content' => 'Content 3',
            'image' => 'post-3.jpg',
        ]);

        $post4 =    Post::create([
            'user_id' => '3',
            'category_id' => '4',
            'title' => 'Post 4',
            'slug' => Str::slug('Post 4'),
            'content' => 'Content 4',
            'image' => 'post-4.jpg',
        ]);

        $post5 =  Post::create([
            'user_id' => '3',
            'category_id' => '5',
            'title' => 'Post 5',
            'slug' => Str::slug('Post 5'),
            'content' => 'Content 5',
            'image' => 'post-5.jpg',
        ]);

        $post1->tags()->attach([1]);
        $post2->tags()->attach([1, 2]);
        $post3->tags()->attach([1, 2, 3]);
        $post4->tags()->attach([1, 2, 3, 4]);
        $post5->tags()->attach([1, 2, 3, 4, 5]);
    }
}

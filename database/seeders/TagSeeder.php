<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'Tag 1',
            'slug' => Str::slug('Tag 1'),
        ]);

        Tag::create([
            'name' => 'Tag 2',
            'slug' => Str::slug('Tag 2'),
        ]);

        Tag::create([
            'name' => 'Tag 3',
            'slug' => Str::slug('Tag 3'),
        ]);

        Tag::create([
            'name' => 'Tag 4',
            'slug' => Str::slug('Tag 4'),
        ]);

        Tag::create([
            'name' => 'Tag 5',
            'slug' => Str::slug('Tag 5'),
        ]);
    }
}

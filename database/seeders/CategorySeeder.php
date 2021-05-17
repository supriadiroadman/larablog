<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Category 1',
            'slug' => Str::slug('Category 1'),
        ]);

        Category::create([
            'name' => 'Category 2',
            'slug' => Str::slug('Category 2'),
        ]);

        Category::create([
            'name' => 'Category 3',
            'slug' => Str::slug('Category 3'),
        ]);

        Category::create([
            'name' => 'Category 4',
            'slug' => Str::slug('Category 4'),
        ]);

        Category::create([
            'name' => 'Category 5',
            'slug' => Str::slug('Category 5'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Slug digenerate otomatis di model User
        User::create([
            'name' => 'Supriadi',
            // 'slug' => Str::slug('Supriadi'),
            'email' => 'supriadiroadman@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Budi',
            // 'slug' => Str::slug('Budi'),
            'email' => 'budi@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Candra',
            // 'slug' => Str::slug('Candra'),
            'email' => 'candra@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user'
        ]);
    }
}

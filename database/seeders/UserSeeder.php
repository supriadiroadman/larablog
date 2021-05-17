<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Supriadi',
            'email' => 'supriadiroadman@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Budi',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Candra',
            'email' => 'candra@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'LaraBlog',
            'title' => 'Latest Blog Posts',
            'subtitle' => 'Read and get updated on how we progress',
            'menu' => 'Dashboard',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Home Banner
        App\Banner::create([
            'name' => 'home'
        ]);
        // School Banner
        App\Banner::create([
            'name' => 'school'
        ]);
        // Course Banner
        App\Banner::create([
            'name' => 'course'
        ]);
    }
}

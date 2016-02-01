<?php

use Illuminate\Database\Seeder;
use App\Course;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ( Course::all() as $course ) {
            $numCategories = rand(0, 3);
            for ($i = 1; $i <= $numCategories; $i++ ) {
                $course->categories()->save(factory(App\Category::class)->make());
            }
        }
    }
}

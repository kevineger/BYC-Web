<?php

use Illuminate\Database\Seeder;
use App\Course;

class CategoryTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Sports'    => factory(App\Category::class, 'Sports')->make(),
                       'Music'     => factory(App\Category::class, 'Music')->make(),
                       'Art'       => factory(App\Category::class, 'Art')->make(),
                       'Education' => factory(App\Category::class, 'Education')->make(),
                       'Cooking'   => factory(App\Category::class, 'Cooking')->make()
        ];
        foreach (Course::all() as $course)
        {
            $numCategories = rand(0, 3);
            $categories_list = ['Sports', 'Music', 'Art', 'Education', 'Cooking'];
            for ($i = 0; $i < $numCategories; $i++)
            {
                $category_idx = rand(0, sizeof($categories_list) - 1);
                $course->categories()->save($categories[array_values($categories_list)[$category_idx]]);
                // Don't let this course allocate the same category twice
                unset($categories_list[$category_idx]);
            }
        }
    }
}

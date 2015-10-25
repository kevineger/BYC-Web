<?php

use App\Course;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ( Course::all() as $course ) {
            $numComments = rand(0, 30);
            for ($i = 1; $i <= $numComments; $i++ ) {
                $course->comments()->save(factory(App\Comment::class)->make());
            }
        }
    }
}

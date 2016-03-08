<?php

use App\Course;
use App\School;
use App\User;
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
        // for each course assign a comment that belongs to a random consumer
        foreach ( Course::all() as $course ) {
            $numComments = rand(0, 10);
            for ($i = 1; $i <= $numComments; $i++ ) {
                $user = User::consumer()->get();
                $comment = $user->shuffle()->first()->comments()->save(factory(App\Comment::class)->make());
                $course->comments()->save($comment);
            }
        }
        foreach ( School::all() as $school ) {
            $numComments = rand(0, 10);
            for ($i = 1; $i <= $numComments; $i++ ) {
                $user = User::consumer()->get();
                $comment = $user->shuffle()->first()->comments()->save(factory(App\Comment::class)->make());
                $school->comments()->save($comment);
            }
        }
    }
}

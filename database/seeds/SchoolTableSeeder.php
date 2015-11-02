<?php

use App\User;
use Illuminate\Database\Seeder;

class SchoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a school for each user of type 'vendor' and add courses to that school.
        foreach (User::vendor()->get() as $u) {
            $s = $u->school()->save(factory(App\School::class)->make());
            // Assign 1-5 active courses for each school
            $numCourses = rand(1,5);
            for ($i = 1; $i <= $numCourses; $i++ ) {
                $s->courses()->save(factory(App\Course::class)->make());
            }
            // Assign 1-2 inactive courses for each school
            $numCourses = rand(1,2);
            for ($i = 1; $i <= $numCourses; $i++ ) {
                $s->courses()->save(factory(App\Course::class, 'inactive')->make());
            }
        }
    }
}

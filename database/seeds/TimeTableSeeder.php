<?php

use Illuminate\Database\Seeder;
use App\Course;

class TimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // For each course, assign random times.
        foreach (Course::all() as $c) {
            $num_times = rand(1,3);
            $repeat_type = rand(1,3);
            $repeat = 'w';
            if ( $repeat_type == 2 ) $repeat = 'b';
            elseif ( $repeat_type == 3 ) $repeat = 'm';
            for ($i = 0; $i <= $num_times; $i++ ) {
                $c->times()->attach(factory(App\Time::class, $repeat)->create());
            }
        }
    }
}

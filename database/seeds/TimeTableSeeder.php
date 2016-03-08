<?php

use Illuminate\Database\Seeder;
use App\Course;

class TimeTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // For each course, assign random times.
        foreach ( Course::all() as $c ) {
            $num_times = rand(1, 3);
            $repeat_types = ['w', 'b', 'm'];
            $repeat = $repeat_types[array_rand($repeat_types, 1)];
            for ( $i = 0; $i <= $num_times; $i++ ) {
                $num_seats = rand(5, 30);
                $num_reg = rand(0, $num_seats);
                $c->times()->attach(factory(App\Time::class, $repeat)->create(), [
                    'num_seats' => $num_seats,
                    'num_reg'   => $num_reg
                ]);
            }
        }
    }
}

<?php namespace App\Transformers;

use Carbon\Carbon;

class TimeTransformer extends Transformer {

    public function transform($times)
    {
        $transformed_times = [];
        foreach ( $times as $key => $time ) {
            $transformed_times[$key] = [
                'id'             => (int)$time['id'],
                'time_of_day'    => Carbon::parse($time['time_of_day'])->hour . ":" . Carbon::parse($time['time_of_day'])->minute,
                'days'           => $time->days(),
                //  TODO: Get correct seat numbers from pivot table
                'num_seats'      => '30',
                'num_avail'      => '12',
                'beginning_date' => date($time['beginning_date']),
                'end_date'       => date($time['end_date']),
            ];
        }

        return $transformed_times;
    }
}
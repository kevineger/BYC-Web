<?php namespace App\Transformers;

use Carbon\Carbon;

class TimeTransformer extends Transformer {

    public function transform($times)
    {
        $transformed_times = [];
        foreach ( $times as $key => $time ) {
            $transformed_times[$key] = [
                'id'             => (int)$time['id'],
                'time_of_day'    => Carbon::parse($time['start_time'])->hour . ":" . Carbon::parse($time['start_time'])->minute,
                'days'           => $time->days(),
                'num_seats'      => $time->pivot->num_seats,
                'num_avail'      => $time->pivot->num_seats - $time->pivot->num_reg,
                'beginning_date' => date($time['beginning_date']),
                'end_date'       => date($time['end_date']),
            ];
        }

        return $transformed_times;
    }
}
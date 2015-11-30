<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'time_of_day',
        'mon',
        'tues',
        'wed',
        'thurs',
        'fri',
        'sat',
        'sun',
        'beginning_date',
        'end_date',
        'repeats'
    ];

    public function course()
    {
        return $this->belongsTo('App\Course')->withPivot('course_id', 'time_id', 'num_avail', 'num_reg');
    }

    public function days()
    {
        $active_days = [];
        if ( $this['mon'] ) array_push($active_days, 'mon');
        if ( $this['tues'] ) array_push($active_days, 'tues');
        if ( $this['wed'] ) array_push($active_days, 'wed');
        if ( $this['thur'] ) array_push($active_days, 'thur');
        if ( $this['fri'] ) array_push($active_days, 'fri');
        if ( $this['sat'] ) array_push($active_days, 'sat');
        if ( $this['sun'] ) array_push($active_days, 'sun');

        return $active_days;
    }
}

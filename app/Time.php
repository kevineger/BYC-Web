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
        'start_time',
        'end_time',
        'mon',
        'tue',
        'wed',
        'thu',
        'fri',
        'sat',
        'sun',
        'beginning_date',
        'end_date',
        'repeats'
    ];

    protected $dates = [
        'start_time',
        'end_time',
        'beginning_date',
        'end_date'
    ];

    public function course()
    {
        return $this->belongsTo('App\Course')->withPivot('course_id', 'time_id', 'num_avail', 'num_reg');
    }

    /**
     * Get a user interpretable array of the days.
     *
     * @return array
     */
    public function days()
    {
        $active_days = [];
        if ($this['mon']) array_push($active_days, 'Monday');
        if ($this['tue']) array_push($active_days, 'Tuesday');
        if ($this['wed']) array_push($active_days, 'Wednesday');
        if ($this['thu']) array_push($active_days, 'Thursday');
        if ($this['fri']) array_push($active_days, 'Friday');
        if ($this['sat']) array_push($active_days, 'Saturday');
        if ($this['sun']) array_push($active_days, 'Sunday');

        return $active_days;
    }

    /**
     * Get a user interpretable occurrence of how often a Time repeats.
     * @return string
     */
    public function repeats()
    {
        if ($this->repeats == 'w') return 'Weekly';
        if ($this->repeats == 'b') return 'Biweekly';
        if ($this->repeats == 'm') return 'Monthly';
    }
}

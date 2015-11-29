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
        'name',
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
}

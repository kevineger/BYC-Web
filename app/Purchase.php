<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // TODO: Do I have to set foreign keys as fillable for mass assignment?
    protected $fillable = [
        'payment_id',
        'course_id',
        'time_id',
        'quantity',
        'subtotal'
    ];

    /**
     * A Purchase belongs to one payment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    /**
     * A Purchase belongs to one course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    /**
     * A Purchase belongs to one time.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function time()
    {
        return $this->belongsTo('App\Time');
    }


}

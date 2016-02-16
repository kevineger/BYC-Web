<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'paypal_id',
        'total'
    ];

    /**
     * A Payment has many Purchases.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }

    /**
     * A Payment belongs to a User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

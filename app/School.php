<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\School
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Course[] $courses
 * @property-read \App\User $user
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\School whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereUpdatedAt($value)
 */
class School extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'user_id',
    ];

    /**
     * A School has many Courses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    /**
     * A School belongs to a User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @param $related
     * @return bool
     */
    public function owns($related)
    {
        return $this->id == $related->school_id;
    }

    /** Query Scope.
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%$search%");
    }
}

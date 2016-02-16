<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * App\User
 *
 * @property-read \App\School $school
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @method static \Illuminate\Database\Query\Builder|\App\User vendor()
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereSchool($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @property boolean $vendor
 * @method static \Illuminate\Database\Query\Builder|\App\User whereVendor($value)
 */
class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract {

    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'vendor'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * A User has many Schools.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function school()
    {
        return $this->hasOne('App\School');
    }

    /**
     * Get all of a course's photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    /**
     * Add a photo to the Course model.
     *
     * @param Photo $photo
     * @return Model
     */
    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }

    /**
     * A User has many Comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * A User has many Payments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    /**
     * A query scope to retrieve all school users.
     *
     * @param $query
     * @return mixed
     */
    public function scopeVendor($query)
    {
        return $query->where('vendor', 1);
    }

    /**
     * A helper function for determining if a user owns the related model.
     *
     * @param $related
     * @return bool
     */
    public function owns($related)
    {
        return $this->id == $related->user_id;
    }
}

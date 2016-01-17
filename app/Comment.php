<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property integer $id
 * @property string $text
 * @property integer $commentable_id
 * @property string $commentable_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Comment $commentable
 */
class Comment extends Model {

    protected $fillable = [
        'text'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}

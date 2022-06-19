<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id');
    }

    /**
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }
}

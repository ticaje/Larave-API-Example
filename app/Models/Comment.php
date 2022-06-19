<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    /**
     * @return BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
}

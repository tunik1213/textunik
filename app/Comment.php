<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = array(
        'authorId',
        'articleId',
        'parentId',
        'text'
    );

    public function author()
    {
        return $this->belongsTo('App\User', 'authorId');
    }
}

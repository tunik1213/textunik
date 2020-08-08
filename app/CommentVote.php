<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentVote extends Model
{
    protected $fillable = array(
        'comment_id',
        'author_id',
        'value'
    );
}

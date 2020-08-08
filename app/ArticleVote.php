<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleVote extends Model
{
    protected $fillable = array(
        'article_id',
        'author_id',
        'value'
    );
}

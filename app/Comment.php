<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function children()
    {
        return $this->hasMany('app\Comment', 'parentId');
    }

    public function article()
    {
        return $this->belongsTo('App\Article', 'articleId');
    }

    public function canEdit() : bool
    {
        $user = Auth::user();
        if (!$user)
            return false;

        if ($user->moderator)
            return true;

        if ($this->authorId == $user->id)
            return true;

        return false;
    }
}

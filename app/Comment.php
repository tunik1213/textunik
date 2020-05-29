<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use App\Mail\ArticleCommentNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Article;

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

    public function parent()
    {
        return $this->belongsTo('app\Comment', 'parentId');
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

    public function sendNotificationEmail() : void
    {
        if ($this->parentId == 0) {
            $receiver = $this->article->author;
        } else {
            $receiver = $this->parent->author;
        }

        if (!$receiver->comment_notifications) return;
        if ($receiver->id == $this->author->id) return;

        $email = (new ArticleCommentNotification($this))
            ->onQueue('low');
        
        Mail::to($receiver)
            ->queue($email);
    }
}

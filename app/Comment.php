<?php

namespace App;

use App\Interfaces\Votable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArticleCommentNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Article;

class Comment extends Model implements Votable
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

        if (!$receiver->emailConfirmed()) return;
        if (!$receiver->comment_notifications) return;
        if ($receiver->id == $this->author->id) return;

        $email = (new ArticleCommentNotification($this))
            ->onQueue('low');

        Mail::to($receiver)
            ->queue($email);
    }

    public function getVotesUp(): int
    {
        return $this->votes_up;
    }

    public function getVotesDown(): int
    {
        return -$this->votes_down;
    }

    public function getUserVote() : ?int
    {
        $authorId = Auth::User()->id ?? null;
        if (empty($authorId)) return null;

        $vote = CommentVote::where(['comment_id' => $this->id, 'author_id' => $authorId])
            ->pluck('value');

        return $vote[0] ?? null;
    }

    public function voteUp(): void
    {
        $this->saveVote(SELF::DEFAULT_VALUE);
    }

    public function voteDown(): void
    {
        $this->saveVote(-SELF::DEFAULT_VALUE);
    }

    private function saveVote(int $value) : void
    {
        $authorId = Auth::User()->id ?? null;
        if (empty($authorId)) return;

        // найдем существующий голос если есть
        $vote = CommentVote::firstOrNew(['comment_id' => $this->id, 'author_id' => $authorId]);

        // вычтем его из комментария
        if ($vote->value > 0) {
            $this->votes_up -= $vote->value;
        } else {
            $this->votes_down -= $vote->value;
        }

        // добавим новый голос
        if ($value > 0) {
            $this->votes_up += $value;
        } else {
            $this->votes_down += $value;
        }

        $vote->value = $value;

        DB::beginTransaction();
        $vote->save();
        $this->save();
        DB::commit();
    }
}

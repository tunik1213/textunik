<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $fillable = array(
        'authorId',
        'title',
        'annotation',
        'content',
        'finished',
        'moderatedBy'
    );

    public function url() : string
    {
        return '/article/'.$this->id;
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'authorId');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'articleId');
    }

    public function public() : bool
    {
        return ($this->moderatedBy <> null);
    }

    public function canEdit() : bool
    {
        $user = Auth::user();
        if (!$user)
            return false;

        // суперадмин может все
        if ($user->superAdmin())
            return true;

        // модератор может редактировать завершенные неопубликованные статьи
        if ($user->moderator && !$this->public() && $this->finished = 1)
            return true;

        // юзер может редактировать свои незавершенные статьи (черновики)
        if ($this->finished == 0 && $this->authorId == $user->id)
            return true;


        return false;
    }

    public static function createNew() : Article
    {
        return self::firstOrCreate([
            'authorId'=>Auth::user()->id,
            'finished'=>false
        ]);
    }
}

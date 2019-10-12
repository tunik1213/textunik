<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use Carbon\Carbon;

class Article extends Model
{
    protected $fillable = array(
        'authorId',
        'title',
        'annotation',
        'content'
    );

    public function getCreatedAtAttribute($val)
    {

        return Carbon::parse($val)->formatLocalized('%c');
    }

    public function url()
    {
        return '/article/'.$this->id;
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'authorId');
    }
}

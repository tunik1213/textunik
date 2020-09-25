<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }

    public static function mostPopular() : object
    {
        return Self::select('name','slug')
            ->join('article_tag','article_tag.tag_id','=','tags.id')
            ->groupBy('name','slug')
            ->orderByRaw('count(*) DESC')
            ->limit(15)
            ->havingRaw('count(*)>0')
            ->get();
    }
}

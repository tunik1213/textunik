<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    public function sitemap() {
        $articles = Article::where('moderatedBy','<>',null)
            ->orderBy('id', 'desc')
            ->get();

        $authors = DB::select( DB::raw("
        select
            a.authorId id,
            max(a.updated_at) updated_at
        from
            articles a
        where 
            a.finished = 1
            and a.moderatedBy is not null
        group by 
            a.authorId
        "));

        foreach ($authors as $author){
            $author->lastmod = new Carbon($author->updated_at);
        }


        $contents = View::make('sitemap')->with(
            [
                'articles' => $articles,
                'authors' => $authors
            ]
        );
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'application/xml');
        return $response;
    }
}

<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Carbon\Carbon;
use DevDojo\Chatter\Models\Category;
use DevDojo\Chatter\Models\Discussion;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    public function sitemap() {
        $articles = Article::where('moderatedBy','<>',null)
            ->orderBy('id', 'desc')
            ->get();

        $forum_categories = Category::all();

        $forum_discussions = Discussion::all();

        $authors = DB::select( DB::raw("
        select
            a.authorId id,
            max(a.updated_at) updated_at
        from
            articles a
        where 
            a.finished = 1
        group by 
            a.authorId
        "));

        foreach ($authors as $author){
            $author->lastmod = new Carbon($author->updated_at);
        }


        $contents = View::make('sitemap')->with(
            [
                'articles' => $articles,
                'forum_categories' => $forum_categories,
                'forum_discussions' => $forum_discussions,
                'authors' => $authors
            ]
        );
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'application/xml');
        return $response;
    }
}

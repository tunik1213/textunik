<?php

namespace App\Http\Controllers;

use App\Article;
use DevDojo\Chatter\Models\Category;
use DevDojo\Chatter\Models\Discussion;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class ExportController extends Controller
{
    public function sitemap() {
        $articles = Article::where('moderatedBy','<>',null)
            ->orderBy('id', 'desc')
            ->get();

        $forum_categories = Category::all();

        $forum_discussions = Discussion::all();

        $contents = View::make('sitemap')->with(
            [
                'articles' => $articles,
                'forum_categories' => $forum_categories,
                'forum_discussions' => $forum_discussions
            ]
        );
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'application/xml');
        return $response;
    }
}

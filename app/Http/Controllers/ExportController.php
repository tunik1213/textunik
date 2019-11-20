<?php

namespace App\Http\Controllers;

use App\Article;
use DevDojo\Chatter\Models\Category;
use DevDojo\Chatter\Models\Discussion;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function sitemap() {
        $articles = Article::where('moderatedBy','<>',null)
            ->orderBy('id', 'desc')
            ->get();

        $forum_categories = Category::all();

        $forum_discussions = Discussion::all();


        return view('sitemap', [
            'articles' => $articles,
            'forum_categories' => $forum_categories,
            'forum_discussions' => $forum_discussions
        ]);
    }
}

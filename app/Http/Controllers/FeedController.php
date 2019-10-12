<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $articles = Article::where('moderatedBy','<>',null)
            ->orderBy('id', 'desc')
            ->simplePaginate(10);
        return view('feed', ['articles' => $articles]);
    }
}

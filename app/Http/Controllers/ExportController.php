<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function sitemap() {
        $articles = Article::where('moderatedBy','<>',null)
            ->orderBy('id', 'desc')
            ->get();

        return view('sitemap', [
            'articles' => $articles
        ]);
    }
}

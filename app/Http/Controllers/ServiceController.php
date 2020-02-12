<?php

namespace App\Http\Controllers;

use App\Article;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as LibImage;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superAdmin');
    }

    public function convertAllImages()
    {
        foreach (Image::all() as $image) {

            $image->image = LibImage::make($image->image)
                ->fit(1024,680, function ($constraint) {
                    $constraint->upsize();
                })->encode('jpg', 75);
            $image->save();
        }
    }

    public function editAllArticles()
    {
        foreach (Article::all() as $article){

            $article->annotation = str_replace('<img src="','<img style="display: block;margin: 10px auto;" src="',$article->annotation);
            $article->content = str_replace('<img src="','<img style="display: block;margin: 10px auto;" src="',$article->content);
            $article->save();

        }
    }
}

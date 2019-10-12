<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class TestController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        $articles =$user->articles;
        var_dump($articles);
//        foreach ($articles as $article)
//            var_dump($article);
//            echo '<hr>';
    }
}

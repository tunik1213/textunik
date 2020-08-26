<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use App\Tag;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function users() {
        $users = User::orderBy('id', 'desc')
            ->get();
        return view('admin.users',['users' => $users]);
    }

    public function articles() {
        $moderation = Article::where('finished', 1)
            ->where('moderatedBy', null)
            ->where('title', '<>', '')
            ->get();

        $drafts = Article::where('finished', 0)
            ->where('title', '<>', '')
            ->get();

        return view('admin.articles',['moderation' => $moderation, 'drafts' => $drafts]);
    }

}

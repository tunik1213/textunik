<?php

namespace App\Http\Controllers;

use Illuminate\Routing\UrlGenerator;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function getByParent(int $parentId)
    {
        $article_id = (int)$_GET["article"];

        $comments = Comment::where('articleId', $article_id)
            ->where('parentId',$parentId)
            ->orderBy('id', 'asc')
            ->get();

        $result = [
            'comments' => $comments,
        ];

        return view('article.comments',$result);
    }

    public function addComment()
    {
        $commentText = trim(htmlspecialchars($_POST['comment']));
        if (empty($commentText)) return;

        $comment = new Comment([
            'authorId'=>Auth::id(),
            'articleId'=>(int)$_POST['article'],
            'parentId'=>(int)$_POST['parent_id'],
            'text'=>$commentText
        ]);

        $comment->save();
        return view('article.comments',['comments' => [$comment]]);
    }
}

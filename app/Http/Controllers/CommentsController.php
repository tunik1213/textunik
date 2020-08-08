<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Article;
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

        $comment->sendNotificationEmail();

        return view('article.comments',['comments' => [$comment]]);
    }

    public function editComment(Request $request, $id){
        $comment = Comment::find($id);
        if (!$comment->canEdit()) return;

        $newText = $request->input('comment');
        if (empty($newText)) return;

        $comment->text = $newText;
        $comment->save();
    }

    public function vote(request $request)
    {
        $commentId = $request->input('comment');
        $comment = Comment::find($commentId);
        if (empty($comment)) abort('404');

        $action = $request->input('action');
        if ($action == 'up') {
            $comment->voteUp();
        } elseif ($action == 'down') {
            $comment->voteDown();
        }

        return view('article.voting', [
            'object' => $comment
        ]);
    }
}

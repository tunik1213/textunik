<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Image;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as LibImage;

class ArticleController extends Controller
{
    public function feed(request $request)
    {
        $articles = Article::where('moderatedBy', '<>', null)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {

            $view = view('article.list_data',
                ['articles' => $articles]
            )->render();
            return response()->json(['html' => $view]);
        }

        return view('feed', ['articles' => $articles]);
    }

    public function editForm(int $articleId = null)
    {
        if ($articleId == null) {
            $article = Article::createNew();
            $pageTitle = 'Добавление новой статьи';
        } else {
            $article = Article::find($articleId);
            $pageTitle = 'Редактирование статьи';
        }

        if (!$article->canEdit()) {
            abort(403);
        }

        return view('article.edit', [
            'article' => $article,
            'pageTitle' => $pageTitle,
        ]);
    }

    public function editPost(request $request, int $articleId)
    {

        //var_dump($_POST);return

        $article = Article::find($articleId);
        if (!$article->canEdit())
            abort(403);

        $user = Auth::user();

        $article->title = remove_html_comments($request->input('title'));

        $annotation = $request->input('annotation');
        if (!empty($annotation))
            $article->annotation = remove_html_comments($annotation);

        $content = $request->input('article-content');
        if (!empty($content))
            $article->content = remove_html_comments($content);

        $finished = (bool)$request->input('finished', false);

        if (!$article->finished && $finished) { // первая публикация автором - статья ожидает модерацию
            $article->created_at = time();
        }

        if ($user->moderator) {
            $article->meta_keywords = $request->input('keywords');
            $article->meta_description = $request->input('description');

            if (!$article->public()){
                $article->slug = $request->input('slug');

                if ($finished) { // это первая публикация модератором - статья становится публичной и попадает в ленту
                    $article->created_at = time();
                    $article->newArticleEmailNotification();
                }
            }

        }

        $article->tags()->sync($request->input('tags'));

        if (!$article->finished) {
            $article->finished = $finished;
        }

        if ($article->finished && $finished) {
            $article->moderatedBy = ($user->moderator) ? $user->id : null;
        }

        $article->save();

        return redirect('article/' . $article->id);
    }

    private function getPostById(int $id) {
        $article = Article::find($id);

        if ($article == null) abort(404);

        if ($article->public())
            abort(301, '', ['Location' => $article->url()]);
        else
            return $article;
    }
    private function getPostBySlug(string $slug){
        $article = Article::where('slug', $slug)->first();

        if ($article == null) abort(404);

        return $article;
    }

    public function viewPost($param)
    {
        if (is_numeric($param)) {
            $article = $this->getPostById($param);
        } else {
            $article = $this->getPostBySlug($param);
        }

        $comments = Comment::where('articleId',$article->id)
            ->where('parentId',0)
            ->get();

        return view('article.view', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function uploadImage(request $request)
    {
        $result = ['success' => false];
        $articleId = $request->input('articleId');

        if ($articleId == null) {
            $article = Article::firstOrCreate([
                'authorId' => Auth::user()->id,
                'finished' => false
            ]);
        } else {
            $article = Article::find($articleId);
        }

        if (!empty($_FILES['filename']['tmp_name'])) {
            $img = new Image();
            $img->image = LibImage::make($_FILES['filename']['tmp_name'])
                ->encode('jpg', 75);
            $img->articleId = $article->id;

            $img->save();

            $result['url'] = '/images/' . $img->articleId . '/' . $img->id;
            $result['success'] = true;
        }

        echo json_encode($result);

    }

    public function getImage($articleId, $imageId)
    {
         $record = Image::where('articleId', $articleId)
            ->where('id', $imageId)
            ->first();
        if (empty($record))
            abort(404);

        $img =  $record->image;

        header("Content-Type: image/jpg");
        header("Content-Length: " . strlen($img));

        echo($img);
        exit;
    }

    public function vote(request $request)
    {
        $articleId = $request->input('article');
        $article = Article::find($articleId);
        if (empty($article)) abort('404');

        $action = $request->input('action');
        if ($action == 'up') {
            $article->voteUp();
        } elseif ($action == 'down') {
            $article->voteDown();
        }

        return view('article.voting', [
            'object' => $article
        ]);
    }
}

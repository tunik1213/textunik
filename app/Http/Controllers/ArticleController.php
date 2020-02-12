<?php

namespace App\Http\Controllers;

use App\Article;
use App\Image;
use Illuminate\Http\Request;
use Auth;
use Intervention\Image\ImageManagerStatic as LibImage;

class ArticleController extends Controller
{
    public function feed(request $request)
    {
        $articles = Article::where('moderatedBy', '<>', null)
            ->orderBy('id', 'desc')
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
        //var_dump($_POST);return;

        $article = Article::find($articleId);
        if (!$article->canEdit())
            abort(403);

        $author = Auth::user();

        $article->title = remove_html_comments($request->input('title'));
        $article->annotation = remove_html_comments($request->input('annotation'));
        $article->content = remove_html_comments($request->input('article-content'));
        $finished = (bool)$request->input('finished', false);
        if (!$article->finished && $finished) { // это первая публикация
            $article->created_at = time();
        }
        if (!$article->finished) {
            $article->finished = $finished;
        }

        if ($article->finished && $finished) {
            $article->moderatedBy = ($author->moderator) ? $author->id : null;
        }
        if ($author->moderator) {
            $article->meta_keywords = $request->input('keywords');
            $article->meta_description = $request->input('description');
        }
        $article->save();

        return redirect('article/' . $article->id);
    }

    public function viewPost(int $id)
    {
        $article = Article::find($id);
        return view('article.view', ['article' => $article]);
    }

    public function uploadImage()
    {
        $result = ['success' => false];

        $article = Article::firstOrCreate([
            'authorId' => Auth::user()->id,
            'finished' => false
        ]);

        if (!empty($_FILES['filename']['tmp_name'])) {
            $img = new Image();
            $img->image = LibImage::make($_FILES['filename']['tmp_name'])
                ->fit(1024, 800, function ($constraint) {
                    $constraint->upsize();
                })->encode('jpg', 75);
            $img->articleId = $article->id;

            $img->save();

            $result['url'] = '/images/' . $img->articleId . '/' . $img->id;
            $result['success'] = true;
        }

        echo json_encode($result);

    }

    public function moderation($id = null)
    {
        var_dump($id);
    }

    public function getImage($articleId, $imageId)
    {
        $img = Image::where('articleId', $articleId)
            ->where('id', $imageId)
            ->first()
            ->image;

        header("Content-Type: image/jpg");
        header("Content-Length: " . strlen($img));

        echo($img);
        exit;
    }
}

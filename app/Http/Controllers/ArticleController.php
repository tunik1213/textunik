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
        $article = Article::find($articleId);
        if (!$article->canEdit())
            abort(403);

        $user = Auth::user();

        $article->title = remove_html_comments($request->input('title'));
        $article->annotation = remove_html_comments($request->input('annotation'));
        $article->content = remove_html_comments($request->input('article-content'));
        $finished = (bool)$request->input('finished', false);
        if (!$article->finished && $finished) { // это первая публикация
            $article->created_at = time();
        }

        if ($user->moderator) {
            $article->meta_keywords = $request->input('keywords');
            $article->meta_description = $request->input('description');

            if (!$article->public()){
                $article->slug = $request->input('slug');
            }
        }

        if (!$article->finished) {
            $article->finished = $finished;
        }

        if ($article->finished && $finished) {
            $article->moderatedBy = ($user->moderator) ? $user->id : null;
        }

        $article->save();

        return redirect('article/' . $article->id);
    }

    private function viewPostById(int $id) {
        $article = Article::find($id);

        if ($article == null) abort(404);

        if ($article->public())
            return redirect($article->url(), 301);
        else
            return view('article.view', ['article' => $article]);
    }
    private function viewPostBySlug(string $slug){
        $article = Article::where('slug', $slug)->first();

        if ($article == null) abort(404);

        return view('article.view', ['article' => $article]);
    }

    public function viewPost($param)
    {
        if (is_numeric($param)) { // so why php does not support owerloading?
            return $this->viewPostById($param);
        } else {
            return $this->viewPostBySlug($param);
        }
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

<?php

namespace App\Http\Controllers;

use App\Article;
use App\Image;
use Illuminate\Http\Request;
use Auth;
use Intervention\Image\ImageManagerStatic as LibImage;

class ArticleController extends Controller
{
    public function editForm(int $articleId = null)
    {
        if ($articleId == null) {
            $article = Article::createNew();
            $pageTitle = 'Добавление новой статьи';
        } else {
            $article = Article::find($articleId);
            $pageTitle = 'Редактирование статьи';
        }

        if (!$article->canEdit()){
            abort(403);
        }

        return view('article.edit',[
            'article' => $article,
            'pageTitle' => $pageTitle,
        ]);
    }

    public function editPost(int $articleId)
    {
        $article = Article::find($articleId);
        if (!$article->canEdit())
            abort(403);

        $author = Auth::user();

        $article->title = remove_html_comments($_POST['title']);
        $article->annotation = remove_html_comments($_POST['annotation']);
        $article->content = remove_html_comments($_POST['trymbowyg-content']);
        if (isset($_POST['finished']))
            $article->finished = (bool)$_POST['finished'];
        $article->moderatedBy = ($author->moderator) ? $author->id : null;
	    $article->created_at = time()-1;
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
            'authorId'=>Auth::user()->id,
            'finished'=>false
        ]);

        error_log($_FILES['filename']['tmp_name']);

        if (!empty($_FILES['filename']['tmp_name'])){
            $img = new Image();
            $img->image = LibImage::make($_FILES['filename']['tmp_name'])
                    ->fit(1024,680, function ($constraint) {
                        $constraint->upsize();
                    })->encode('jpg', 75);
            $img->articleId = $article->id;

            $img->save();

            $result['url'] = '/images/'.$img->articleId.'/'.$img->id;
            $result['success'] = true;
        }

        echo json_encode($result);

    }

    public function moderation ($id=null)
    {
        var_dump($id);
    }

    public function getImage($articleId, $imageId)
    {
        $img = Image::where('articleId',$articleId)
            ->where('id',$imageId)
            ->first()
            ->image;

        header("Content-Type: image/jpg");
        header("Content-Length: " . strlen($img));

        echo($img);
        exit;
    }
}

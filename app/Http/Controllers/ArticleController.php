<?php

namespace App\Http\Controllers;

use App\Article;
use App\Image;
use Illuminate\Http\Request;
use Auth;
use Intervention\Image\ImageManagerStatic as LibImage;

class ArticleController extends Controller
{
    public function addForm()
    {
        return view('article.add');
    }

    public function addPost()
    {
        $article = Article::firstOrCreate([
            'authorId'=>Auth::user()->id,
            'finished'=>false
        ]);
        $article->title = remove_html_comments($_POST['title']);
        $article->annotation = remove_html_comments($_POST['annotation']);
        $article->content = remove_html_comments($_POST['content']);
        $article->finished = true;
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
                ->encode('jpg', 75);
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

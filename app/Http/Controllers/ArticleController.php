<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Auth;

class ArticleController extends Controller
{
    public function addForm()
    {
        return view('article.add');
    }

    public function addPost()
    {
        $article = new Article();
        $article->authorId = Auth::user()->id;
        $article->title = $_POST['title'];
        $article->annotation = $_POST['annotation'];
        $article->content = $_POST['content'];
        $article->save();

        // TODO перенести загруженные картинки в папку с id статьи и переназначить ссылки в тексте статьи

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

        $file = $_FILES['filename'];
        $dir = '/article_images/tmp';
        $upload_dir = public_path() . $dir;
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $upload_file = $upload_dir . '/' . basename($file['name']);
        $result['success'] = move_uploaded_file($file['tmp_name'], $upload_file);
        $result['url'] = url($dir . '/' . $file['name']);

        echo json_encode($result);

    }

    public function moderation ($id=null)
    {
        var_dump($id);
    }
}

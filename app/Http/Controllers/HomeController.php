<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['getAvatarImage','getMiniAvatarImage','profile']);
    }

    public function index()
    {
        $user = auth()->user();
        return view('home.index',['user' => $user]);
    }

    public function updateUser()
    {
        $user = auth()->user();
        $user->name = $_POST['name'];
        $user->nick_name = $_POST['nick_name'];
        $user->specialization = $_POST['specialization'];
        $user->gender = ($_POST['gender']=='') ? null : (bool)$_POST['gender'];
        $user->short_info = $_POST['short_info'];

        if (strtotime($_POST['birthdate']))
            $user->birthdate = $_POST['birthdate'];

        if (!empty($_FILES['avatar']['tmp_name'])){
            $user->avatar = Image::make($_FILES['avatar']['tmp_name'])
                ->fit(800)
                ->encode('jpg', 75);
            $user->avatar_mini = Image::make($_FILES['avatar']['tmp_name'])
                ->fit(50)
                ->encode('jpg', 75);
        }

        $user->save();
        return view('home.index',['user' => $user]);
    }

    public function getAvatarImage(int $userId = null)
    {
        $user = ($userId == null) ? auth()->user() : User::find($userId);
        if ($user==null) return;

        $avatar = $user->avatar;
        if ($avatar == null) {
            $avatar = file_get_contents(public_path().'/avatars/no_foto.jpeg');
        }

        header("Content-Type: image/jpg");
        header("Content-Length: " . strlen($avatar));

        echo($avatar);
        exit;
    }

    public function getMiniAvatarImage($userId = null)
    {
        $user = ($userId === null) ? auth()->user() : User::find($userId);
        $avatar = $user->avatar_mini;
        if ($avatar == null) {
            $avatar = file_get_contents(public_path().'/avatars/no_foto_mini.jpeg');
        }

        header("Content-Type: image/jpg");
        header("Content-Length: " . strlen($avatar));

        echo($avatar);
        exit;
    }

    public function profile($userId)
    {
        $user = User::find($userId);

        $articles['public'] = Article::where('moderatedBy','<>',null)
            ->where('authorId','=',$user->id)
            ->orderBy('id', 'desc')
            ->get();

        $comments = Comment::where('authorId','=',$user->id)
            ->where('parentId',0)
            ->orderBy('id', 'desc')
            ->get();

        if (Auth::user())
        if ($userId == Auth::user()->id){
            $articles['moderation'] = Article::where('moderatedBy','=',null)
                ->where('authorId','=',$user->id)
                ->where('finished','=',1)
                ->orderBy('id', 'desc')
                ->simplePaginate(10);

            $articles['draft'] = Article::where('moderatedBy','=',null)
                ->where('authorId','=',$user->id)
                ->where('finished','=',0)
                ->orderBy('id', 'desc')
                ->simplePaginate(10);
        }

        return view('home.profile',
            [
                'user' => $user,
                'articles' => $articles,
                'comments' => $comments
            ]
        );
    }

}

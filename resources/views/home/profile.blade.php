@extends('layouts.app')

@section('content')



    <div class="container">
        <h1>Профиль пользователя {{ $user->nick_name }}</h1>

        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#articles">
                    Публикации ({{$user->articles->count()}})
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#comments">
                    Комментарии ({{$user->comments->count()}})
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="articles" class="tab-pane fade in active show">
                @foreach($user->articles as $article)
                    <div class="container">
                        <a href="{{ $article->url() }}">{{ $article->title }}</a>
                    </div>
                    <br>
                @endforeach
            </div>
            <div id="comments" class="tab-pane fade">
                @foreach($user->comments as $comment)
                    <div class="container">
                        {{ $comment->text }}
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
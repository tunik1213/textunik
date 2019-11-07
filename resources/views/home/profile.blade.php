@extends('layouts.app')
@section('head')

    <title>Профиль пользователя {{ $user->nick_name }}</title>

@endsection

@section('content')



    <div class="container">
        <h1>Профиль пользователя {{ $user->nick_name }}</h1>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a data-toggle="tab" href="#articles" class="nav-link active">
                    Публикации ({{$user->articles->count()}})
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" href="#comments" class="nav-link">
                    Комментарии ({{$user->comments->count()}})
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="articles" class="tab-pane fade in active show">
                @include('article.list',['articles'=>$articles])
            </div>
            <div id="comments" class="tab-pane fade">
                @include('article.comments',['comments'=>$comments])
            </div>
        </div>
    </div>
@endsection
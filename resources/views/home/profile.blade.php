@extends('layouts.app')
@section('head')

    <title>Профиль пользователя {{ $user->displayName() }}</title>
    <meta name="description" content="{{$user->short_info}}">
@endsection

@section('content')



    <div class="container col-md-9">
        <h1>Профиль пользователя {{ $user->displayName() }}</h1>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a data-toggle="tab" href="#articles" class="nav-link active">
                    Публикации ({{$articles['public']->count()}})
                </a>
            </li>

            <li class="nav-item">
                <a data-toggle="tab" href="#comments" class="nav-link">
                    Комментарии ({{$comments->count()}})
                </a>
            </li>

            @if(isset($articles['draft']))
                <li class="nav-item">
                    <a data-toggle="tab" href="#draft" class="nav-link">
                        Черновики ({{$articles['draft']->count()}})
                    </a>
                </li>
            @endif

            @if(isset($articles['moderation']))
                <li class="nav-item">
                    <a data-toggle="tab" href="#moderation" class="nav-link">
                        Модерация ({{$articles['moderation']->count()}})
                    </a>
                </li>
            @endif
        </ul>
        <div class="tab-content">

            <div id="articles" class="tab-pane fade in active show">
                @include('article.list',['articles'=>$articles['public']])
            </div>

            <div id="comments" class="tab-pane fade">
                @include('article.comments',['comments'=>$comments])
            </div>

            @if(isset($articles['moderation']))
                <div id="moderation" class="tab-pane fade">
                    @include('article.list',['articles'=>$articles['moderation']])
                </div>
            @endif

            @if(isset($articles['draft']))
                <div id="draft" class="tab-pane fade">
                    @include('article.list',['articles'=>$articles['draft']])
                </div>
            @endif

        </div>
    </div>
@endsection
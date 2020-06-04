@extends('layouts.app')
@section('head')

    <title>Профиль пользователя {{ $user->displayName() }}</title>
    <meta name="description" content="{{$user->short_info}}">
@endsection

@section('content')



    <div class="container col-md-9 article-content">
        <div id="profile-header">
            <div id="avatar-profile-large">
                <img src="{{route('avatarImage',['userId'=>$user->id])}}">
            </div>

            <div id="user-title">
                <h1>{{$user->name}}</h1>
                <span>{{$user->specialization}}</span>
            </div>
        </div>

        <ul class="accordion-tabs">
            <li class="tab-head-cont">
                <a href="#" class="nav-link active">
                    О себе
                </a>
                <section>
                    {!! make_links_clickable($user->short_info) !!}
                </section>
            </li>

            <li class="tab-head-cont">
                <a href="#" class="nav-link">
                    Публикации ({{$articles['public']->count()}})
                </a>
                <section>
                    @if(count($articles['public'])>0)
                        @foreach ($articles['public'] as $article)
                            <div class="profile-article-title">
                                <a href="{{$article->url()}}">{{ $article->title }}</a>
                            </div>
                        @endforeach
                    @else
                        Нет публикаций
                    @endif
                </section>
            </li>

            <li class="tab-head-cont">
                <a href="#" class="nav-link">
                    Комментарии ({{$comments->count()}})
                </a>
                <section>
                    @if(count($comments)>0)
                        @include('article.comments',['comments'=>$comments, 'suppressRecursion'=>true])
                    @else
                        Нет комментариев
                    @endif
                </section>
            </li>

            <li class="tab-head-cont">
                <a href="#" class="nav-link">
                    Контакты
                </a>
                <section>
                    {{$user->contacts}}
                </section>
            </li>

            @if(isset($articles['draft']))
                <li class="tab-head-cont profile-tab-own">
                    <a data-toggle="tab" href="#draft" class="nav-link">
                        Черновики ({{$articles['draft']->count()}})
                    </a>
                    <section>
                        @include('article.list',['articles'=>$articles['draft']])
                    </section>
                </li>
            @endif

            @if(isset($articles['moderation']))
                <li class="tab-head-cont profile-tab-own">
                    <a data-toggle="tab" href="#moderation" class="nav-link">
                        Модерация ({{$articles['moderation']->count()}})
                    </a>
                    <section>
                        @include('article.list',['articles'=>$articles['moderation']])
                    </section>
                </li>
            @endif
        </ul>
    </div>



    <style>
        ul ul {list-style-type: initial;margin-block-end: 1em;}
    </style>

@endsection

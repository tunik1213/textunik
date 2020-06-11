@php($article = $comment->article)

@extends('mails.layout')

@section('content')

@if($comment->parentId == 0)
    <h1>Вашу статью прокомментировали</h1>

    <p>
        Пользователь @include('home.user_link',['user'=>$comment->author]) добавил новый комментарий к статье <a href="{{$article->url()}}">{{$article->title}}</a>
    </p>
@else
    <h1>Новый ответ на Ваш комментарий</h1>

    <p>
        Пользователь @include('home.user_link',['user'=>$comment->author]) ответил на Ваш комментарий к статье <a href="{{$article->url()}}">{{$article->title}}</a>
    </p>
@endif

<a class="email-action-button" href="{{$article->url()}}#comment{{$comment->id}}">Прочесть комментарий</a>

<br/>

<p>Если Вы не хотите получать уведомления об ответах на Ваши статьи и комментарии, нажмите
    <a href="{{route('unsubscribeArticleComments',['userId'=>$article->author->id,'userToken'=>$article->author->api_token])}}">отписаться</a>
</p>

@endsection

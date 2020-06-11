@extends('mails.layout')

@section('content')


<h1><a href="{{$article->url()}}">{{ $article->title }}</a></h1>
<div class="article-annotation">
    {!! $article->annotation !!}
</div>

<a class="email-action-button" href="{{$article->url()}}#cut">Читать дальше</a>

<br/>

<p>Если Вы не хотите получать уведомления о новых статьях, нажмите
    <a href="{{route('unsubscribeArticleNotifications',['userId'=>$receiver->id,'userToken'=>$receiver->api_token])}}">отписаться</a>
</p>

@endsection

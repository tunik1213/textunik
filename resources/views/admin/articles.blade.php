@extends('layouts.app')

@section('head')

    <title>Список неопубликованных статей</title>

@endsection

@section('content')

    <div class="container col-md-9 padding-0-phone">

    <a href="/admin">&#8612; Назад в админку</a>

    <br /><br />

        <p>
            Статьи, ожидающие модерацию: {{$moderation->count()}} <br/>
            @foreach($moderation as $article)
                <a href="{{$article->url()}}">{{ $article->title }}</a> <br/>
            @endforeach
        </p>

        <p>
            Неопубликованные черновики: {{$drafts->count()}} <br/>
            @foreach($drafts as $article)
                <a href="{{$article->url()}}">{{ $article->title }}</a> <br/>
            @endforeach
        </p>

    </div>

@endsection

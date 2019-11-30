@extends('layouts.app')
@section('head')

    <title>TEXT-уник: о копирайтинге из опыта и знаний</title>
    <meta name="description" content="Полезный сайт для копирайтеров в формате коллективного блога. Уникальные статьи о копирайтинге для начинающих авторов и опытных копирайтеров. Здесь общаются и публикуются, чтобы делиться знаниями и продвигаться">
    <meta name="keywords" content="авторские статьи о копирайтинге">
@endsection

@section('content')
    <div class="container col-md-8">
        @include('article.list',['articles'=>$articles])
    </div>
@endsection
@extends('layouts.app')
@section('head')
    <title>Текст-уник: популярные категории статей</title>
    <meta name="description"
          content="Текст-уник: популярные категории статей">
@endsection

@section('content')

    <div class="container col-md-9 padding-0-phone">

        <div class="container article-content col-md-12">
            <h1 style="color:black;padding: 1rem;"> Популярные разделы </h1>

            @include('article.popular-tags')
        </div>

    </div>

@endsection

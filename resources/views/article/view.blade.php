@extends('layouts.app')

@section('head')

    <title>{{$article->title}} / Text-уник</title>

    <meta name="description" content="{{$article->meta_description}}">
    <meta name="keywords" content="{{$article->meta_keywords}}">

    <script src="{{ asset('js/comments.js') }}"></script>

    <link href="{{ asset('css/comments.css') }}" rel="stylesheet">

@endsection


@section('content')

    <div class="container col-md-8">
        <div class="container col-md-12 article-content">

            @if (!$article->finished)

                <span class="badge badge-secondary">Черновик</span>

            @elseif (!$article->public())

                @if ($article->authorId == Auth::id())
                    <h1>Спасибо!</h1>
                @endif

                <span class="badge badge-warning">Публикация отправлена на модерацию. Она появится в ленте как только будет проверена сотрудником сайта</span>

            @endif

            @include('article.annotation')

            <div id="cut"></div>

            <div class="article-text">
                {!! $article->content !!}
            </div>

            <hr/>

            @if($article->public())
                <div class="container" id="comments-container" article-id="{{$article->id}}">

                    <div class="md-form add-comment-form">
                        <i class="fas fa-pencil-alt prefix"></i>
                        <textarea id="form10" class="md-textarea form-control" rows="3"></textarea>
                        <label for="form10">Оставить комментарий</label>
                        <button class="post-comment btn btn-primary">Отправить</button>
                    </div>

                    <br>


                    <div id="comments-list" class="container"></div>

                </div>
            @endif


        </div>
    </div>



@endsection
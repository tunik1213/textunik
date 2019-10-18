@extends('layouts.app')

@section('head')

    <title>{{$article->title}}</title>

    <script src="{{ asset('js/comments.js') }}"></script>

    <link href="{{ asset('css/comments.css') }}" rel="stylesheet">

@endsection


@section('content')

    <div class="container">

        @if ($article->moderatedBy == null)

            @if ($article->authorId == Auth::id())
                <p>Спасибо!</p>
            @endif

            <p>Публикация отправлена на модерацию. Она появится в ленте как только будет проверена сотрудником сайта</p>
        @else

            @include('article.annotation')

            <div id="cut"></div>

            {!! $article->content !!}

            <hr />



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



@endsection
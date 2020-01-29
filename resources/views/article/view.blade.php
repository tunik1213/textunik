@extends('layouts.app')

@section('head')

    <title>{{$article->title}} / Text-уник</title>

    <meta name="description" content="{{$article->meta_description}}">
    <meta name="keywords" content="{{$article->meta_keywords}}">

    <script src="{{ asset('js/article.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.toc.min.js') }}"></script>

    <link href="{{ asset('css/article.css') }}" rel="stylesheet">

@endsection


@section('content')

    <div class="container col-md-9">
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

            <ul id="toc">
                <div id="toc-title">Содержание [<a id="toc-toggle" class="toc-visible" href="#">скрыть</a>]</div>

            </ul>

            <div class="article-text">
                {!! $article->content !!}
            </div>

            <hr/>

            @if($article->public())
                <div id="comments-container" article-id="{{$article->id}}">

                    <div class="md-form add-comment-form">
                        <i class="fas fa-pencil-alt prefix"></i>
                        <textarea id="form10" class="md-textarea form-control @guest restrict @endguest" rows="3"></textarea>
                        <label for="form10">Оставить комментарий</label>
                        <button class="post-comment btn btn-primary">Отправить</button>
                    </div>

                    <br>


                    <div id="comments-list"></div>

                </div>
            @endif


        </div>
    </div>


    <script type="text/javascript">
        $("#toc").toc({content: "div.article-text", headings: "h2,h3,h4"});
    </script>

@endsection
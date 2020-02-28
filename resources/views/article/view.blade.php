@extends('layouts.app')

@section('head')

    <title>{{$article->title}} / Text-уник</title>

    <meta name="description" content="{{$article->meta_description}}">
    <meta name="keywords" content="{{$article->meta_keywords}}">

    <script src="{{ asset('js/lib/jquery.toc.min.js') }}"></script>

@endsection


@section('content')

    <div class="container col-md-9 padding-0-phone">
        <div class="container col-md-12 article-content">

            @if (!$article->finished)

                <span class="badge badge-secondary">Черновик</span>

            @elseif (!$article->public())

                @if ($article->authorId == Auth::id())
                    <h1>Спасибо!</h1>
                    <span>Публикация отправлена на модерацию. Она появится в ленте как только будет проверена сотрудником сайта</span>
                @else
                    <span class="badge badge-warning">Модерация</span>
                @endif

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
                @include('article.social_share')

                <div id="comments-container" article-id="{{$article->id}}">

                    <div class="md-form add-comment-form">
                        <i class="fas fa-pencil-alt prefix"></i>
                        <textarea id="form10" class="md-textarea form-control @guest restrict @endguest"
                                  rows="3"></textarea>
                        <label for="form10" class="comment-placeholder">Оставить комментарий</label>
                        <button class="post-comment btn btn-primary">Отправить</button>
                    </div>

                    <br>


                    <div id="comments-list">
                        @include('article.comments',['comments'=>$comments])
                    </div>

                </div>
            @endif


        </div>
    </div>


    <script type="text/javascript">
        $("#toc").toc({content: "div.article-text", headings: "h2,h3,h4"});
    </script>

@endsection

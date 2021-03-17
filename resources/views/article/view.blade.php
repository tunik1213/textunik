@extends('layouts.app')

@section('head')

    <title>{{$article->title}} / Текст-уник</title>

    <meta name="description" content="{{$article->meta_description}}">
    <meta name="keywords" content="{{$article->meta_keywords}}">

    <script src="{{ asset('js/lib/jquery.toc.min.js') }}"></script>

@endsection

@section('markup')

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{$article->url()}}"
      },
      "headline": "{{$article->title}}",
      "description": "{{$article->meta_description}}",
      "image": "{{ asset($article->annotationImage()) }}",
      "author": {
        "@type": "Person",
        "name": "{{$article->author->name}}"
      },
      "publisher": {
        "@type": "Organization",
        "name": "textunik",
        "logo": {
          "@type": "ImageObject",
          "url": "https://textunik.com/images/textunik_logo.jpg"
        }
      },
      "datePublished": "{{$article->created_at}}",
      "dateModified": "{{$article->updated_at}}"
    }
    </script>

    <meta property="og:title" content="{{$article->title}}">
    <meta property="og:site_name" content="Text-уник">
    <meta property="og:url" content="{{$article->url()}}">
    <meta property="og:description" content="{{$article->meta_description}}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{ asset($article->annotationImage()) }}" />

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

            @if(preg_match('/<h\d/m', $article->content)) {{-- если есть заголовоки то есть смысл сгенерить содержание --}}
                <ul id="toc">
                    <div id="toc-title">Содержание [<a id="toc-toggle" class="toc-visible" href="#">скрыть</a>]</div>
                </ul>
            @endif

            @if($article->public())
                @include('ads.google')
            @endif

<br />

            <div class="article-text">
                {!! $article->content !!}
            </div>

            <hr/>

            @if($article->public())

                <div id="article-votes">
                    @include('article.voting',['object'=>$article])
                </div>

                    @include('article.social_share')

                <br />
                    <label>Оставить комментарий:</label>
                <div id="comments-container" article-id="{{$article->id}}">

                    <div id="comments-container-input">
                        {{-- здесь будет размещен редактор комментария --}}
                    </div>

                    <br />


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

    <div id="comment-input-sample" style="display:none">
        <div class="add-comment-form">
            <textarea class="form-control @guest restrict @endguest" rows="3"></textarea>
            <button class="post-comment btn btn-primary">Отправить</button>
        </div>
    </div>

@endsection

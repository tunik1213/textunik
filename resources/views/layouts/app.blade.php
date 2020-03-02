<!DOCTYPE html>
<html lang="ru">
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-22119625-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-22119625-3');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="MobileOptimized" content="320"/>
    <meta name="HandheldFriendly" content="true"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="theme-color" content="#041e42">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @if(env('APP_DEBUG'))
        <script src="{{ asset('js/lib/jquery.js') }}"></script>
        <script src="{{ asset('js/lib/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('js/lib/popper.min.js') }}"></script>
        <script src="{{ asset('js/lib/mdb.js') }}"></script>
        <script src="{{ asset('js/lib/jquery.jgrowl.js') }}"></script>
        <script src="{{ asset('js/engine.js') }}"></script>
        <script src="{{ asset('js/article.js') }}"></script>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/lib/mdb.css') }}" rel="stylesheet">
        <link href="{{ asset('css/lib/jquery.jgrowl.css') }}" rel="stylesheet">
        <link href="{{ asset('css/article.css') }}" rel="stylesheet">
    @else
        @include('layouts.production_asserts')
    @endif

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>

    @yield('head')
    @if( Request::is( Config::get('chatter.routes.home')) )
        <title>Форум копирайтеров / Текст-уник</title>
    @elseif( Request::is( Config::get('chatter.routes.home') . '/' . Config::get('chatter.routes.category') . '/*' ) && isset( $discussion ) )
        <title>{{ $discussion->category->name }} / форум копирайтеров Текст-уник</title>
    @elseif( Request::is( Config::get('chatter.routes.home') . '/*' ) && isset($discussion->title))
        <title>{{ $discussion->title }} / форум копирайтеров Текст-уник</title>
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    @yield('css')

    <link rel="shortcut icon" href="{{asset('/favicon.ico')}}">

</head>
<body>
<div id="app">
    <nav id="header" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container col-md-9">
            <a class="navbar-brand" href="{{ url('/') }}">
                <div id="logo1">TEXT</div>
                <div id="logo2">уник</div>
                <div id="logo3">уникальная информация</div>
                <div id="logo4">О КОПИРАЙТИНГЕ</div>
            </a>

            @include('home.right_header')

        </div>
    </nav>

    <main id="content" class="py-4">
        @yield('content')
    </main>

    <div id="scroll-top-button"><i class="fas fa-angle-up"></i></div>

    <nav id="footer" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container col-md-9">
            <ul class="footer-menu">
                <li>
                    <a href="/">Главная</a>
                </li>
                <li>
                    <a href="/about">О проекте</a>
                </li>
                <li>
                    <a href="/forums">Форум</a>
                </li>
                <li>
                    <a href="http://textunik.reformal.ru/" onclick="Reformal.widgetOpen();return false;" rel="nofollow" target="_blank">Оставить отзыв</a>
                </li>
            </ul>

            <div id="footer-text">
                <p>© {{date("Y")}}, при копировании материалов ссылка обязательна.</p>
                <p class="share-title display-desktop">Если Вы заметили ошибку на сайте, выделите ее и нажмите Ctrl+Enter, чтобы сообщить администрации</p>
            </div>
        </div>
    </nav>

</div>

@yield('js')

@if(Route::current() != null && Route::current()->getName() != 'article.edit')
    <script type="text/javascript">
        if($(window).width() > 1000) {
            var reformalOptions = {
                project_id: 983475,
                project_host: "textunik.reformal.ru",
                tab_orientation: "bottom-right",
                tab_indent: "10px",
                tab_bg_color: "#ffffff",
                tab_border_color: "#c45911",
                tab_image_url: "https://tab.reformal.ru/0J7RgdGC0LDQstC40YLRjCDQvtGC0LfRi9Cy/c45911/85536f1123cad72118e097a53f3de7d1/bottom-right/1/tab.png",
                tab_border_width: 1
            };

            (function () {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.async = true;
                script.src = 'https://media.reformal.ru/widgets/v3/reformal.js';
                document.getElementsByTagName('head')[0].appendChild(script);
            })();
        }
    </script><noscript><a href="http://reformal.ru"><img src="http://media.reformal.ru/reformal.png" /></a><a href="http://textunik.reformal.ru" rel="nofollow">Оставить отзыв</a></noscript>
@endif

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/lib/jquery.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('js/lib/mdb.js') }}"></script>
    <script src="{{ asset('js/engine.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/mdb.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    @yield('head')

    @guest
        <script src="{{ asset('js/guest.js') }}"></script>
    @endguest

    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>
<body>
    <div id="app">
        <nav id="header" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
{{--                                <a class="nav-link" href="{{ route('login') }}">Вход</a>--}}
                                <a class="nav-link" href="/login_form" rel="modal:open">Вход</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->moderator)
                                <a href="/moderation/" class="btn">Модерация</a>
                            @endif

                            <a href="/article/add/" class="btn">Написать</a>

                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nick_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">Личный кабинет</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main id="content" class="py-4">
            @yield('content')
        </main>


        <nav id="footer" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <ul class="footer-menu">
                <li>
                    <a href="/">Главная</a>
                </li>
                <li>
                    <a href="/about">О сайте</a>
                </li>
                <li>
                    <a href="http://natunik.net">Заказать статью</a>
                </li>
                <li>
                    <a href="/contacts">Контакты</a>
                </li>
                <li>
                    <a href="#reformal">Отзывы и предложения</a>
                </li>
                <li>
                    <a href="/forum">Форум</a>
                </li>
            </ul>

                <div id="footer-text">
                    <p>© {{date("Y")}}, при копировании материалов ссылка обязательна.</p>
                    <p>Если Вы заметили ошибку на сайте, пожалуйста,
                        <a href="mailto:falber77@gmail.com">сообщите нам</a>
                    </p>
                </div>
            </div>
        </nav>

    </div>
</body>
</html>

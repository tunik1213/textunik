@guest

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
        <i style="font-size: 1.5rem;" class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto">

            <li class="nav-item display-mobile" >
                <a class="nav-link" href="/about" id="mobile-header-about-link">О проекте</a>
            </li>

            <li class="nav-item">
                <noindex>
                <a href="{{ route('article.howto') }}" class="accurate-button write-article-button display-desktop" rel="nofollow">
                    <i class="fas fa-pencil-alt prefix"></i>
                    Написать статью
                </a>
                </noindex>
            </li>

            <li class="nav-item">
                <noindex><a class="nav-link waves-effect waves-light" href="{{route('login')}}">Вход</a></noindex>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
            </li>

        </ul>
    </div>


@else

    <a href="{{ route('article.edit') }}" class="write-article-button accurate-button display-desktop ml-auto">
        <i class="fas fa-pencil-alt prefix"></i>
        Написать статью
    </a>

    <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <img src="/user/getMiniAvatarImage" width="40" height="40"/>
        <span class="caret"></span>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

        <a href="{{ route('article.edit') }}" class="write-article-button accurate-button display-mobile ml-auto">
            <i class="fas fa-pencil-alt prefix"></i>
            Написать статью
        </a>

        <a class="dropdown-item" href="{{ route('home') }}">Мои настройки</a>

        <a class="dropdown-item" href="{{ route('profile', ['userId' => Auth::user()->id]) }}">Мой профиль</a>

        <a class="dropdown-item" href="/about">О проекте</a>

        <a class="dropdown-item" href="/policy" rel="nofollow">Редполитика</a>

        <a id="logout-link" class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>Выйти
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>
    </div>



@endguest

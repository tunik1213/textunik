@extends('layouts.app')
@section('head')
    <title>Текст-уник: о копирайтинге из опыта и знаний</title>
    <meta name="description"
          content="Полезный сайт для копирайтеров в формате коллективного блога. Уникальные статьи о копирайтинге для начинающих авторов и опытных копирайтеров. Здесь общаются и публикуются, чтобы делиться знаниями и продвигаться">
    <meta name="keywords" content="авторские статьи о копирайтинге">
@endsection

@section('content')
    <div class="container col-md-9 padding-0-phone">

        <div class="container col-xl-8 col-lg-12 feed">
            @include('article.list',['articles'=>$articles])

            <div class="ajax-load text-center" style="display:none">
                <p><img src="/images/ajax-loader.gif">Загрузка еще статей...</p>
            </div>
        </div>

        <div class="right-banner-container container col-xl-4 hidden-lg ">
            <div class="right-banner">

                <div class="right-banner-content">
                    <p class="title-secondary">О проекте</p>
                    <p>Этот сайт создан, чтобы выстраивать сообщество веб-райтеров и копирайтеров. Здесь вы сможете
                        размещать информационный, продающий, развлекательный контент и общаться, делиться знаниями и
                        продвигаться в профессии.</p>
                    <a href="/about">Подробнее</a>
                </div>

                <div class="right-banner-content">
                    <p class="title-secondary">Популярное</p>
                    <ul id="most-popular-tags">
                        @foreach(\App\Tag::mostPopular() as $tag)
                            <li>
                                <a class="popular-tag-link" href="{{route('tag',['tagslug'=>$tag->slug])}}"
                                   rel="nofollow">{{$tag->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

{{--                            <div class="right-banner-content">--}}
{{--                                <p class="text-main center">Словарь копирайтера</p>--}}
{{--                                <p><strong>Копирайтер</strong> – автор коммерческих текстов.</p>--}}
{{--                                <p><strong>Копирайтинг</strong> – разработка коммерческих текстов.</p>--}}
{{--                                <p><strong>Коммерческие тексты</strong> – информация о товаре или услуге, которая преподносит покупателю его выгоды от владения продуктом в разрезе его же потребностей. Тексты коммерческого характера носят рекламный характер и подталкивают клиента на целевое действие: заказать звонок, подписаться на рассылку, зарегистрироваться на сайте, купить товар и пр.</p>--}}
{{--                                <p><strong>Копирайт</strong> (copyright) – это НЕ продукт копирайтинга. Это значок авторского права ©. Чтобы знак набрать в Microsoft Windows, используйте Alt + 0169. Для Linux – Compose + o + c.</p>--}}
{{--                                <p><strong>Рерайтинг</strong> (rewriting) – перефразирование без потери смысла исходного текста в новый, который будет уникальным для поисковых систем. Процесс изменения текста напоминает написание школьного изложения.</p>--}}
{{--                                <p><strong>Рерайт&nbsp;</strong>(rewrite)– это результат рерайтинга. То есть, новый текст, который получился на выходе</p>--}}
{{--                                <p><strong>Веб-райтинг</strong> – создание информационных текстов для разных онлайн-ресурсов.</p>--}}
{{--                                <p><strong>Веб-райтер</strong> – фрилансер, который пишет информационные, обзорные, аналитические статьи для сайтов и этим зарабатывает себе на жизнь.</p>--}}
{{--                                <p><strong>Фриланс</strong>&nbsp;(freelance) – свободный вид занятости. То есть, вольнонаемный, внештатный. Фрилансить можно как в удаленном формате, так и в режиме офлайн. Практически всегда фриланс ассоциируется со способом зарабатывания в сети.</p>--}}
{{--                                <p><strong>Фрилансер&nbsp;</strong>– чаще всего, это внештатный специалист, специфика работы которого позволяет зарабатывать удаленно. Например, программист, дизайнер, копирайтер, маркетолог, переводчик, фотограф. Может быть как частное лицо, так и ИП.</p>--}}
{{--                                <p><strong>SEO&nbsp;</strong>– раскрутка сайта через его поисковую оптимизацию. Цель – привлечь из поисковых запросов на конкретный онлайн-ресурс как можно больше целевых посетителей.</p>--}}
{{--                                <p><strong>SEO-копирайтинг</strong> – создание текстов по особым правилам и под конкретные запросы поисковиков. Правильно построенные SEO-оптимизированные тексты продвигают сайт в поисковой выдаче. &nbsp;</p>--}}
{{--                                <p><strong>SEO-копирайтер</strong> – специалист по работе с SEO-текстами, который понимает смысл поисковой оптимизации и владеет техникой создания СЕО-текстов.</p>--}}
{{--                            </div>--}}

            </div>
        </div>
    </div>


    <script type="text/javascript">

        let current_url = new URL(window.location.href);
        let page = current_url.searchParams.get("page");
        if (!page) page = 1;

        let stopAjaxPagination = false;

        $(window).on('scroll', onScroll);

        function onScroll() {

            if (stopAjaxPagination) {
                return;
            }

            if ($(window).scrollTop() > $(document).height() - $(window).height() - 2000) {
                page++;
                ajaxPagination(page);
            }
        }

        function ajaxPagination(page) {
            $.ajax(
                {
                    url: '?page=' + page,
                    type: "get",
                    async: false,
                    beforeSend: function () {
                        $('.ajax-load').show();
                    }
                })
                .done(function (data) {
                    $('.ajax-load').hide();

                    if (data.html == "") {
                        stopAjaxPagination = true;
                        return;
                    }

                    $('.pagination').remove();
                    $(".feed").append(data.html);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log(thrownError);
                    stopAjaxPagination = true;
                });
        };
    </script>
@endsection

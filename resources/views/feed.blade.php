﻿@extends('layouts.app')
@section('head')

    <title>TEXT-уник: о копирайтинге из опыта и знаний</title>
    <meta name="description"
          content="Полезный сайт для копирайтеров в формате коллективного блога. Уникальные статьи о копирайтинге для начинающих авторов и опытных копирайтеров. Здесь общаются и публикуются, чтобы делиться знаниями и продвигаться">
    <meta name="keywords" content="авторские статьи о копирайтинге">
@endsection

@section('content')
    <div class="container col-md-9">

        <div class="container col-xl-8 col-lg-12 feed">
            @include('article.list',['articles'=>$articles])

            <div class="ajax-load text-center" style="display:none">
                <p><img src="/images/ajax-loader.gif">Загрузка еще статей...</p>
            </div>
        </div>

        <div class="container col-xl-4 hidden-lg right-banner">
            <div class="right-banner-content">
                <p>Нужен ценный совет из сферы копирайтинга? <a href="/forums">Заходите на форум!</a></p>
                <p>Наша площадка для комфортного общения копирайтеров.&nbsp;</p>
                <span class="expand-read-more" for="forums-invite">Подробнее&nbsp;<i class="fas fa-caret-down"></i></span>
                <div id="forums-invite">
                    <p>Социальные сети и мессенджеры – это хорошо. Но лишь на форуме копирайтеров вы получите ответы на
                        важные для вас темы, и при этом, если захотите, сохраните абсолютную анонимность.&nbsp;</p>
                    <p class="font-weight-bold">Хотите буквально за пару кликов решить сложную ситуацию?&nbsp;</p>
                    <p>Посетите форум копирайтеров и не стесняйтесь спрашивать – здесь все свои!&nbsp;</p>
                    <p>•&nbsp; &nbsp; Обсуждайте проблемы.</p>
                    <p>•&nbsp; &nbsp; Получайте поддержку.</p>
                    <p>•&nbsp; &nbsp; Ищите единомышленников.</p>
                    <p>•&nbsp; &nbsp; Обменивайтесь опытом.</p>
                    <p>•&nbsp; &nbsp; Проводите копирайтерский досуг с комфортом!&nbsp;</p>
                    <p>Захаживайте к нам на огонек, высказывайте свою точку зрения, получайте бесплатную помощь опытных
                        коллег. На нашем форуме приветствуются доброжелательность и тактичность в общении.&nbsp;</p>
                </div>

            </div>
            <div class="right-banner-content">
                <span class="text-main">Пожелания к статьям о копирайтинге: ЧТО и КАК писать</span>

                <p>Пишите статьи о копирайтинге и размещайте их на &laquo;TEXT-уник&raquo;!</p>
                <span class="expand-read-more" for="write-invite">Подробнее&nbsp;<i class="fas fa-caret-down"></i></span>
                <div id="write-invite">
                    <ul>
                        <li>Решили рассказать, как вы пишете тексты для разных рекламных целей?</li>
                        <li>Хотите сообщить, какими инструментами шлифуете статьи?</li>
                        <li>А может имеете смелость поведать о проколе и как ловко потом вышли из ситуации?</li>
                    </ul>
                    <p class="font-weight-bold">Пишите и публикуйтесь на «TEXT-уник»!</p>
                    <p class="text-main">Каким статьям будут рады пользователи</p>
                    <ol>
                        <li><strong>Полезным</strong></li>
                    </ol>
                    <p>Это могут быть практичные советы из личного опыта, ваши профессиональные взгляды, лайфхаки,
                        примеры, последние новости по теме или подборка источников, из которых черпаете вдохновение.</p>
                    <ol start="2">
                        <li><strong>Уникальным</strong></li>
                    </ol>
                    <p>Не копируйте чужое &ndash; пишите свое!</p>
                    <ol start="3">
                        <li><strong>Грамотным</strong></li>
                    </ol>
                    <p>Убирайте словесный мусор, вычищайте ошибки.</p>
                    <ol start="4">
                        <li><strong>Структурированным</strong></li>
                    </ol>
                    <p>Гораздо приятнее читать, когда есть подзаголовки, логичные блоки, списки.</p>
                    <ol start="5">
                        <li><strong>Эмоциональным</strong></li>
                    </ol>
                    <p>Чтобы статьи цепляли, вместо восклицательных знаков аккуратно и в меру добавьте живых эмоций.
                        Насытьте содержание интересными деталями.</p>
                    <h2>Ваша экспертность &ndash; это лучшая самореклама!</h2>
                    <p>Начинайте рассказывать о своих сильных сторонах прямо сейчас. Делитесь творческими практиками,
                        пишите статьи о копирайтинге с пользой и интересом &ndash;</p>
                    <p><strong>и получите просмотры, лайки, комментарии, подписки, <em>расшаривание</em> и заслуженный
                            пиар! </strong></p>
                    <h2>Темы, которые волнуют</h2>
                    <p>В интернете о копирайтинге информации много. Но наших читателей интересует конкретный опыт
                        коллег-копирайтеров:&nbsp;</p>
                    <ul>
                        <li>как вы развиваетесь и совершенствуетесь;</li>
                        <li>пробуете свои способы, экспериментируете;</li>
                        <li>исправляете оплошности, достигаете целей.</li>
                    </ul>
                    <p><strong>Пишите о том, что приносит вам радость. </strong></p>
                    <p><strong>Размышляйте, советуйте, делитесь болями и достижениями!&nbsp; </strong></p>

                </div>
            </div>

            <div class="right-banner-content">
                <p class="text-main center">Словарь копирайтера</p>
                <p><strong>Копирайтер</strong> – автор коммерческих текстов.</p>
                <p><strong>Копирайтинг</strong> – разработка коммерческих текстов.</p>
                <p><strong>Коммерческие тексты</strong> – информация о товаре или услуге, которая преподносит покупателю его выгоды от владения продуктом в разрезе его же потребностей. Тексты коммерческого характера носят рекламный характер и подталкивают клиента на целевое действие: заказать звонок, подписаться на рассылку, зарегистрироваться на сайте, купить товар и пр.</p>
                <p><strong>Копирайт</strong> (copyright) – это НЕ продукт копирайтинга. Это значок авторского права ©. Чтобы знак набрать в Microsoft Windows, используйте Alt + 0169. Для Linux – Compose + o + c.</p>
                <p><strong>Рерайтинг</strong> (rewriting) – перефразирование без потери смысла исходного текста в новый, который будет уникальным для поисковых систем. Процесс изменения текста напоминает написание школьного изложения.</p>
                <p><strong>Рерайт&nbsp;</strong>(rewrite)– это результат рерайтинга. То есть, новый текст, который получился на выходе</p>
                <p><strong>Веб-райтинг</strong> – создание информационных текстов для разных онлайн-ресурсов.</p>
                <p><strong>Веб-райтер</strong> – фрилансер, который пишет информационные, обзорные, аналитические статьи для сайтов и этим зарабатывает себе на жизнь.</p>
                <p><strong>Фриланс</strong>&nbsp;(freelance) – свободный вид занятости. То есть, вольнонаемный, внештатный. Фрилансить можно как в удаленном формате, так и в режиме офлайн. Практически всегда фриланс ассоциируется со способом зарабатывания в сети.</p>
                <p><strong>Фрилансер&nbsp;</strong>– чаще всего, это внештатный специалист, специфика работы которого позволяет зарабатывать удаленно. Например, программист, дизайнер, копирайтер, маркетолог, переводчик, фотограф. Может быть как частное лицо, так и ИП.</p>
                <p><strong>SEO&nbsp;</strong>– раскрутка сайта через его поисковую оптимизацию. Цель – привлечь из поисковых запросов на конкретный онлайн-ресурс как можно больше целевых посетителей.</p>
                <p><strong>SEO-копирайтинг</strong> – создание текстов по особым правилам и под конкретные запросы поисковиков. Правильно построенные SEO-оптимизированные тексты продвигают сайт в поисковой выдаче. &nbsp;</p>
                <p><strong>SEO-копирайтер</strong> – специалист по работе с SEO-текстами, который понимает смысл поисковой оптимизации и владеет техникой создания СЕО-текстов.</p>
            </div>

        </div>
    </div>


    <script type="text/javascript">

        let current_url = new URL(window.location.href);
        let page = current_url.searchParams.get("page");
        if (!page) page=1;

        let stopAjaxPagination = false;

        $(window).on('scroll', onScroll);

        function onScroll() {

             if (stopAjaxPagination) {
                 return;
             }

             if ($(window).scrollTop() >  $(document).height() - $(window).height() - 2000) {
                 page++;
                 ajaxPagination(page);
             }
        }

        function ajaxPagination(page) {
            $.ajax(
                {
                    url: '?page=' + page,
                    type: "get",
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

                    });
            };
    </script>
@endsection
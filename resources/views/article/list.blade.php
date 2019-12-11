<div class="container article-content col-md-12">

    @if ($articles->count() == 0)
        <span>Нет публикаций</span>
    @endif

    @foreach ($articles as $article)

        @include('article.annotation')
        <br/>

        @if(!empty(trim($article->content)) && $article->public())
            <a class="accurate-button read-next-link" href="{{$article->url()}}#cut"><span>Читать дальше →</span></a>
        @endif

        <br>
    @endforeach

    {{ $articles->links() }}

</div>
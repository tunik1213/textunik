<div class="container article-content col-md-12">

    @foreach ($articles as $article)

        @include('article.annotation')
        <br/>

        @if(!empty(trim($article->content)))
            <a href="{{$article->url()}}#cut">Читать дальше →</a>
        @endif

        <br>
    @endforeach

    {{ $articles->links() }}

</div>
<div class="container">

    @foreach ($articles as $article)

        <div class="container col-md-8 article-content">
            @include('article.annotation')
            <br/>

            @if(!empty(trim($article->content)))
                <a href="{{$article->url()}}#cut">Читать дальше →</a>
            @endif

        </div>

        <br>
    @endforeach

    {{ $articles->links() }}

</div>
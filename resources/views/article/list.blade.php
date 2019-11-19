<div class="container">

    @foreach ($articles as $article)

        <div class="container">
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
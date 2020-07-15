@if($articles->count()>0)
    <div class="container article-content col-md-12">

        @foreach ($articles as $article)

            @include('article.annotation',['titleTag' =>'h2'])
            <br/>

            @if(!empty(trim($article->content)) && $article->public())
                <a class="accurate-button read-next-link"
                   href="{{$article->url()}}#cut"><span>Читать дальше →</span></a>
            @endif

            <br>
        @endforeach

    </div>
@endif

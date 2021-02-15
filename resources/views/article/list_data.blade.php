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

            @if($loop->index == 0)
                <div  class="display-tablet ">
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-9397290056752587"
                     data-ad-slot="2170069470"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                </div>
            @endif

            @if($loop->index == 1)
    </div>
                <div class="display-tablet container quiz-banner">
                    <div class="quiz-header">
                        <span>Делаете ли вы эти ошибки?</span>
                    </div>

                    <div class="quiz-container" >

                    </div>

                </div>

    <div class="container article-content col-md-12">

            @endif

        @endforeach

    </div>
@endif

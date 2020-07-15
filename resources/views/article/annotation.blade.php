@php
    $author = $article->author;
    $titleTag = $titleTag ?? 'h1';
@endphp


<div class="article-author">
    @include('home.user_link',['user'=>$author])
    <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($article->created_at))->diffForHumans() }}</span>

    @if($article->canEdit())
        | <a class="red-text font-weight-bold" href="{{route('article.edit',['id'=>$article->id])}}">Редактировать</a>
    @endif

    @php($commentsCount = $article->comments()->count())
    @if($commentsCount > 0)
        <a class="article-comments-count" href="{{$article->url()}}#comments-list" rel="nofollow"
           title="{{(string)$commentsCount.' '.nouns_declension($commentsCount,'комментарий','комментария','комментариев')}}">
            <i class="far fa-comment">&nbsp;{{$commentsCount}}</i>
        </a>
    @endif
</div>


<{{$titleTag}}><a class="article-title" href="{{$article->url()}}">{{ $article->title }}</a></{{$titleTag}}>

<div class="article-annotation">
    {!! $article->annotation !!}
</div>

@php
    $author = $article->author
@endphp


<div class="article-author">
    <img src="/user/getMiniAvatarImage/{{$author->id}}" width="30" height="30">
    <a class="author-profile-link" author-id="{{$author->id}}" href="{{$author->profile_url()}}">{{$author->displayName()}}</a>
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


<h1><a href="{{$article->url()}}">{{ $article->title }}</a></h1>

<div class="article-annotation">
    {!! $article->annotation !!}
</div>

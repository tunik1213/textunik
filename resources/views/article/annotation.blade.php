@php
    $author = $article->author;
@endphp


<div class="article-author">
    <img src="/user/getMiniAvatarImage/{{$author->id}}" width="30" height="30">
    <a href="{{$author->profile_url()}}">{{$author->nick_name}}</a>
    <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($article->created_at))->diffForHumans() }}</span>

    @if($article->canEdit())
        | <a class="red-text font-weight-bold" href="{{route('article.edit',['id'=>$article->id])}}">Редактировать</a>
    @endif
</div>


<h1><a href="{{$article->url()}}">{{ $article->title }}</a></h1>

<div class="article-annotation">
    {!! $article->annotation !!}
</div>

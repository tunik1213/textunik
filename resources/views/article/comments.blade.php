@php
    $articleAuthor = null;
    if (isset($article)) $articleAuthor = $article->author ?? null;
@endphp

@foreach ($comments as $comment)

    @php($author = $comment->author)

    <div class="comment" comment-id="{{$comment->id}}" id="comment{{$comment->id}}">
        <div class="comment-header">
            <div @if($author==$articleAuthor)class="author-comment"@endif>
            @include('home.user_link',['user'=>$author])
            <span class="nowrap">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}</span>
            @if(!($suppressRecursion ?? false))
                @if($comment->canEdit())
                    <a href="#" class="edit-comment-link"><i class="fas fa-pencil-alt prefix"></i>редактировать</a>
                @endif
            @endif
            </div>
        </div>
        <div class="comment-content">
            <span> {!! html_entity_decode($comment->text) !!}</span>
        </div>

        @if (!($suppressRecursion ?? false))

            @include('article.voting',['object'=>$comment])

            <div class="comment-bottom-nav">
                <a href="#" class="comment-response @guest restrict @endguest">Ответить</a>
            </div>

            <div class="comment-children">
                @if($comment->children->count() > 0)
                    @include('article.comments',['comments'=>$comment->children])
                @endif
            </div>
        @else
            @php($article = $comment->article)
            Статья: <a href="{{$article->url()}}">{{ $article->title }}</a>
        @endif
    </div>
@endforeach

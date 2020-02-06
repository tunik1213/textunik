@foreach ($comments as $comment)

    @php($author = $comment->author)

    <div class="comment" comment-id="{{$comment->id}}">
        <div class="comment-header">
            @include('home.user_link',['user'=>$author])
            <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}</span>
        </div>
        <div class="comment-content">
            <span>{!! $comment->text !!}</span>
        </div>

        @if (!($suppressRecursion ?? false))
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

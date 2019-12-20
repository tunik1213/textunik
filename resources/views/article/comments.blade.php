@foreach ($comments as $comment)

    @php($author = $comment->author)

    <div class="comment" comment-id="{{$comment->id}}">
        <div class="comment-header">
            <img src="/user/getMiniAvatarImage/{{$author->id}}" width="30" height="30" >
            <a href="{{$author->profile_url()}}">{{$author->displayName()}}</a>
            <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}</span>
        </div>
        <div class="comment-content">
            <span>{{ $comment->text }}</span>
        </div>
        <div class="comment-bottom-nav">
            <a href="#" class="comment-response">Ответить</a>
        </div>

        <div class="container comment-children">
        @if($comment->children->count() > 0)
                @include('article.comments',['comments'=>$comment->children])
        @endif
        </div>
    </div>
@endforeach

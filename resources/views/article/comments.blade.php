@foreach ($comments as $comment)

    @php($author = $comment->author)

    <div class="comment" comment-id="{{$comment->id}}">
        <div class="comment-header">
            <img class="user-mini-avatar" src="/user/getMiniAvatarImage/{{$author->id}}" width="30" height="30" >
            <a href="{{$author->profile_url()}}" class="author-profile-link" author-id="{{$author->id}}">{{$author->displayName()}}</a>
            <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}</span>
        </div>
        <div class="comment-content">
            <span>{!! $comment->text !!}</span>
        </div>
        <div class="comment-bottom-nav">
            <a href="#" class="comment-response @guest restrict @endguest">Ответить</a>
        </div>

        <div class="comment-children">
        @if($comment->children->count() > 0)
                @include('article.comments',['comments'=>$comment->children])
        @endif
        </div>
    </div>
@endforeach

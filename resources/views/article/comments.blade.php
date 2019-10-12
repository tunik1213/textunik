@foreach ($comments as $comment)

    @php($author = $comment->author)

    <div class="comment">
        <div class="comment-header">
            <img src="/user/getMiniAvatarImage/{{$author->id}}" width="30" height="30" >
            <a href="{{$author->profile_url()}}">{{$author->nick_name}}</a>
            <span>{{$comment->created_at}}</span>
        </div>
        <div class="comment-content">
            <span>{{ $comment->text }}</span>
        </div>
    </div>
@endforeach
<h1>Отчет за {{$report_dt->format('d.m.Y')}}</h1>

<p>
    Новые пользователи: {{$new_users->count()}} <br/>
    @foreach($new_users as $user)
        @include('home.user_link',['user'=>$user]); <br/>
    @endforeach
</p>

<p>
    Новые комментарии: {{$new_comments->count()}} <br/>
    @include('article.comments',['comments'=>$new_comments, 'suppressRecursion'=>true])
</p>

<p>
    Статьи, ожидающие модерацию: {{$moderation->count()}} <br/>
    @foreach($moderation as $article)
        <a href="{{$article->url()}}">{{ $article->title }}</a> <br/>
    @endforeach
</p>

<p>
    Неопубликованные черновики: {{$drafts->count()}} <br/>
    @foreach($drafts as $article)
        <a href="{{$article->url()}}">{{ $article->title }}</a> <br/>
    @endforeach
</p>

<hr/>

<p>
    Использовано места на диске - <b>{{$disk_usage_percent}}%</b>
</p>
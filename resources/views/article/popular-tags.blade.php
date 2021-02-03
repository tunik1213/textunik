<ul id="most-popular-tags">
    <li><a class="popular-tag-link" href="/tag/miniatjura-dlja-dushi">Миниатюра для души</a></li>
    <li><a class="popular-tag-link" href="/tag/perly">Перлы</a></li>
    @foreach(\App\Tag::mostPopular() as $tag)
        <li>
            <a class="popular-tag-link" href="{{route('tag',['tagslug'=>$tag->slug])}}"
               rel="nofollow">{{$tag->name}}</a>
        </li>
    @endforeach
</ul>

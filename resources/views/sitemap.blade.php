{{ Request::header('Content-Type : text/xml') }}
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ url( '/' ) }}</loc>
        <lastmod>{{$articles->first()->updated_at->tz('GMT')->toAtomString()}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>

    <url>
        <loc>{{ url( '/about' ) }}</loc>
        <lastmod>2019-11-19T06:04:41+00:00</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    
    @foreach ($articles as $article)
        <url>
            <loc>{{ url( '/article/'.$article->id) }}</loc>
            <lastmod>{{ $article->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach

    <url>
        <loc>{{ url( '/forums' ) }}</loc>
        <lastmod>2019-11-19T06:04:41+00:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>

    @foreach ($forum_categories as $category)
        <url>
            <loc>{{ url( '/forums/category/'.$category->slug) }}</loc>
            <lastmod>{{ $category->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    @foreach ($forum_discussions as $discussion)
        <url>
            <loc>{{ url( '/forums/discussion/'.$discussion->category->slug.'/'.$discussion->slug) }}</loc>
            <lastmod>{{ $discussion->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach


</urlset>
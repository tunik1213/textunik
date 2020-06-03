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
            <loc>{{ url( $article->url()) }}</loc>
            <lastmod>{{ $article->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach

    @foreach($authors as $author)
        <url>
            <loc>{{ url( '/profile/'.$author->id )}}</loc>
            <lastmod>{{ $author->lastmod->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.3</priority>
        </url>
    @endforeach

</urlset>

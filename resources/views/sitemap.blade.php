{{ Request::header('Content-Type : text/xml') }}
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ url( '/' ) }}</loc>
        <lastmod>{{$articles->first()->updated_at->tz('GMT')->toAtomString()}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
    
{{--    TODO статические страницы--}}

    @foreach ($articles as $article)
        <url>
            <loc>{{ url( '/article/'.$article->id) }}</loc>
            <lastmod>{{ $article->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach
</urlset>
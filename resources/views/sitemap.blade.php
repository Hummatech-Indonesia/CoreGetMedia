<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>2024-03-08T00:00:00+00:00</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    @foreach ($newsData as $news)
        <url>
            <loc>{{ url("/news/{$news->slug}") }}</loc>
            <lastmod>{{ $news->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

</urlset>

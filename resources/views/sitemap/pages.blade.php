<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($pages as $page)
    <url>
        <loc>{{ route('user.post.show', [$page->slug]) }}</loc>
        <lastmod>{{ $page->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
@endforeach
    <url>
        <loc>{{ route('car') }}</loc>
        <lastmod>2021-10-05T18:18:44+00:00</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('user.post.index') }}</loc>
        <lastmod>2021-11-04T18:18:44+00:00</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>2021-11-18T18:18:44+00:00</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
</urlset>

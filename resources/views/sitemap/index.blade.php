<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ url('sitemap/cars') }}</loc>
        <lastmod>{{ $cars->updated_at->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap/metas') }}</loc>
        <lastmod>{{ $metas->updated_at->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap/pages') }}</loc>
        <lastmod>2021-10-05T18:18:44+00:00</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap/places') }}</loc>
        <lastmod>{{ $places->updated_at->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap/posts') }}</loc>
        <lastmod>{{ $posts->updated_at->toAtomString() }}</lastmod>
    </sitemap>
</sitemapindex>

<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($places as $place)
        <url>
            <loc>{{ route('page-place', [$place->slug]) }}</loc>
            <lastmod>{{ $place->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
</urlset>

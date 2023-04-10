<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($metas as $meta)
        <url>
            <loc>{{ route('meta.show', [$meta->type, $meta->slug]) }}</loc>
            <lastmod>{{ $meta->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
</urlset>

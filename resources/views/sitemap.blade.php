<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ furl() }}</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
@foreach ($groups as $group)
    <url>
        <loc>{{ furl("group/{$group->slug}") }}</loc>
        <changefreq>monthly</changefreq>
        <lastmod>{{ $group->updated_at->format('Y-m-d\TH:i:s+03:30') }}</lastmod>
        <priority>1</priority>
    </url>
@endforeach
</urlset>
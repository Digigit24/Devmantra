<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- ── Static pages ──────────────────────────────────────────────────── --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>{{ url('/about') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/contact') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/blog') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/newsletter') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/reports') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/case-study') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/alert') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/events') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc>{{ url('/careers') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc>{{ url('/privacy-policy') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.30</priority>
    </url>
    <url>
        <loc>{{ url('/india-europe-benchmarking-calculator') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>

    {{-- ── Services ───────────────────────────────────────────────────────── --}}
    @foreach($services as $service)
    <url>
        <loc>{{ url('/services/' . $service->slug) }}</loc>
        <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.90</priority>
    </url>
    @endforeach

    {{-- ── Blog posts ──────────────────────────────────────────────────────── --}}
    @foreach($blogs as $blog)
    <url>
        <loc>{{ url('/blog/' . $blog->slug) }}</loc>
        <lastmod>{{ $blog->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    @endforeach

    {{-- ── Case studies ────────────────────────────────────────────────────── --}}
    @foreach($caseStudies as $caseStudy)
    <url>
        <loc>{{ url('/case-study/' . $caseStudy->slug) }}</loc>
        <lastmod>{{ $caseStudy->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    @endforeach

    {{-- ── Reports ─────────────────────────────────────────────────────────── --}}
    @foreach($reports as $report)
    <url>
        <loc>{{ url('/reports/' . $report->slug) }}</loc>
        <lastmod>{{ $report->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    @endforeach

    {{-- ── Newsletters ─────────────────────────────────────────────────────── --}}
    @foreach($newsletters as $newsletter)
    <url>
        <loc>{{ url('/newsletter/' . $newsletter->slug) }}</loc>
        <lastmod>{{ $newsletter->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.60</priority>
    </url>
    @endforeach

    {{-- ── Alerts ──────────────────────────────────────────────────────────── --}}
    @foreach($alerts as $alert)
    <url>
        <loc>{{ url('/alert/' . $alert->slug) }}</loc>
        <lastmod>{{ $alert->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.60</priority>
    </url>
    @endforeach

    {{-- ── Events ──────────────────────────────────────────────────────────── --}}
    @foreach($events as $event)
    <url>
        <loc>{{ url('/events/' . $event->slug) }}</loc>
        <lastmod>{{ $event->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.60</priority>
    </url>
    @endforeach

    {{-- ── Careers ─────────────────────────────────────────────────────────── --}}
    @foreach($careers as $career)
    <url>
        <loc>{{ url('/careers/' . $career->slug) }}</loc>
        <lastmod>{{ $career->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.60</priority>
    </url>
    @endforeach

</urlset>

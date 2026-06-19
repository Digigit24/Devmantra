<?php

namespace App\Services;

use App\Models\ContactSetting;
use App\Models\SiteSetting;

/**
 * Generates JSON-LD schema markup for structured data.
 * Each method returns a <script type="application/ld+json"> string
 * ready for injection into <head> via @stack('schema').
 */
class SchemaService
{
    // ── Internal helpers ─────────────────────────────────────────────────

    private static function wrap(array $schema): string
    {
        return '<script type="application/ld+json">' . "\n"
            . json_encode(
                array_filter($schema, fn($v) => $v !== null && $v !== '' && $v !== []),
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
            )
            . "\n</script>";
    }

    private static function siteUrl(): string
    {
        return rtrim(SiteSetting::get('schema_website_url') ?: config('app.url'), '/');
    }

    private static function companyName(): string
    {
        return SiteSetting::get('schema_company_name') ?: 'DevMantra';
    }

    private static function logoUrl(): string
    {
        return SiteSetting::get('schema_logo_url', '');
    }

    /** Resolves an image to an absolute URL from og_image or featured_image. */
    private static function resolveImage($model): ?string
    {
        if (!empty($model->og_image)) {
            return str_starts_with($model->og_image, 'http')
                ? $model->og_image
                : self::siteUrl() . '/' . ltrim($model->og_image, '/');
        }
        if (!empty($model->featured_image)) {
            return asset('storage/' . $model->featured_image);
        }
        return null;
    }

    /** Resolves a description string from meta_description, excerpt, or content. */
    private static function resolveDescription($model): ?string
    {
        $raw = $model->meta_description
            ?? $model->excerpt
            ?? (property_exists($model, 'short_description') ? $model->short_description : null)
            ?? null;
        if ($raw === null) return null;
        return mb_substr(trim(strip_tags($raw)), 0, 300);
    }

    // ── Organization ─────────────────────────────────────────────────────

    public static function organization(): string
    {
        $contact = ContactSetting::instance();
        $logo    = self::logoUrl();

        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => ['Organization', 'FinancialService'],
            'name'        => self::companyName(),
            'legalName'   => 'Dev Mantra Financial Services',
            'url'         => self::siteUrl(),
            'logo'        => $logo ? [
                '@type'  => 'ImageObject',
                'url'    => $logo,
            ] : null,
            'description' => 'Audit-grade, CA-led India execution partner for cross-border M&A, India entry / FDI structuring, Virtual CFO, and GCC setup. ₹5,000 Cr+ transactions advised; 20+ years of cross-border execution.',
            'foundingDate' => '2008',
            'areaServed'   => ['India', 'Worldwide'],
            'knowsAbout'   => [
                'Mergers and Acquisitions',
                'Cross-border M&A',
                'India entry and FDI structuring',
                'Virtual CFO services',
                'Global Capability Centers (GCC)',
                'IPO advisory',
                'DTAA and treaty structuring',
                'Corporate governance',
                'Transfer pricing',
                'GIFT City',
            ],
            'founder'     => [
                '@type' => 'Person',
                'name'  => 'CA Nidhi Tatia',
                'jobTitle' => 'Founder Director',
            ],
            'address'     => $contact->address ? [
                '@type'           => 'PostalAddress',
                'streetAddress'   => $contact->address,
                'addressLocality' => 'Bengaluru',
                'addressRegion'   => 'Karnataka',
                'addressCountry'  => 'IN',
            ] : [
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Bengaluru',
                'addressRegion'   => 'Karnataka',
                'addressCountry'  => 'IN',
            ],
            'sameAs'   => array_values(array_filter([
                $contact->facebook_url  ?? null,
                $contact->twitter_url   ?? null,
                $contact->linkedin_url  ?? null,
                $contact->instagram_url ?? null,
            ])) ?: null,
            'contactPoint' => ($contact->email || $contact->phone) ? array_filter([
                '@type'       => 'ContactPoint',
                'telephone'   => $contact->phone   ?? null,
                'email'       => $contact->email    ?? null,
                'contactType' => 'customer service',
            ]) : null,
        ];

        return self::wrap($schema);
    }

    // ── LocalBusiness ─────────────────────────────────────────────────────

    public static function localBusiness(): string
    {
        $contact = ContactSetting::instance();
        $logo    = self::logoUrl();

        $schema = [
            '@context'  => 'https://schema.org',
            '@type'     => 'LocalBusiness',
            'name'      => self::companyName(),
            'url'       => self::siteUrl(),
            'image'     => $logo ?: null,
            'telephone' => $contact->phone    ?: null,
            'email'     => $contact->email    ?: null,
            'address'   => $contact->address ? [
                '@type'         => 'PostalAddress',
                'streetAddress' => $contact->address,
            ] : null,
            'openingHours' => $contact->office_hours ?: null,
            'sameAs'   => array_values(array_filter([
                $contact->facebook_url  ?? null,
                $contact->twitter_url   ?? null,
                $contact->linkedin_url  ?? null,
                $contact->instagram_url ?? null,
            ])) ?: null,
        ];

        return self::wrap($schema);
    }

    // ── Generic Article (Blog, CaseStudy, Report, Newsletter) ────────────

    /**
     * @param  mixed  $article  Any model with title, url, published_at, updated_at
     * @param  string $type     Schema.org type: BlogPosting, Article, Report, etc.
     */
    public static function articleSchema($article, string $type = 'Article'): string
    {
        $name    = self::companyName();
        $logo    = self::logoUrl();
        $image   = self::resolveImage($article);
        $desc    = self::resolveDescription($article);

        $schema = [
            '@context'      => 'https://schema.org',
            '@type'         => $type,
            'headline'      => $article->meta_title ?: $article->title,
            'description'   => $desc,
            'url'           => $article->url,
            'image'         => $image ? ['@type' => 'ImageObject', 'url' => $image] : null,
            'datePublished' => $article->published_at?->toIso8601String(),
            'dateModified'  => $article->updated_at->toIso8601String(),
            'author'    => ['@type' => 'Organization', 'name' => $name, 'url' => self::siteUrl()],
            'publisher' => array_filter([
                '@type' => 'Organization',
                'name'  => $name,
                'url'   => self::siteUrl(),
                'logo'  => $logo ? ['@type' => 'ImageObject', 'url' => $logo] : null,
            ]),
        ];

        return self::wrap($schema);
    }

    // ── Typed convenience wrappers ────────────────────────────────────────

    public static function blogSchema($blog): string
    {
        return self::articleSchema($blog, 'BlogPosting');
    }

    public static function caseStudySchema($caseStudy): string
    {
        return self::articleSchema($caseStudy, 'Article');
    }

    public static function reportSchema($report): string
    {
        return self::articleSchema($report, 'Report');
    }

    public static function newsletterSchema($newsletter): string
    {
        return self::articleSchema($newsletter, 'Article');
    }

    // ── Service ───────────────────────────────────────────────────────────

    public static function serviceSchema($service): string
    {
        $name  = self::companyName();
        $logo  = self::logoUrl();
        $image = self::resolveImage($service);
        if (!$image && !empty($service->hero_image)) {
            $image = asset('storage/' . $service->hero_image);
        }
        if (!$image && !empty($service->image)) {
            $image = asset('storage/' . $service->image);
        }

        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            'name'        => $service->meta_title ?: $service->title,
            'description' => self::resolveDescription($service),
            'url'         => $service->url,
            'image'       => $image,
            'provider'    => array_filter([
                '@type' => 'Organization',
                'name'  => $name,
                'url'   => self::siteUrl(),
                'logo'  => $logo ? ['@type' => 'ImageObject', 'url' => $logo] : null,
            ]),
            'areaServed'  => SiteSetting::get('schema_area_served') ?: 'Worldwide',
        ];

        return self::wrap($schema);
    }

    // ── FAQ ───────────────────────────────────────────────────────────────

    /**
     * @param  array  $faqs  [['question' => '...', 'answer' => '...'], ...]
     */
    public static function faqSchema(array $faqs): string
    {
        $entities = [];
        foreach ($faqs as $item) {
            if (empty($item['question']) || empty($item['answer'])) continue;
            $entities[] = [
                '@type'          => 'Question',
                'name'           => $item['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['answer']],
            ];
        }

        return self::wrap([
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $entities,
        ]);
    }

    // ── BreadcrumbList ────────────────────────────────────────────────────

    /**
     * @param  array  $items  [['name' => '...', 'url' => '...'], ...]
     *                        URL may be absolute or root-relative.
     *                        Last item url can be omitted.
     */
    public static function breadcrumb(array $items): string
    {
        $base     = self::siteUrl();
        $elements = [];

        foreach ($items as $pos => $item) {
            $element = [
                '@type'    => 'ListItem',
                'position' => $pos + 1,
                'name'     => $item['name'],
            ];
            if (!empty($item['url'])) {
                $url = $item['url'];
                $element['item'] = str_starts_with($url, 'http')
                    ? $url
                    : $base . '/' . ltrim($url, '/');
            }
            $elements[] = $element;
        }

        return self::wrap([
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $elements,
        ]);
    }
}

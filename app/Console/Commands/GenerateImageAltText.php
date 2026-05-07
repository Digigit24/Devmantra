<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\ImageMeta;
use App\Models\Newsletter;
use App\Models\Report;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GenerateImageAltText extends Command
{
    protected $signature = 'images:generate-alt
                            {--force : Overwrite existing alt text}
                            {--dry-run : Preview what would be written without saving}
                            {--batch=10 : Images per API call}';

    protected $description = 'Generate SEO-optimised alt text for all content images using Grok AI';

    private string $apiKey = '';
    private bool $hasApi   = false;

    public function handle(): int
    {
        $this->apiKey = config('services.grok.key', env('GROK_API_KEY', ''));
        $this->hasApi = !empty($this->apiKey);

        if (!$this->hasApi) {
            $this->warn('GROK_API_KEY not set — using context-based fallback (no AI calls).');
            $this->warn('Add GROK_API_KEY=your-key to .env to enable Grok-generated alt text.');
            $this->newLine();
        }

        $force  = $this->option('force');
        $dryRun = $this->option('dry-run');
        $batch  = (int) $this->option('batch');

        $items = $this->collectImages();

        if (empty($items)) {
            $this->info('No images found to process.');
            return 0;
        }

        $this->info(sprintf('Found %d images across all content.', count($items)));

        if (!$force) {
            $items = array_filter($items, fn($item) => empty($item['existing_alt']));
            $this->info(sprintf('%d without existing alt text (use --force to overwrite all).', count($items)));
        }

        if (empty($items)) {
            $this->info('All images already have alt text. Done.');
            return 0;
        }

        if ($dryRun) {
            $this->warn('[dry-run] No changes will be saved.');
        }

        $items   = array_values($items);
        $batches = array_chunk($items, $batch);
        $saved   = 0;

        foreach ($batches as $i => $chunk) {
            $this->line(sprintf('  Processing batch %d/%d (%d images)…', $i + 1, count($batches), count($chunk)));

            $results = $this->hasApi
                ? $this->generateViaApi($chunk)
                : $this->generateViaFallback($chunk);

            foreach ($results as $res) {
                $alt = trim($res['alt'] ?? '');
                if (!$alt) continue;

                $alt = $this->sanitiseAlt($alt);

                $this->line(sprintf('    <fg=green>✓</> %s', $res['rel_path']));
                $this->line(sprintf('      <fg=cyan>"%s"</>', $alt));

                if (!$dryRun) {
                    ImageMeta::updateOrCreate(
                        ['rel_path' => $res['rel_path']],
                        ['alt_text' => $alt, 'alt_text_suggestion' => $alt]
                    );
                    $saved++;
                }
            }
        }

        $this->newLine();
        $this->info(sprintf('Done. %d alt texts %s.', $saved, $dryRun ? 'would be saved' : 'saved'));
        return 0;
    }

    // ── Image collection ────────────────────────────────────────────────────

    private function collectImages(): array
    {
        $items = [];

        // Blogs
        foreach (Blog::whereNotNull('featured_image')->where('featured_image', '!=', '')->get() as $blog) {
            if ($rel = $this->toRelPath($blog->featured_image)) {
                $items[$rel] = [
                    'rel_path'     => $rel,
                    'type'         => 'blog',
                    'title'        => $blog->title,
                    'excerpt'      => $blog->excerpt ?? '',
                    'category'     => $blog->category ?? '',
                    'description'  => $blog->meta_description ?? '',
                    'existing_alt' => $this->existingAlt($rel),
                ];
            }
            if ($og = $this->toRelPath($blog->og_image ?? '')) {
                $items[$og] = [
                    'rel_path'     => $og,
                    'type'         => 'blog',
                    'title'        => $blog->title,
                    'excerpt'      => $blog->excerpt ?? '',
                    'category'     => $blog->category ?? '',
                    'description'  => $blog->meta_description ?? '',
                    'existing_alt' => $this->existingAlt($og),
                ];
            }
        }

        // Services
        $imageFields = ['featured_image', 'image', 'hero_image', 'icon', 'og_image'];
        foreach (Service::get() as $svc) {
            foreach ($imageFields as $field) {
                if ($rel = $this->toRelPath($svc->$field ?? '')) {
                    $items[$rel] = [
                        'rel_path'    => $rel,
                        'type'        => 'service',
                        'title'       => $svc->title,
                        'excerpt'     => $svc->short_description ?? '',
                        'category'    => '',
                        'description' => $svc->meta_description ?? '',
                        'field'       => $field,
                        'existing_alt'=> $this->existingAlt($rel),
                    ];
                }
            }
        }

        // Newsletters
        foreach (Newsletter::whereNotNull('featured_image')->where('featured_image', '!=', '')->get() as $nl) {
            if ($rel = $this->toRelPath($nl->featured_image)) {
                $items[$rel] = [
                    'rel_path'     => $rel,
                    'type'         => 'newsletter',
                    'title'        => $nl->title,
                    'excerpt'      => $nl->excerpt ?? '',
                    'category'     => $nl->edition_label ?? '',
                    'description'  => $nl->meta_description ?? '',
                    'existing_alt' => $this->existingAlt($rel),
                ];
            }
        }

        // Reports
        foreach (Report::whereNotNull('featured_image')->where('featured_image', '!=', '')->get() as $rpt) {
            if ($rel = $this->toRelPath($rpt->featured_image)) {
                $items[$rel] = [
                    'rel_path'     => $rel,
                    'type'         => 'report',
                    'title'        => $rpt->title,
                    'excerpt'      => $rpt->excerpt ?? '',
                    'category'     => $rpt->edition_label ?? '',
                    'description'  => $rpt->meta_description ?? '',
                    'existing_alt' => $this->existingAlt($rel),
                ];
            }
        }

        // Case studies (future-proof)
        foreach (CaseStudy::whereNotNull('featured_image')->where('featured_image', '!=', '')->get() as $cs) {
            if ($rel = $this->toRelPath($cs->featured_image)) {
                $items[$rel] = [
                    'rel_path'     => $rel,
                    'type'         => 'case-study',
                    'title'        => $cs->title,
                    'excerpt'      => $cs->excerpt ?? '',
                    'category'     => '',
                    'description'  => $cs->meta_description ?? '',
                    'existing_alt' => $this->existingAlt($rel),
                ];
            }
        }

        return array_values($items);
    }

    // ── API generation ──────────────────────────────────────────────────────

    private function generateViaApi(array $items): array
    {
        $payload = array_map(fn($item, $idx) => [
            'id'          => $idx,
            'type'        => $item['type'],
            'title'       => $item['title'],
            'excerpt'     => Str::limit($item['excerpt'], 200),
            'category'    => $item['category'],
            'description' => Str::limit($item['description'], 150),
        ], $items, array_keys($items));

        $prompt = $this->buildPrompt($payload);

        try {
            // Grok uses the OpenAI-compatible API format
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->timeout(60)->post('https://api.x.ai/v1/chat/completions', [
                'model'      => 'grok-3-mini',
                'max_tokens' => 1024,
                'messages'   => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            if (!$response->successful()) {
                $this->warn('API error: ' . $response->body());
                return $this->generateViaFallback($items);
            }

            $text = $response->json('choices.0.message.content', '');
            $alts = $this->parseApiResponse($text);

            return array_map(fn($item, $idx) => [
                'rel_path' => $item['rel_path'],
                'alt'      => $alts[$idx] ?? $this->fallbackAlt($item),
            ], $items, array_keys($items));

        } catch (\Throwable $e) {
            $this->warn('API call failed: ' . $e->getMessage());
            return $this->generateViaFallback($items);
        }
    }

    private function buildPrompt(array $payload): string
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return <<<PROMPT
You are an SEO specialist writing alt text for website images.

For each item below, write a concise alt text (50–110 characters) for its featured image.

Rules:
- Describe what the image likely depicts based on its topic/context
- Include the primary keyword naturally
- Be specific and descriptive — avoid vague phrases like "business image" or "illustration"
- Do NOT start with "image of", "photo of", "picture of", "graphic of"
- Do NOT just copy the title verbatim
- Plain text only — no quotes, no markdown

Respond with a valid JSON array. Each entry must have "id" (integer) and "alt" (string) fields ONLY. No extra keys, no commentary outside the JSON.

Content items:
{$json}
PROMPT;
    }

    private function parseApiResponse(string $text): array
    {
        // Extract JSON array from the response (Claude sometimes wraps it)
        if (preg_match('/\[.*\]/s', $text, $m)) {
            $decoded = json_decode($m[0], true);
            if (is_array($decoded)) {
                $map = [];
                foreach ($decoded as $entry) {
                    if (isset($entry['id'], $entry['alt'])) {
                        $map[(int) $entry['id']] = $entry['alt'];
                    }
                }
                return $map;
            }
        }
        return [];
    }

    // ── Fallback (no API key) ───────────────────────────────────────────────

    private function generateViaFallback(array $items): array
    {
        return array_map(fn($item) => [
            'rel_path' => $item['rel_path'],
            'alt'      => $this->fallbackAlt($item),
        ], $items);
    }

    private function fallbackAlt(array $item): string
    {
        $title    = trim($item['title']);
        $type     = $item['type'];
        $excerpt  = trim($item['excerpt']);
        $category = trim($item['category']);

        // Clean up newsletter/edition prefixes like "DevMantra Times: 1st April 21"
        $cleanTitle = preg_replace('/^DevMantra Times:\s*/i', '', $title);
        // If what's left is just a date string, use the category/edition_label instead
        if (preg_match('/^\d+(?:st|nd|rd|th)?\s+\w+\s+\d{2,4}$/i', trim($cleanTitle)) && $category) {
            $cleanTitle = $category . ' — ' . $cleanTitle;
        }

        // Build keyword phrase from first meaningful words of title
        $keywords = $this->titleToKeywords($cleanTitle);

        $suffixes = [
            'blog'       => 'expert analysis and business insights',
            'service'    => 'professional consulting services by DevMantra',
            'newsletter' => 'business advisory newsletter by DevMantra',
            'report'     => 'market research and business intelligence report',
            'case-study' => 'business transformation case study',
        ];

        $suffix = $suffixes[$type] ?? 'content by DevMantra';

        // Use excerpt first sentence if available
        if ($excerpt) {
            $firstSentence = preg_replace('/\.\s+.*$/s', '', strip_tags($excerpt));
            $firstSentence = trim($firstSentence);
            if (mb_strlen($firstSentence) >= 20 && mb_strlen($firstSentence) <= 100) {
                return ucfirst(mb_strtolower($firstSentence));
            }
        }

        $alt = $keywords . ' — ' . $suffix;
        return $this->sanitiseAlt($alt);
    }

    private function titleToKeywords(string $title): string
    {
        // Remove stop words for a keyword-dense phrase
        $stop = ['a', 'an', 'the', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for',
                 'of', 'with', 'by', 'from', 'as', 'is', 'are', 'was', 'were', 'be',
                 'been', 'being', 'how', 'why', 'what', 'when', 'where', 'which'];

        $words = preg_split('/\s+/', mb_strtolower(strip_tags($title)));
        $kept  = array_filter($words, fn($w) => !in_array($w, $stop) && mb_strlen($w) > 2);
        return implode(' ', array_slice($kept, 0, 6));
    }

    // ── Helpers ─────────────────────────────────────────────────────────────

    /**
     * Convert a content model image path to an image_meta rel_path.
     * Returns null for external URLs, empty values, or non-image strings (e.g. icon class names).
     */
    private function toRelPath(?string $path): ?string
    {
        if (!$path) return null;

        $path = trim($path);

        // Skip external URLs
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return null;
        }

        // Skip FontAwesome / icon class strings — they contain spaces or start with "fa-"
        if (str_contains($path, ' ') || str_starts_with($path, 'fa-')) {
            return null;
        }

        // Must have a file extension to be a real image path
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg','jpeg','png','gif','webp','svg','avif','bmp','ico'])) {
            return null;
        }

        $path = str_replace('\\', '/', ltrim($path, '/'));

        // Paths from Storage::disk('public')->store() come as "blogs/xxx.jpg"
        // They live at public/storage/blogs/xxx.jpg → rel_path = storage/blogs/xxx.jpg
        if (!str_starts_with($path, 'storage/') && !str_starts_with($path, 'assets/') && !str_starts_with($path, 'wp-content/')) {
            $path = 'storage/' . $path;
        }

        return $path;
    }

    private function existingAlt(string $relPath): string
    {
        return ImageMeta::where('rel_path', $relPath)->value('alt_text') ?? '';
    }

    private function sanitiseAlt(string $alt): string
    {
        // Strip any HTML tags, collapse whitespace
        $alt = strip_tags($alt);
        $alt = preg_replace('/\s+/', ' ', trim($alt));

        // Remove wrapping quotes Claude sometimes adds
        $alt = trim($alt, '"\'');

        // Truncate to 125 chars at word boundary
        if (mb_strlen($alt) > 125) {
            $alt = mb_substr($alt, 0, 122);
            $alt = mb_substr($alt, 0, mb_strrpos($alt, ' ')) . '…';
        }

        return $alt;
    }
}

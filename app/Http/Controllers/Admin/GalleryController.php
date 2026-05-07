<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageMeta;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    private array $roots = [
        'assets'  => 'assets/img',
        'storage' => 'storage',
        'wp'      => 'wp-content/uploads',
    ];

    private array $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp', 'avif', 'ico'];

    public function index()
    {
        return view('admin.gallery.index');
    }

    public function browse(Request $request)
    {
        $rootKey = $request->get('root', 'assets');
        $subdir  = trim($request->get('dir', ''), '/');

        if (!array_key_exists($rootKey, $this->roots)) {
            return response()->json(['error' => 'Invalid root'], 400);
        }

        $rootRel = $this->roots[$rootKey];
        $rootAbs = realpath(public_path($rootRel));

        if (!$rootAbs) {
            return response()->json(['folders' => [], 'images' => [], 'breadcrumbs' => [], 'root' => $rootKey, 'dir' => $subdir]);
        }

        $targetRel = $subdir ? $rootRel . '/' . $subdir : $rootRel;
        $targetAbs = realpath(public_path($targetRel));

        // Path traversal protection
        if (!$targetAbs || !str_starts_with($targetAbs, $rootAbs)) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        if (!is_dir($targetAbs)) {
            return response()->json(['error' => 'Not a directory'], 404);
        }

        $folders = [];
        $images  = [];

        foreach (scandir($targetAbs) as $item) {
            if ($item === '.' || $item === '..') continue;

            $itemAbs = $targetAbs . DIRECTORY_SEPARATOR . $item;
            $itemRel = str_replace('\\', '/', ltrim(str_replace(public_path(), '', $itemAbs), '/\\'));

            if (is_dir($itemAbs)) {
                $imgCount = count(array_filter(
                    scandir($itemAbs),
                    fn($f) => is_file($itemAbs . DIRECTORY_SEPARATOR . $f)
                           && in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), $this->imageExtensions)
                ));
                $folders[] = [
                    'name'      => $item,
                    'dir'       => $subdir ? $subdir . '/' . $item : $item,
                    'img_count' => $imgCount,
                ];
            } elseif (in_array(strtolower(pathinfo($item, PATHINFO_EXTENSION)), $this->imageExtensions)) {
                $images[] = [
                    'name'     => $item,
                    'url'      => '/' . $itemRel,
                    'rel_path' => $itemRel,
                    'size'     => $this->formatBytes(filesize($itemAbs)),
                    'modified' => date('d M Y', filemtime($itemAbs)),
                    'ext'      => strtolower(pathinfo($item, PATHINFO_EXTENSION)),
                ];
            }
        }

        usort($folders, fn($a, $b) => strcmp($a['name'], $b['name']));
        usort($images,  fn($a, $b) => strcmp($a['name'], $b['name']));

        // Attach saved alt text data keyed by rel_path
        if ($images) {
            $relPaths = array_column($images, 'rel_path');
            $metaMap  = ImageMeta::whereIn('rel_path', $relPaths)
                ->get(['id', 'rel_path', 'alt_text', 'alt_text_suggestion'])
                ->keyBy('rel_path');

            $images = array_map(function ($img) use ($metaMap) {
                $meta = $metaMap->get($img['rel_path']);
                $img['meta_id']              = $meta?->id;
                $img['alt_text']             = $meta?->alt_text ?? '';
                $img['alt_text_suggestion']  = $meta?->alt_text_suggestion ?? '';
                return $img;
            }, $images);
        }

        // Breadcrumbs
        $breadcrumbs = [['label' => $this->rootLabel($rootKey), 'root' => $rootKey, 'dir' => '']];
        if ($subdir) {
            $parts = explode('/', $subdir);
            $acc   = '';
            foreach ($parts as $part) {
                $acc           = $acc ? $acc . '/' . $part : $part;
                $breadcrumbs[] = ['label' => $part, 'root' => $rootKey, 'dir' => $acc];
            }
        }

        return response()->json([
            'root'        => $rootKey,
            'dir'         => $subdir,
            'breadcrumbs' => $breadcrumbs,
            'folders'     => $folders,
            'images'      => $images,
        ]);
    }

    public function replace(Request $request)
    {
        $request->validate([
            'file'     => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg,bmp,avif|max:10240',
            'rel_path' => 'required|string|max:500',
        ]);

        $relPath = str_replace('\\', '/', ltrim($request->input('rel_path'), '/'));

        $allowed = false;
        foreach ($this->roots as $rootRel) {
            if (str_starts_with($relPath, $rootRel . '/') || $relPath === $rootRel) {
                $allowed = true;
                break;
            }
        }
        if (!$allowed) {
            return response()->json(['error' => 'Path not allowed.'], 403);
        }

        $absPath    = public_path($relPath);
        $parentReal = realpath(dirname($absPath));

        if (!$parentReal || !is_dir($parentReal)) {
            return response()->json(['error' => 'Target directory does not exist.'], 422);
        }

        $request->file('file')->move($parentReal, basename($absPath));

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $relPath = str_replace('\\', '/', ltrim($request->input('rel_path', ''), '/'));

        $allowed = false;
        foreach ($this->roots as $rootRel) {
            if (str_starts_with($relPath, $rootRel . '/')) {
                $allowed = true;
                break;
            }
        }
        if (!$allowed) {
            return response()->json(['error' => 'Path not allowed.'], 403);
        }

        $absPath = public_path($relPath);
        if (!is_file($absPath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        unlink($absPath);

        // Clean up orphaned meta record
        ImageMeta::where('rel_path', $relPath)->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Save (upsert) alt_text and alt_text_suggestion for one image.
     * Returns the full meta record including its id.
     */
    public function saveAlt(Request $request)
    {
        $request->validate([
            'rel_path'            => 'required|string|max:500',
            'alt_text'            => 'nullable|string|max:500',
            'alt_text_suggestion' => 'nullable|string|max:500',
        ]);

        $relPath = str_replace('\\', '/', ltrim($request->input('rel_path'), '/'));

        $meta = ImageMeta::updateOrCreate(
            ['rel_path' => $relPath],
            [
                'alt_text'            => $request->input('alt_text', ''),
                'alt_text_suggestion' => $request->input('alt_text_suggestion', ''),
            ]
        );

        return response()->json([
            'success'             => true,
            'id'                  => $meta->id,
            'alt_text'            => $meta->alt_text,
            'alt_text_suggestion' => $meta->alt_text_suggestion,
        ]);
    }

    /**
     * Generate and persist a suggested alt text for one image (by ImageMeta ID).
     * Suggestion is derived from the filename — no external API calls.
     */
    public function suggestAlt(Request $request, ImageMeta $imageMeta)
    {
        $filename   = basename($imageMeta->rel_path);
        $suggestion = $this->generateAltSuggestion($filename);

        $imageMeta->update(['alt_text_suggestion' => $suggestion]);

        return response()->json([
            'success'             => true,
            'id'                  => $imageMeta->id,
            'alt_text_suggestion' => $suggestion,
        ]);
    }

    /**
     * Bulk-fill alt_text_suggestion for all image_meta rows that currently
     * have an empty suggestion. Works on already-catalogued images only;
     * call saveAlt first to register new images.
     */
    public function suggestAlts(Request $request)
    {
        $rows = ImageMeta::whereNull('alt_text_suggestion')
            ->orWhere('alt_text_suggestion', '')
            ->get(['id', 'rel_path']);

        $updated = 0;
        foreach ($rows as $meta) {
            $suggestion = $this->generateAltSuggestion(basename($meta->rel_path));
            $meta->update(['alt_text_suggestion' => $suggestion]);
            $updated++;
        }

        return response()->json([
            'success' => true,
            'updated' => $updated,
        ]);
    }

    /**
     * Generate a human-readable alt text suggestion from a filename.
     * No external calls — pure string transformation.
     */
    private function generateAltSuggestion(string $filename): string
    {
        $name = pathinfo($filename, PATHINFO_FILENAME);

        // Expand camelCase: "heroImage" → "hero Image"
        $name = preg_replace('/([a-z\d])([A-Z])/', '$1 $2', $name);

        // Replace separators with spaces
        $name = str_replace(['-', '_', '.'], ' ', $name);

        // Strip image dimension patterns: "1920x1080", "300x200"
        $name = preg_replace('/\b\d{2,4}[xX]\d{2,4}\b/', '', $name);

        // Strip version tags: "v2", "v1.3", "ver2"
        $name = preg_replace('/\bv(?:er)?\d+(?:\.\d+)*\b/i', '', $name);

        // Strip 4-digit years
        $name = preg_replace('/\b(?:19|20)\d{2}\b/', '', $name);

        // Strip leading index numbers: "01 hero" → "hero"
        $name = preg_replace('/^\d+\s+/', '', $name);

        // Strip trailing standalone numbers: "hero 01" → "hero"
        $name = preg_replace('/\s+\d+$/', '', $name);

        // Collapse whitespace and trim
        $name = trim(preg_replace('/\s{2,}/', ' ', $name));

        // Fall back to raw filename stem if everything was stripped
        if ($name === '') {
            $name = pathinfo($filename, PATHINFO_FILENAME);
        }

        return mb_convert_case($name, MB_CASE_TITLE, 'UTF-8');
    }

    private function rootLabel(string $key): string
    {
        return match ($key) {
            'assets'  => 'Assets / img',
            'storage' => 'Storage',
            'wp'      => 'WP Uploads',
            default   => $key,
        };
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes < 1024)    return $bytes . ' B';
        if ($bytes < 1048576) return round($bytes / 1024, 1) . ' KB';
        return round($bytes / 1048576, 1) . ' MB';
    }
}

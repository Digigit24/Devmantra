<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
                // Count images inside this folder (non-recursive) for the badge
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

        // Must be within an allowed root
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
        return response()->json(['success' => true]);
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
        if ($bytes < 1024)       return $bytes . ' B';
        if ($bytes < 1048576)    return round($bytes / 1024, 1) . ' KB';
        return round($bytes / 1048576, 1) . ' MB';
    }
}

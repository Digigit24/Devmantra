<?php
/**
 * ONE-TIME production cache cleaner.
 * Upload to public/ — visit it once — it deletes itself.
 * DELETE this file after use.
 */

$secret = 'devmantra-clear-2026';

if (($_GET['key'] ?? '') !== $secret) {
    http_response_code(403);
    die('Forbidden. Use ?key=' . $secret);
}

$base  = dirname(__DIR__);
$files = [
    $base . '/bootstrap/cache/packages.php',
    $base . '/bootstrap/cache/services.php',
    $base . '/bootstrap/cache/config.php',
    $base . '/bootstrap/cache/routes-v7.php',
    $base . '/bootstrap/cache/events.php',
];

$results = [];
foreach ($files as $file) {
    if (file_exists($file)) {
        unlink($file) ? $results[] = "✅ Deleted: " . basename($file)
                      : $results[] = "❌ Failed:  " . basename($file);
    } else {
        $results[] = "⬜ Missing:  " . basename($file);
    }
}

// Self-delete
@unlink(__FILE__);
$results[] = "🗑️  Deleted this script.";

header('Content-Type: text/plain; charset=utf-8');
echo implode("\n", $results) . "\n\nDone. The site should be working now.";

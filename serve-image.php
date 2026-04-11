<?php
/**
 * Serve WebP/SVG images with correct MIME type
 * Bypasses server MIME type configuration issues
 */

$allowed_extensions = ['webp', 'svg', 'png', 'jpg', 'jpeg', 'gif'];
$base_path = __DIR__ . '/assets/images/';

$image = isset($_GET['img']) ? $_GET['img'] : '';
$image = ltrim($image, '/');

$file_path = $base_path . $image;

// Security: resolve real path and verify it stays within base directory
$base_real = realpath($base_path);
$real = realpath($file_path);

if (!$real || !$base_real || strpos($real, $base_real . DIRECTORY_SEPARATOR) !== 0) {
    http_response_code(403);
    exit('Access denied');
}

$extension = strtolower(pathinfo($real, PATHINFO_EXTENSION));

if (!in_array($extension, $allowed_extensions)) {
    http_response_code(403);
    exit('Access denied');
}

$mime_types = [
    'webp' => 'image/webp',
    'svg'  => 'image/svg+xml',
    'png'  => 'image/png',
    'jpg'  => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'gif'  => 'image/gif'
];

header('Content-Type: ' . $mime_types[$extension]);
header('Content-Length: ' . filesize($real));
header('Cache-Control: public, max-age=31536000');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');

// [M-2] SVG : empêcher l'exécution de scripts embarqués
if ($extension === 'svg') {
    header('Content-Security-Policy: default-src \'none\'; style-src \'unsafe-inline\'');
    header('X-Content-Type-Options: nosniff');
}

readfile($real);
exit;

<?php
$token = $_GET['token'] ?? '';
if ($token !== 'CEKIDOT2025') die('403 Forbidden');

$action = $_GET['action'] ?? 'status';
$output = '';

switch ($action) {
    case 'storage':
        $target = __DIR__ . '/../storage/app/public';
        $link = __DIR__ . '/storage';
        if (is_link($link)) {
            $output = 'Storage link already exists!';
        } elseif (file_exists($link)) {
            $output = 'ERROR: /public/storage exists as a real folder, not a symlink!';
        } else {
            symlink($target, $link);
            $output = file_exists($link) ? 'Storage linked!' : 'ERROR: symlink() failed!';
        }
        break;
    default:
        $output = 'Available actions: storage';
}

echo "<pre style='padding:20px;background:#1e1e1e;color:#00ff00'>";
echo "ACTION: {$action}\nRESULT: {$output}\n\n⚠️ HAPUS FILE INI SETELAH SELESAI!";
echo "</pre>";

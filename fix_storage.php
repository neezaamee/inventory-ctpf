<?php
/**
 * Script to fix storage directory structure and permissions on cPanel.
 */

$root = __DIR__;
$directories = [
    'storage/app/public',
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/testing',
    'storage/framework/views',
    'storage/logs',
    'bootstrap/cache',
];

echo "<h3>Fixing Storage Directories</h3>";

foreach ($directories as $dir) {
    $fullPath = $root . '/' . $dir;
    if (!is_dir($fullPath)) {
        if (mkdir($fullPath, 0755, true)) {
            echo "<p style='color: green;'>Created: $dir</p>";
        } else {
            echo "<p style='color: red;'>Failed to create: $dir</p>";
        }
    } else {
        echo "<p>Already exists: $dir</p>";
        chmod($fullPath, 0755);
        echo "<p style='color: blue;'>Updated permissions: $dir (755)</p>";
    }
}

// Check if data directory exists specifically
$dataPath = $root . '/storage/framework/cache/data';
if (is_dir($dataPath)) {
    echo "<p style='color: green;'><b>Verified: Cache data path is valid.</b></p>";
} else {
    echo "<p style='color: red;'><b>Error: Cache data path still invalid.</b></p>";
}

echo "<p>Done. You can now delete this script.</p>";

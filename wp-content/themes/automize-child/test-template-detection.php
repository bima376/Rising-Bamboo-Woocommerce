<?php
/**
 * Test file untuk debug template detection
 * Akses via: yoursite.com/wp-content/themes/automize-child/test-template-detection.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check user permissions
if (!current_user_can('manage_options')) {
    wp_die('Akses ditolak. Anda harus login sebagai administrator.');
}

echo "<h1>Template Detection Test</h1>";

// Test child theme path
$child_headers_path = get_stylesheet_directory() . '/template-parts/headers/';
$parent_headers_path = get_template_directory() . '/template-parts/headers/';

echo "<h2>Paths:</h2>";
echo "Child theme path: " . $child_headers_path . "<br>";
echo "Parent theme path: " . $parent_headers_path . "<br>";

echo "<h2>Directory Check:</h2>";
echo "Child theme exists: " . (is_dir($child_headers_path) ? 'YES' : 'NO') . "<br>";
echo "Parent theme exists: " . (is_dir($parent_headers_path) ? 'YES' : 'NO') . "<br>";

echo "<h2>Files in Child Theme:</h2>";
if (is_dir($child_headers_path)) {
    $child_files = glob($child_headers_path . '*.php');
    echo "Count: " . count($child_files) . "<br>";
    foreach ($child_files as $file) {
        echo "<li>" . basename($file) . "</li>";
    }
}

echo "<h2>Files in Parent Theme:</h2>";
if (is_dir($parent_headers_path)) {
    $parent_files = glob($parent_headers_path . '*.php');
    echo "Count: " . count($parent_files) . "<br>";
    foreach ($parent_files as $file) {
        echo "<li>" . basename($file) . "</li>";
    }
}

echo "<h2>Template Detection Logic Test:</h2>";
// Simulate the logic from customizer
if (is_dir($child_headers_path) && count(glob($child_headers_path . '*.php')) > 0) {
    echo "✅ Using child theme files<br>";
    $files = glob($child_headers_path . '*.php');
    $headers = [];
    foreach ($files as $file) {
        $filename = basename($file, '.php');
        $headers[$filename] = ucwords(str_replace(['-', '_'], ' ', $filename));
    }
} else {
    echo "⚠️ Using parent theme files<br>";
    $files = glob($parent_headers_path . '*.php');
    $headers = [];
    foreach ($files as $file) {
        $filename = basename($file, '.php');
        $headers[$filename] = ucwords(str_replace(['-', '_'], ' ', $filename));
    }
}

echo "<h3>Final Headers Array:</h3>";
foreach ($headers as $key => $value) {
    echo "<li>" . $key . " => " . $value . "</li>";
}

echo "<h2>Helper Test:</h2>";
if (class_exists('RisingBambooTheme\Customizer\Helper')) {
    $helper_headers = RisingBambooTheme\Customizer\Helper::get_files_assoc($parent_headers_path);
    echo "Headers from Helper:<br>";
    foreach ($helper_headers as $key => $value) {
        echo "<li>" . $key . " => " . $value . "</li>";
    }
} else {
    echo "❌ Helper class not found!<br>";
}

echo "<br><br><a href='" . admin_url('customize.php') . "'>🎨 Buka Customizer</a>";
echo " | <a href='" . admin_url() . "'>🏠 Kembali ke Dashboard</a>";
echo "<br><br><small>Jika template sudah muncul di customizer, Anda bisa menghapus file ini.</small>";

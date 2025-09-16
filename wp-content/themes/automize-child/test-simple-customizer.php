<?php
/**
 * Test sederhana untuk customizer
 * Akses via: yoursite.com/wp-content/themes/automize-child/test-simple-customizer.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check user permissions
if (!current_user_can('manage_options')) {
    wp_die('Akses ditolak. Anda harus login sebagai administrator.');
}

echo "<h1>Simple Customizer Test</h1>";

// Test apakah child theme customizer dijalankan
echo "<h2>Child Theme Customizer Test:</h2>";

// Simulate the exact same logic as in child theme customizer
$child_headers_path = get_stylesheet_directory() . '/template-parts/headers/';
$parent_headers_path = get_template_directory() . '/template-parts/headers/';

echo "Child path: " . $child_headers_path . "<br>";
echo "Parent path: " . $parent_headers_path . "<br>";

// Test child theme files
if (is_dir($child_headers_path) && count(glob($child_headers_path . '*.php')) > 0) {
    echo "✅ Child theme has template files<br>";
    $files = glob($child_headers_path . '*.php');
    $headers = [];
    foreach ($files as $file) {
        $filename = basename($file, '.php');
        $headers[$filename] = ucwords(str_replace(['-', '_'], ' ', $filename));
    }
    echo "Child theme headers:<br>";
    foreach ($headers as $key => $value) {
        echo "<li>" . $key . " => " . $value . "</li>";
    }
} else {
    echo "⚠️ Child theme has no template files, using parent theme<br>";
    $files = glob($parent_headers_path . '*.php');
    $headers = [];
    foreach ($files as $file) {
        $filename = basename($file, '.php');
        $headers[$filename] = ucwords(str_replace(['-', '_'], ' ', $filename));
    }
    echo "Parent theme headers:<br>";
    foreach ($headers as $key => $value) {
        echo "<li>" . $key . " => " . $value . "</li>";
    }
}

// Test Helper class
echo "<h2>Helper Class Test:</h2>";
if (class_exists('RisingBambooTheme\Customizer\Helper')) {
    $helper_headers = RisingBambooTheme\Customizer\Helper::get_files_assoc($parent_headers_path);
    echo "Helper class headers:<br>";
    foreach ($helper_headers as $key => $value) {
        echo "<li>" . $key . " => " . $value . "</li>";
    }
} else {
    echo "❌ Helper class not available<br>";
}

// Test current theme
echo "<h2>Current Theme:</h2>";
echo "Current theme: " . get_stylesheet() . "<br>";
echo "Parent theme: " . get_template() . "<br>";
echo "Is child theme: " . (is_child_theme() ? 'YES' : 'NO') . "<br>";

// Test customizer constants
echo "<h2>Customizer Constants:</h2>";
if (defined('RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER')) {
    echo "✅ RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER: " . RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER . "<br>";
} else {
    echo "❌ RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER not defined<br>";
}

if (defined('RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER')) {
    echo "✅ RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER: " . RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER . "<br>";
} else {
    echo "❌ RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER not defined<br>";
}

echo "<br><br><a href='" . admin_url('customize.php') . "'>🎨 Buka Customizer</a>";
echo " | <a href='" . admin_url() . "'>🏠 Kembali ke Dashboard</a>";
echo "<br><br><small>Jika template sudah muncul di customizer, Anda bisa menghapus file ini.</small>";

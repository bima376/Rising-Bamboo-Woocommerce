<?php
/**
 * Debug file untuk test Helper class
 * Akses via: yoursite.com/wp-content/themes/automize-child/debug-helper-test.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check user permissions
if (!current_user_can('manage_options')) {
    wp_die('Akses ditolak. Anda harus login sebagai administrator.');
}

echo "<h1>Helper Class Test</h1>";

// Test Helper class availability
echo "<h2>Helper Class Status:</h2>";
if (class_exists('RisingBambooTheme\Customizer\Helper')) {
    echo "✅ RisingBambooTheme\Customizer\Helper is available<br>";
} else {
    echo "❌ RisingBambooTheme\Customizer\Helper is NOT available<br>";
}

if (class_exists('RisingBambooCore\Helper\Helper')) {
    echo "✅ RisingBambooCore\Helper\Helper is available<br>";
} else {
    echo "❌ RisingBambooCore\Helper\Helper is NOT available<br>";
}

// Test get_files_assoc method
echo "<h2>get_files_assoc Method Test:</h2>";
$parent_headers_path = get_template_directory() . '/template-parts/headers/';
echo "Parent headers path: " . $parent_headers_path . "<br>";

if (class_exists('RisingBambooTheme\Customizer\Helper')) {
    try {
        $headers = RisingBambooTheme\Customizer\Helper::get_files_assoc($parent_headers_path);
        echo "✅ get_files_assoc worked!<br>";
        echo "Headers found: " . count($headers) . "<br>";
        foreach ($headers as $key => $value) {
            echo "<li>" . $key . " => " . $value . "</li>";
        }
    } catch (Exception $e) {
        echo "❌ get_files_assoc failed: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ Cannot test get_files_assoc - Helper class not available<br>";
}

// Test direct glob method
echo "<h2>Direct Glob Test:</h2>";
$files = glob($parent_headers_path . '*.php');
echo "Files found with glob: " . count($files) . "<br>";
foreach ($files as $file) {
    echo "<li>" . basename($file) . "</li>";
}

// Test child theme path
echo "<h2>Child Theme Test:</h2>";
$child_headers_path = get_stylesheet_directory() . '/template-parts/headers/';
echo "Child headers path: " . $child_headers_path . "<br>";

if (is_dir($child_headers_path)) {
    $child_files = glob($child_headers_path . '*.php');
    echo "Child theme files: " . count($child_files) . "<br>";
    foreach ($child_files as $file) {
        echo "<li>" . basename($file) . "</li>";
    }
} else {
    echo "❌ Child theme headers directory does not exist<br>";
}

// Test if child theme is active
echo "<h2>Theme Status:</h2>";
echo "Current theme: " . get_stylesheet() . "<br>";
echo "Parent theme: " . get_template() . "<br>";
echo "Is child theme: " . (is_child_theme() ? 'YES' : 'NO') . "<br>";

// Test customizer constants
echo "<h2>Customizer Constants:</h2>";
if (defined('RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER')) {
    echo "✅ RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER is defined: " . RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER . "<br>";
} else {
    echo "❌ RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER is NOT defined<br>";
}

if (defined('RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER')) {
    echo "✅ RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER is defined: " . RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER . "<br>";
} else {
    echo "❌ RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER is NOT defined<br>";
}

echo "<br><br><a href='" . admin_url('customize.php') . "'>🎨 Buka Customizer</a>";
echo " | <a href='" . admin_url() . "'>🏠 Kembali ke Dashboard</a>";
echo "<br><br><small>Jika template sudah muncul di customizer, Anda bisa menghapus file ini.</small>";

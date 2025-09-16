<?php
/**
 * Debug file untuk check footer templates
 * Akses via: yoursite.com/wp-content/themes/automize-child/debug-footer-templates.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check user permissions
if (!current_user_can('manage_options')) {
    wp_die('Akses ditolak. Anda harus login sebagai administrator.');
}

echo "<h1>Footer Templates Debug</h1>";

// Check custom post type rbb_footer
$footers = get_posts([
    'post_type' => 'rbb_footer',
    'numberposts' => -1,
    'post_status' => 'publish'
]);

echo "<h2>Custom Post Type 'rbb_footer':</h2>";
echo "Found: " . count($footers) . " footer templates<br>";

foreach ($footers as $footer) {
    echo "<li>" . $footer->post_title . " (ID: " . $footer->ID . ")</li>";
}

// Check if Elementor is activated
echo "<h2>Elementor Status:</h2>";
if (class_exists('Elementor\Plugin')) {
    echo "✅ Elementor is activated<br>";
} else {
    echo "❌ Elementor is not activated<br>";
}

// Check Rising Bamboo Core Helper
echo "<h2>Rising Bamboo Core Helper:</h2>";
if (class_exists('RisingBambooCore\Helper\Helper')) {
    echo "✅ Rising Bamboo Core Helper is available<br>";
    
    // Test get_elementor_footers method
    if (method_exists('RisingBambooCore\Helper\Helper', 'elementor_activated')) {
        $elementor_activated = RisingBambooCore\Helper\Helper::elementor_activated();
        echo "Elementor activated: " . ($elementor_activated ? 'YES' : 'NO') . "<br>";
    }
} else {
    echo "❌ Rising Bamboo Core Helper is not available<br>";
}

// Check customizer helper
echo "<h2>Customizer Helper:</h2>";
if (class_exists('RisingBambooTheme\Customizer\Helper')) {
    echo "✅ Customizer Helper is available<br>";
    
    // Test get_elementor_footers method
    if (method_exists('RisingBambooTheme\Customizer\Helper', 'get_elementor_footers')) {
        $elementor_footers = RisingBambooTheme\Customizer\Helper::get_elementor_footers();
        echo "Elementor footers: " . print_r($elementor_footers, true) . "<br>";
    }
} else {
    echo "❌ Customizer Helper is not available<br>";
}

// Check template files
echo "<h2>Template Files:</h2>";
$child_footers_path = get_stylesheet_directory() . '/template-parts/footers/';
$parent_footers_path = get_template_directory() . '/template-parts/footers/';

echo "Child theme footers path: " . $child_footers_path . "<br>";
echo "Parent theme footers path: " . $parent_footers_path . "<br>";

if (is_dir($child_footers_path)) {
    $child_files = glob($child_footers_path . '*.php');
    echo "Child theme footer files: " . count($child_files) . "<br>";
    foreach ($child_files as $file) {
        echo "<li>" . basename($file) . "</li>";
    }
}

if (is_dir($parent_footers_path)) {
    $parent_files = glob($parent_footers_path . '*.php');
    echo "Parent theme footer files: " . count($parent_files) . "<br>";
    foreach ($parent_files as $file) {
        echo "<li>" . basename($file) . "</li>";
    }
}

// Test our custom function
echo "<h2>Custom Function Test:</h2>";
if (function_exists('automize_child_get_template_files')) {
    $footers = automize_child_get_template_files('footers');
    echo "Footers from custom function:<br>";
    foreach ($footers as $key => $value) {
        echo "<li>" . $key . " => " . $value . "</li>";
    }
} else {
    echo "❌ Custom function not found!<br>";
}

echo "<br><br><a href='" . admin_url('customize.php') . "'>🎨 Buka Customizer</a>";
echo " | <a href='" . admin_url() . "'>🏠 Kembali ke Dashboard</a>";
echo "<br><br><small>Jika footer templates sudah muncul di customizer, Anda bisa menghapus file ini.</small>";

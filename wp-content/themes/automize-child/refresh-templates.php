<?php
/**
 * Manual refresh untuk template files
 * Akses via: yoursite.com/wp-content/themes/automize-child/refresh-templates.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check user permissions
if (!current_user_can('manage_options')) {
    wp_die('Akses ditolak. Anda harus login sebagai administrator.');
}

echo "<h1>Refresh Template Files</h1>";

// Force refresh template files
if (function_exists('automize_child_force_refresh_template_files')) {
    automize_child_force_refresh_template_files();
    echo "<p style='color: green;'>✅ Template files berhasil di-refresh!</p>";
} else {
    echo "<p style='color: red;'>❌ Function refresh tidak ditemukan!</p>";
}

// Reset activation flag
delete_option('automize_child_template_files_activated');
echo "<p style='color: blue;'>🔄 Activation flag telah direset.</p>";

// Manually activate templates
if (function_exists('automize_child_activate_template_files')) {
    automize_child_activate_template_files();
    echo "<p style='color: green;'>✅ Template files berhasil diaktifkan ulang!</p>";
}

echo "<h2>Status Template Files:</h2>";

// Check child theme templates
$child_headers_path = get_stylesheet_directory() . '/template-parts/headers/';
if (is_dir($child_headers_path)) {
    $child_files = glob($child_headers_path . '*.php');
    echo "<p><strong>Child Theme Headers:</strong> " . count($child_files) . " files</p>";
    foreach ($child_files as $file) {
        echo "<li>" . basename($file) . "</li>";
    }
}

// Check parent theme templates
$parent_headers_path = get_template_directory() . '/template-parts/headers/';
if (is_dir($parent_headers_path)) {
    $parent_files = glob($parent_headers_path . '*.php');
    echo "<p><strong>Parent Theme Headers:</strong> " . count($parent_files) . " files</p>";
    foreach ($parent_files as $file) {
        echo "<li>" . basename($file) . "</li>";
    }
}

// Test custom function
if (function_exists('automize_child_get_template_files')) {
    $headers = automize_child_get_template_files('headers');
    echo "<h3>Template Files dari Custom Function:</h3>";
    foreach ($headers as $key => $value) {
        echo "<li>" . $key . " => " . $value . "</li>";
    }
}

echo "<br><br><a href='" . admin_url('customize.php') . "'>🎨 Buka Customizer</a>";
echo " | <a href='" . admin_url() . "'>🏠 Kembali ke Dashboard</a>";
echo "<br><br><small>Jika template sudah muncul di customizer, Anda bisa menghapus file ini.</small>";

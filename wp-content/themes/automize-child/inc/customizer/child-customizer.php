<?php
/**
 * Child Theme Customizer Override
 *
 * @package Automize_Child
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Load child theme customizer sections
 */
function automize_child_load_customizer() {
    // Load header customizer
    $header_file = get_stylesheet_directory() . '/inc/customizer/sections/header.php';
    if (file_exists($header_file)) {
        include $header_file;
    }
    
    // Load footer customizer
    $footer_file = get_stylesheet_directory() . '/inc/customizer/sections/footer.php';
    if (file_exists($footer_file)) {
        include $footer_file;
    }
}

// Hook untuk memuat customizer child theme dengan prioritas tinggi
add_action('customize_register', 'automize_child_load_customizer', 5);

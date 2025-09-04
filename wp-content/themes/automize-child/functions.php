<?php
/**
 * Automize Child Theme Functions
 * 
 * @package Automize_Child
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue parent theme styles
 */
function automize_child_enqueue_styles() {
    // Enqueue parent theme style
    wp_enqueue_style('automize-parent-style', get_template_directory_uri() . '/style.css');
    
    // Enqueue child theme style
    wp_enqueue_style('automize-child-style', 
        get_stylesheet_directory_uri() . '/style.css',
        array('automize-parent-style'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'automize_child_enqueue_styles');

/**
 * Enqueue parent theme scripts
 */
function automize_child_enqueue_scripts() {
    // Enqueue parent theme scripts if needed
    // wp_enqueue_script('automize-parent-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'automize_child_enqueue_scripts');

/**
 * Custom functions untuk child theme
 * Tambahkan custom functions di sini
 */

// Contoh: Custom function untuk menampilkan copyright
function automize_child_copyright() {
    $year = date('Y');
    echo '<p>&copy; ' . $year . ' ' . get_bloginfo('name') . '. All rights reserved.</p>';
}

// Contoh: Custom function untuk menambahkan custom CSS
function automize_child_custom_css() {
    ?>
    <style type="text/css">
        /* Custom CSS yang akan ditambahkan ke head */
        .custom-class {
            /* Custom styles */
        }
    </style>
    <?php
}
add_action('wp_head', 'automize_child_custom_css');

/**
 * Custom post types atau custom functions bisa ditambahkan di sini
 */

// Contoh: Menambahkan custom body class
function automize_child_body_classes($classes) {
    $classes[] = 'automize-child';
    return $classes;
}
add_filter('body_class', 'automize_child_body_classes');

/**
 * Include brand select2 fix
 */
require_once get_stylesheet_directory() . '/fix-brand-select2.php';

/**
 * Include brand taxonomy registration
 */
require_once get_stylesheet_directory() . '/register-brand-taxonomy.php';

/**
 * Include brand debug tools (only in admin)
 */
if (is_admin()) {
    require_once get_stylesheet_directory() . '/debug-brand.php';
}

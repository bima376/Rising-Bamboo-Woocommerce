<?php
/**
 * Child Theme Setup Wizard Import Configuration
 *
 * @package Automize_Child
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include parent theme import config
$parent_import_file = get_template_directory() . '/inc/config/theme-setup-wizard-import.php';
if (file_exists($parent_import_file)) {
    $parent_imports = include $parent_import_file;
    
    if (is_array($parent_imports)) {
        return $parent_imports;
    }
}

// Fallback import config
$setup_demo_import = 'https://automize.risingbamboo.com/imports/';
$setup_demo_import_data = [
    [
        'import_file_name' => __('Essential', 'automize'),
        'import_file_url'  => $setup_demo_import . 'setup/essential.xml',
    ],
];

if (class_exists('WooCommerce')) {
    $setup_demo_import_data[] = [
        'import_file_name' => __('Extra Data ( Post, Product, Menu ...)', 'automize'),
        'import_file_url'  => $setup_demo_import . 'setup/extra.xml',
    ];
}

return $setup_demo_import_data;

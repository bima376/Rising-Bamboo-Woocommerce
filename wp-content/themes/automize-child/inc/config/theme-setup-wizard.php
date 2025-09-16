<?php
/**
 * Child Theme Setup Wizard Configuration
 *
 * @package Automize_Child
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include parent theme setup wizard config
$parent_config_file = get_template_directory() . '/inc/config/theme-setup-wizard.php';
if (file_exists($parent_config_file)) {
    $parent_config = include $parent_config_file;
    
    // Modify config untuk child theme
    if (is_array($parent_config)) {
        // Update base path dan URL untuk child theme
        $parent_config['config']['base_path'] = get_stylesheet_directory();
        $parent_config['config']['base_url'] = get_stylesheet_directory_uri();
        
        return $parent_config;
    }
}

// Fallback config
return [
    'config' => [
        'dev_mode'             => false,
        'license_step'         => false,
        'license_required'     => false,
        'license_help_url'     => '',
        'edd_remote_api_url'   => '',
        'edd_item_name'        => '',
        'edd_theme_slug'       => '',
    ],
    'trans' => [
        'admin-menu' => esc_html__('Theme Setup', 'automize'),
    ],
];

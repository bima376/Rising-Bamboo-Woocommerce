<?php
/**
 * Uninstall file for Order Tracking WooCommerce Plugin
 * 
 * This file is executed when the plugin is uninstalled.
 * It removes all plugin data from the database.
 */

// If uninstall not called from WordPress, then exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Remove plugin options
delete_option('otw_settings');

// Remove any transients
delete_transient('otw_cache_headers');

// Clear any cached data
wp_cache_flush();

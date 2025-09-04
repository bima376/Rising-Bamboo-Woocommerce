<?php
/**
 * Register Brand Taxonomy if not exists
 * 
 * @package Automize_Child
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register product brand taxonomy if not exists
 */
function automize_child_register_brand_taxonomy() {
    // Check if product_brand taxonomy already exists
    if (taxonomy_exists('product_brand')) {
        return;
    }
    
    // Check if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        return;
    }
    
    // Register product brand taxonomy
    $labels = [
        'name'              => _x('Brands', 'taxonomy general name', 'automize-child'),
        'singular_name'     => _x('Brand', 'taxonomy singular name', 'automize-child'),
        'search_items'      => __('Search Brands', 'automize-child'),
        'all_items'         => __('All Brands', 'automize-child'),
        'parent_item'       => __('Parent Brand', 'automize-child'),
        'parent_item_colon' => __('Parent Brand:', 'automize-child'),
        'edit_item'         => __('Edit Brand', 'automize-child'),
        'update_item'       => __('Update Brand', 'automize-child'),
        'add_new_item'      => __('Add New Brand', 'automize-child'),
        'new_item_name'     => __('New Brand Name', 'automize-child'),
        'menu_name'         => __('Brands', 'automize-child'),
    ];
    
    $args = [
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'brand'],
        'show_in_rest'      => true,
    ];
    
    register_taxonomy('product_brand', ['product'], $args);
}
add_action('init', 'automize_child_register_brand_taxonomy', 20);

/**
 * Add brand column to products admin
 */
function automize_child_add_brand_column($columns) {
    $columns['product_brand'] = __('Brand', 'automize-child');
    return $columns;
}
add_filter('manage_product_posts_columns', 'automize_child_add_brand_column');

/**
 * Display brand in products admin column
 */
function automize_child_display_brand_column($column, $post_id) {
    if ($column === 'product_brand') {
        $terms = get_the_terms($post_id, 'product_brand');
        if ($terms && !is_wp_error($terms)) {
            $brand_names = array_map(function($term) {
                return $term->name;
            }, $terms);
            echo implode(', ', $brand_names);
        } else {
            echo '—';
        }
    }
}
add_action('manage_product_posts_custom_column', 'automize_child_display_brand_column', 10, 2);

/**
 * Add brand filter to products admin
 */
function automize_child_add_brand_filter() {
    global $typenow;
    
    if ($typenow === 'product') {
        $taxonomy = 'product_brand';
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        
        wp_dropdown_categories([
            'show_option_all' => __('All Brands', 'automize-child'),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'value_field'     => 'slug',
            'selected'        => $selected,
            'show_count'      => true,
        ]);
    }
}
add_action('restrict_manage_posts', 'automize_child_add_brand_filter');

/**
 * Filter products by brand in admin
 */
function automize_child_filter_products_by_brand($query) {
    global $pagenow, $typenow;
    
    if ($pagenow === 'edit.php' && $typenow === 'product' && isset($_GET['product_brand']) && $_GET['product_brand'] !== '') {
        $query->set('tax_query', [
            [
                'taxonomy' => 'product_brand',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['product_brand']),
            ],
        ]);
    }
}
add_action('parse_query', 'automize_child_filter_products_by_brand');

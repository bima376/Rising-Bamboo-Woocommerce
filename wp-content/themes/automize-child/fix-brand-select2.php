<?php
/**
 * Fix Brand Select2Option Issue
 * 
 * @package Automize_Child
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Fix brand select2option issue after switching to child theme
 */
class Automize_Child_Brand_Fix {
    
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_fix_scripts']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_fix_scripts']);
        add_action('wp_ajax_rbb_get_brand_fix', [$this, 'rbb_get_brand_fix']);
        add_action('wp_ajax_nopriv_rbb_get_brand_fix', [$this, 'rbb_get_brand_fix']);
    }
    
    /**
     * Enqueue fix scripts
     */
    public function enqueue_fix_scripts() {
        // Add inline script to fix brand select2
        $script = "
        jQuery(document).ready(function($) {
            // Fix brand select2 after theme switch
            if (typeof elementor !== 'undefined') {
                elementor.hooks.addAction('panel/open_editor/widget', function(panel, model, view) {
                    setTimeout(function() {
                        // Reinitialize brand select2
                        $('.elementor-control-brands .select2-container').remove();
                        $('.elementor-control-brands select').select2({
                            placeholder: 'Write Title Brand',
                            allowClear: true,
                            minimumInputLength: 3,
                            ajax: {
                                url: ajaxurl + '?action=rbb_get_brand_fix',
                                dataType: 'json',
                                delay: 500,
                                cache: true,
                                data: function (params) {
                                    return {
                                        q: params.term,
                                        nonce: '" . wp_create_nonce('rbb_nonce') . "'
                                    };
                                },
                                processResults: function (data) {
                                    return {
                                        results: data.results || []
                                    };
                                }
                            }
                        });
                    }, 1000);
                });
            }
        });
        ";
        
        wp_add_inline_script('jquery', $script);
    }
    
    /**
     * Alternative brand AJAX handler
     */
    public function rbb_get_brand_fix() {
        $return = [];
        
        // Check nonce
        if (!wp_verify_nonce($_GET['nonce'] ?? '', 'rbb_nonce')) {
            wp_send_json(['results' => []]);
            return;
        }
        
        // Check if product_brand taxonomy exists
        if (!taxonomy_exists('product_brand')) {
            // Try alternative brand taxonomies
            $brand_taxonomies = [
                'product_brand',
                'pa_brand',
                'product_brands',
                'brand',
                'yith_product_brand'
            ];
            
            $found_taxonomy = null;
            foreach ($brand_taxonomies as $taxonomy) {
                if (taxonomy_exists($taxonomy)) {
                    $found_taxonomy = $taxonomy;
                    break;
                }
            }
            
            if (!$found_taxonomy) {
                wp_send_json(['results' => []]);
                return;
            }
        } else {
            $found_taxonomy = 'product_brand';
        }
        
        // Get brand terms
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $search_results = get_terms([
                'taxonomy'   => $found_taxonomy,
                'name__like' => sanitize_text_field(wp_unslash($_GET['q'])),
                'hide_empty' => false,
            ]);
            
            if ($search_results && !is_wp_error($search_results)) {
                foreach ($search_results as $result) {
                    $return[] = [
                        'id'   => $result->term_id,
                        'text' => $result->name . ' (ID:' . $result->term_id . ')',
                    ];
                }
            }
        }
        
        wp_send_json(['results' => $return]);
    }
}

// Initialize the fix
new Automize_Child_Brand_Fix();

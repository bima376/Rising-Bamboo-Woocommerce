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
                                url: ajaxurl + '?action=rbb_get_brand',
                                dataType: 'json',
                                delay: 500,
                                cache: true,
                                data: function (params) {
                                    return {
                                        q: params.term,
                                        nonce: '" . wp_create_nonce('rbb_core_nonce') . "'
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
    
}

// Initialize the fix
new Automize_Child_Brand_Fix();

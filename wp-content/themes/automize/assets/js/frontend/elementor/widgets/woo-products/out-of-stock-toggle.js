/**
 * Out of Stock Toggle for WooCommerce Products
 * 
 * This script adds a toggle button to show/hide out of stock products
 * in WooCommerce product widgets.
 */

(function($) {
    'use strict';

    // Initialize when document is ready
    $(document).ready(function() {
        initOutOfStockToggle();
    });

    // Initialize out of stock toggle functionality
    function initOutOfStockToggle() {
        // Add toggle button to product widgets
        $('.rbb_woo_products').each(function() {
            var $widget = $(this);
            var $titleSection = $widget.find('.title_left');
            
            // Check if toggle button already exists
            if ($widget.find('.out-of-stock-toggle').length === 0) {
                // Create toggle button
                var $toggleButton = createToggleButton();
                
                // Insert toggle button after title
                if ($titleSection.length > 0) {
                    $titleSection.after($toggleButton);
                } else {
                    $widget.prepend($toggleButton);
                }
                
                // Bind toggle functionality
                bindToggleEvents($widget, $toggleButton);
            }
        });
    }

    // Create toggle button element
    function createToggleButton() {
        return $('<div class="out-of-stock-toggle-container mb-4">' +
                    '<label class="toggle-switch">' +
                        '<input type="checkbox" class="out-of-stock-toggle" id="out-of-stock-toggle">' +
                        '<span class="toggle-slider"></span>' +
                        '<span class="toggle-label">Sembunyikan Produk Out of Stock</span>' +
                    '</label>' +
                '</div>');
    }

    // Bind toggle events
    function bindToggleEvents($widget, $toggleButton) {
        var $toggle = $toggleButton.find('.out-of-stock-toggle');
        var $label = $toggleButton.find('.toggle-label');
        
        // Handle toggle change
        $toggle.on('change', function() {
            var isHidden = $(this).is(':checked');
            
            // Update label
            $label.text(isHidden ? 'Tampilkan Semua Produk' : 'Sembunyikan Produk Out of Stock');
            
            // Filter products
            filterOutOfStockProducts($widget, isHidden);
            
            // Update AJAX data for future requests
            updateAjaxData($widget, isHidden);
        });
    }

    // Filter out of stock products
    function filterOutOfStockProducts($widget, hideOutOfStock) {
        if (hideOutOfStock) {
            // Hide out of stock products
            $widget.find('.item').each(function() {
                var $item = $(this);
                var $stockElement = $item.find('.stock.out-of-stock, .stock-content .out-of-stock');
                
                if ($stockElement.length > 0) {
                    $item.hide();
                }
            });
        } else {
            // Show all products
            $widget.find('.item').show();
        }
    }

    // Update AJAX data for future requests
    function updateAjaxData($widget, hideOutOfStock) {
        var $selects = $widget.find('select[data-ajax]');
        
        $selects.each(function() {
            var $select = $(this);
            var ajaxData = JSON.parse($select.attr('data-ajax'));
            
            // Update hide_out_of_stock parameter
            ajaxData.hide_out_of_stock = hideOutOfStock ? 'yes' : 'no';
            
            // Update data-ajax attribute
            $select.attr('data-ajax', JSON.stringify(ajaxData));
        });
    }

    // Re-initialize when new content is loaded via AJAX
    $(document).on('rbb_products_loaded', function() {
        initOutOfStockToggle();
    });

    // Re-initialize when Elementor frontend is ready
    $(window).on('elementor/frontend/init', function() {
        if (elementorFrontend.isEditMode()) {
            elementorFrontend.hooks.addAction('frontend/element_ready/rbb_woo_products.default', function() {
                initOutOfStockToggle();
            });
        }
    });

})(jQuery);

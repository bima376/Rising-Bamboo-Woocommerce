<?php
/**
 * Debug Brand Functionality
 * 
 * @package Automize_Child
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Debug brand functionality - add to admin menu
 */
function automize_child_add_brand_debug_menu() {
    add_management_page(
        'Brand Debug',
        'Brand Debug',
        'manage_options',
        'brand-debug',
        'automize_child_brand_debug_page'
    );
}
add_action('admin_menu', 'automize_child_add_brand_debug_menu');

/**
 * Brand debug page
 */
function automize_child_brand_debug_page() {
    ?>
    <div class="wrap">
        <h1>Brand Debug Information</h1>
        
        <h2>Taxonomy Status</h2>
        <table class="widefat">
            <thead>
                <tr>
                    <th>Taxonomy</th>
                    <th>Exists</th>
                    <th>Terms Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $brand_taxonomies = [
                    'product_brand',
                    'pa_brand',
                    'product_brands',
                    'brand',
                    'yith_product_brand'
                ];
                
                foreach ($brand_taxonomies as $taxonomy) {
                    $exists = taxonomy_exists($taxonomy);
                    $terms_count = $exists ? wp_count_terms($taxonomy) : 0;
                    ?>
                    <tr>
                        <td><strong><?php echo esc_html($taxonomy); ?></strong></td>
                        <td><?php echo $exists ? '<span style="color: green;">✓ Yes</span>' : '<span style="color: red;">✗ No</span>'; ?></td>
                        <td><?php echo esc_html($terms_count); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        
        <h2>AJAX Test</h2>
        <p>Test AJAX endpoint: <a href="<?php echo admin_url('admin-ajax.php'); ?>?action=rbb_get_brand_fix&nonce=<?php echo wp_create_nonce('rbb_nonce'); ?>&q=test" target="_blank">Test Brand AJAX</a></p>
        
        <h2>Plugin Status</h2>
        <table class="widefat">
            <thead>
                <tr>
                    <th>Plugin</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>WooCommerce</td>
                    <td><?php echo class_exists('WooCommerce') ? '<span style="color: green;">✓ Active</span>' : '<span style="color: red;">✗ Inactive</span>'; ?></td>
                </tr>
                <tr>
                    <td>Elementor</td>
                    <td><?php echo class_exists('Elementor\Plugin') ? '<span style="color: green;">✓ Active</span>' : '<span style="color: red;">✗ Inactive</span>'; ?></td>
                </tr>
                <tr>
                    <td>Rising Bamboo</td>
                    <td><?php echo class_exists('RisingBambooCore\App\App') ? '<span style="color: green;">✓ Active</span>' : '<span style="color: red;">✗ Inactive</span>'; ?></td>
                </tr>
            </tbody>
        </table>
        
        <h2>Quick Actions</h2>
        <p>
            <a href="<?php echo admin_url('edit-tags.php?taxonomy=product_brand&post_type=product'); ?>" class="button">Manage Brands</a>
            <a href="<?php echo admin_url('edit.php?post_type=product'); ?>" class="button">Manage Products</a>
        </p>
        
        <h2>Create Sample Brand</h2>
        <form method="post">
            <?php wp_nonce_field('create_sample_brand', 'brand_nonce'); ?>
            <p>
                <input type="text" name="brand_name" placeholder="Brand Name" required>
                <input type="submit" name="create_brand" class="button" value="Create Brand">
            </p>
        </form>
        
        <?php
        // Handle brand creation
        if (isset($_POST['create_brand']) && wp_verify_nonce($_POST['brand_nonce'], 'create_sample_brand')) {
            $brand_name = sanitize_text_field($_POST['brand_name']);
            if (!empty($brand_name)) {
                $result = wp_insert_term($brand_name, 'product_brand');
                if (!is_wp_error($result)) {
                    echo '<div class="notice notice-success"><p>Brand "' . esc_html($brand_name) . '" created successfully!</p></div>';
                } else {
                    echo '<div class="notice notice-error"><p>Error creating brand: ' . esc_html($result->get_error_message()) . '</p></div>';
                }
            }
        }
        ?>
    </div>
    <?php
}

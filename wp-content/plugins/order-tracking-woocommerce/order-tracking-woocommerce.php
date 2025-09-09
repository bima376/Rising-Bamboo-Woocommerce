<?php
/**
 * Plugin Name: Order Tracking WooCommerce
 * Plugin URI: https://yourwebsite.com/order-tracking-woocommerce
 * Description: Menampilkan custom fields dari order di halaman tracking WooCommerce. Plugin ini memungkinkan admin untuk menambahkan custom fields di order dan menampilkannya di frontend tracking page.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('OTW_VERSION', '1.0.2');


/**
 * Main plugin class
 */
class OrderTrackingWooCommerce {
    
    /**
     * Single instance of the class
     */
    private static $instance = null;
    
    /**
     * Get single instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        add_action('plugins_loaded', array($this, 'init'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }
    
    /**
     * Initialize plugin
     */
    public function init() {
        // Check if WooCommerce is active
        if (!class_exists('WooCommerce')) {
            add_action('admin_notices', array($this, 'woocommerce_missing_notice'));
            return;
        }
        
        
        // Initialize plugin components
        $this->init_hooks();
        $this->init_admin();
    }
    
    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Frontend hooks - only if WooCommerce is active
        if (class_exists('WooCommerce')) {
            // Display custom fields in order tracking page (after order table but before "Order Again" button)
            add_action('woocommerce_order_details_after_order_table', array($this, 'display_order_custom_fields_tracking'), 5);
            add_action('woocommerce_order_details_after_order_table', array($this, 'display_tracking_custom_fields_tracking'), 5);
        }
    }
    
    /**
     * Initialize admin
     */
    private function init_admin() {
        if (is_admin()) {
            add_action('admin_menu', array($this, 'add_admin_menu'));
            add_action('admin_init', array($this, 'register_settings'));
        }
    }
    
    /**
     * Plugin activation
     */
    public function activate() {
        // Set default options
        $default_options = array(
            'otw_enable_all_fields' => 'yes',
            'otw_enable_tracking_fields' => 'yes',
            'otw_tracking_fields' => array(
                'tracking_number',
                'tracking_url',
                'shipping_company',
                'expected_delivery',
                'special_instructions'
            )
        );
        
        add_option('otw_settings', $default_options);
    }
    
    /**
     * Plugin deactivation
     */
    public function deactivate() {
        // Clean up if needed
    }
    
    /**
     * WooCommerce missing notice
     */
    public function woocommerce_missing_notice() {
        echo '<div class="error"><p><strong>Order Tracking WooCommerce</strong> requires WooCommerce to be installed and active.</p></div>';
    }
    
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_submenu_page(
            'woocommerce',
            'Order Tracking Settings',
            'Order Tracking',
            'manage_woocommerce',
            'order-tracking-settings',
            array($this, 'admin_page')
        );
    }
    
    /**
     * Register settings
     */
    public function register_settings() {
        register_setting('otw_settings', 'otw_settings');
    }
    
    /**
     * Admin page
     */
    public function admin_page() {
        $settings = get_option('otw_settings', array());
        ?>
        <div class="wrap">
            <h1>Order Tracking Settings</h1>
            
            <form method="post" action="options.php">
                <?php settings_fields('otw_settings'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">Enable All Custom Fields</th>
                        <td>
                            <label>
                                <input type="checkbox" name="otw_settings[otw_enable_all_fields]" value="yes" 
                                       <?php checked(isset($settings['otw_enable_all_fields']) ? $settings['otw_enable_all_fields'] : 'yes', 'yes'); ?>>
                                Display all custom fields in order tracking
                            </label>
                            <p class="description">If enabled, all non-protected custom fields will be displayed.</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Enable Specific Tracking Fields</th>
                        <td>
                            <label>
                                <input type="checkbox" name="otw_settings[otw_enable_tracking_fields]" value="yes" 
                                       <?php checked(isset($settings['otw_enable_tracking_fields']) ? $settings['otw_enable_tracking_fields'] : 'yes', 'yes'); ?>>
                                Display specific tracking fields
                            </label>
                            <p class="description">If enabled, only specific tracking fields will be displayed.</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Tracking Fields</th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">Select tracking fields to display</legend>
                                <?php
                                $default_tracking_fields = array(
                                    'tracking_number' => 'Tracking Number',
                                    'tracking_url' => 'Tracking URL',
                                    'shipping_company' => 'Shipping Company',
                                    'expected_delivery' => 'Expected Delivery',
                                    'special_instructions' => 'Special Instructions'
                                );
                                
                                $selected_fields = isset($settings['otw_tracking_fields']) ? $settings['otw_tracking_fields'] : array_keys($default_tracking_fields);
                                
                                foreach ($default_tracking_fields as $field_key => $field_label) {
                                    ?>
                                    <label>
                                        <input type="checkbox" name="otw_settings[otw_tracking_fields][]" value="<?php echo esc_attr($field_key); ?>" 
                                               <?php checked(in_array($field_key, $selected_fields)); ?>>
                                        <?php echo esc_html($field_label); ?>
                                    </label><br>
                                    <?php
                                }
                                ?>
                            </fieldset>
                            <p class="description">Select which custom fields to display in the tracking section.</p>
                        </td>
                    </tr>
                    
                </table>
                
                <?php submit_button(); ?>
            </form>
            
            <div class="card">
                <h2>How to Use</h2>
                <ol>
                    <li>Go to WooCommerce > Orders and edit an order</li>
                    <li>Scroll down to the "Custom Fields" meta box</li>
                    <li>Add custom fields with keys like "tracking_number", "shipping_company", etc.</li>
                    <li>The custom fields will automatically appear on the order tracking page</li>
                </ol>
            </div>
        </div>
        <?php
    }
    
    /**
     * Display all custom fields in order tracking page only
     */
    public function display_order_custom_fields_tracking($order) {
        // Only display on order tracking page, not in my account
        if (is_account_page()) {
            return;
        }
        
        if (!$order || !is_object($order)) {
            return;
        }
        
        // Check if order has get_meta_data method
        if (!method_exists($order, 'get_meta_data')) {
            return;
        }
        
        $settings = get_option('otw_settings', array());
        
        // Check if all fields display is enabled
        if (isset($settings['otw_enable_all_fields']) && $settings['otw_enable_all_fields'] !== 'yes') {
            return;
        }
        
        // Get all custom meta data (excluding protected meta)
        $metadata = $order->get_meta_data();
        $custom_fields = array();
        
        foreach ($metadata as $meta) {
            $data = $meta->get_data();
            // Skip protected meta (those starting with _)
            if (!is_protected_meta($data['key'], 'order')) {
                $custom_fields[] = array(
                    'key' => $data['key'],
                    'value' => $data['value']
                );
            }
        }
        
        // Only display if there are custom fields
        if (!empty($custom_fields)) {
            ?>
            <section>
                <div class="rbb-account__order-detail-info">
                    <?php foreach ($custom_fields as $field) : ?>
                        <div class="rbb-account__order-detail-subtotal flex justify-between pb-4 mb-4">
                            <div class="rbb-account__order-detail-title font-semibold text-sm">
                                <?php echo esc_html($field['key']); ?>:
                            </div>
                            <div class="rbb-account__order-detail-subtotal-price rbb-account__order-detail-title font-bold text-sm">
                                <?php echo esc_html($field['value']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php
        }
    }
    
    /**
     * Display tracking custom fields in order tracking page only
     */
    public function display_tracking_custom_fields_tracking($order) {
        // Only display on order tracking page, not in my account
        if (is_account_page()) {
            return;
        }
        
        if (!$order || !is_object($order)) {
            return;
        }
        
        // Check if order has get_meta method
        if (!method_exists($order, 'get_meta')) {
            return;
        }
        
        $settings = get_option('otw_settings', array());
        
        // Check if tracking fields display is enabled
        if (isset($settings['otw_enable_tracking_fields']) && $settings['otw_enable_tracking_fields'] !== 'yes') {
            return;
        }
        
        $tracking_fields = isset($settings['otw_tracking_fields']) ? $settings['otw_tracking_fields'] : array(
            'tracking_number',
            'tracking_url',
            'shipping_company',
            'expected_delivery',
            'special_instructions'
        );
        
        $this->display_specific_order_custom_fields($order, $tracking_fields);
    }
    
    /**
     * Display specific custom fields only
     */
    public function display_specific_order_custom_fields($order, $allowed_fields = array()) {
        if (!$order || !is_object($order)) {
            return;
        }
        
        // Check if order has get_meta method
        if (!method_exists($order, 'get_meta')) {
            return;
        }
        
        $custom_fields = array();
        
        foreach ($allowed_fields as $field_key) {
            $value = $order->get_meta($field_key);
            if (!empty($value)) {
                $custom_fields[] = array(
                    'key' => $field_key,
                    'value' => $value
                );
            }
        }
        
        if (!empty($custom_fields)) {
            ?>
            <section class="woocommerce-order-details rbb-account__order-detail-content bg-white rounded-2xl px-[30px] pt-[30px] pb-[1px]">
                <div class="rbb-account__order-detail-info">
                    <?php foreach ($custom_fields as $field) : ?>
                        <div class="rbb-account__order-detail-subtotal flex justify-between pb-4 mb-4">
                            <div class="rbb-account__order-detail-title font-semibold text-sm">
                                <?php echo esc_html(ucwords(str_replace(array('_', '-'), array(' ', ' '), $field['key']))); ?>:
                            </div>
                            <div class="rbb-account__order-detail-subtotal-price rbb-account__order-detail-title font-bold text-sm">
                                <?php 
                                // Special handling for URLs
                                if (filter_var($field['value'], FILTER_VALIDATE_URL)) {
                                    echo '<a href="' . esc_url($field['value']) . '" target="_blank" class="text-blue-600 hover:text-blue-800">' . esc_html($field['value']) . '</a>';
                                } else {
                                    echo esc_html($field['value']);
                                }
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php
        }
    }
}

// Initialize the plugin
OrderTrackingWooCommerce::get_instance();

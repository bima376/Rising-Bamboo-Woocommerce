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
 * Load child theme customizer
 */
require_once get_stylesheet_directory() . '/inc/customizer/child-customizer.php';

/**
 * Override theme setup wizard untuk child theme
 */
function automize_child_override_theme_setup() {
    // Override theme setup wizard config path
    add_filter('rbb_theme_setup_wizard_config_path', function($path) {
        $child_config = get_stylesheet_directory() . '/inc/config/theme-setup-wizard.php';
        if (file_exists($child_config)) {
            return $child_config;
        }
        return $path;
    });
    
    // Override theme setup wizard import path
    add_filter('rbb_theme_setup_wizard_import_path', function($path) {
        $child_import = get_stylesheet_directory() . '/inc/config/theme-setup-wizard-import.php';
        if (file_exists($child_import)) {
            return $child_import;
        }
        return $path;
    });
}
add_action('after_setup_theme', 'automize_child_override_theme_setup', 5);

/**
 * Prevent parent theme customizer sections from loading
 */
function automize_child_prevent_parent_customizer() {
    // Remove parent theme customizer sections
    if (class_exists('RisingBambooTheme\Customizer\Customizer')) {
        // Remove the init action that loads sections
        remove_action('init', [RisingBambooTheme\Customizer\Customizer::instance(), 'load'], 10);
    }
}
add_action('init', 'automize_child_prevent_parent_customizer', 1);

/**
 * Load parent theme customizer sections manually dengan override
 */
function automize_child_load_parent_customizer_sections() {
    // Load semua sections dari parent theme kecuali header dan footer
    $parent_sections_dir = get_template_directory() . '/inc/customizer/sections/';
    $sections_to_skip = ['header.php', 'footer.php'];
    
    if (is_dir($parent_sections_dir)) {
        $files = glob($parent_sections_dir . '*.php');
        foreach ($files as $file) {
            $filename = basename($file);
            if (!in_array($filename, $sections_to_skip)) {
                include $file;
            }
        }
    }
}
add_action('customize_register', 'automize_child_load_parent_customizer_sections', 10);

/**
 * Fix customizer options untuk child theme
 * Memastikan opsi layout header dan footer tersedia di child theme
 */
function automize_child_fix_customizer_options() {
    // Pastikan customizer parent theme dimuat
    if (function_exists('RisingBambooTheme\App\App::instance')) {
        // Hook untuk memodifikasi path template di customizer
        add_filter('rbb_customizer_template_path', 'automize_child_customizer_template_path', 10, 2);
    }
}
add_action('after_setup_theme', 'automize_child_fix_customizer_options');

/**
 * Modifikasi path template untuk customizer agar menggunakan child theme
 */
function automize_child_customizer_template_path($path, $type) {
    $child_path = get_stylesheet_directory() . '/template-parts/' . $type . '/';
    
    // Jika folder template ada di child theme, gunakan child theme
    if (is_dir($child_path) && count(glob($child_path . '*.php')) > 0) {
        return $child_path;
    }
    
    // Jika tidak ada, gunakan parent theme
    return get_template_directory() . '/template-parts/' . $type . '/';
}

/**
 * Override customizer helper untuk child theme
 */
function automize_child_override_customizer_helper() {
    if (class_exists('RisingBambooTheme\Customizer\Helper')) {
        // Hook untuk memodifikasi get_files_assoc
        add_filter('rbb_customizer_get_files_assoc', 'automize_child_get_files_assoc', 10, 2);
    }
}
add_action('init', 'automize_child_override_customizer_helper');

/**
 * Custom function untuk mendapatkan template files dari child theme atau parent theme
 */
function automize_child_get_template_files($template_type) {
    $transient_key = 'automize_child_template_files_' . $template_type;
    $result = get_transient($transient_key);
    
    if (false === $result) {
        $child_path = get_stylesheet_directory() . '/template-parts/' . $template_type . '/';
        $parent_path = get_template_directory() . '/template-parts/' . $template_type . '/';
        
        // Cek child theme dulu
        if (is_dir($child_path) && count(glob($child_path . '*.php')) > 0) {
            $files = glob($child_path . '*.php');
        } else {
            // Fallback ke parent theme
            $files = glob($parent_path . '*.php');
        }
        
        $result = [];
        foreach ($files as $file) {
            $filename = basename($file, '.php');
            $result[$filename] = ucwords(str_replace(['-', '_'], ' ', $filename));
        }
        
        // Cache hasil selama 1 jam
        set_transient($transient_key, $result, HOUR_IN_SECONDS);
    }
    
    return $result;
}

/**
 * Force refresh template files detection
 */
function automize_child_force_refresh_template_files() {
    delete_transient('automize_child_template_files_headers');
    delete_transient('automize_child_template_files_footers');
    
    // Clear WordPress cache
    wp_cache_flush();
    
    // Clear WooCommerce transients jika ada
    if (class_exists('WooCommerce')) {
        delete_transient('wc_attribute_taxonomies');
    }
}

/**
 * Modifikasi get_files_assoc untuk child theme
 */
function automize_child_get_files_assoc($files, $path) {
    // Jika path mengarah ke template-parts, cek child theme dulu
    if (strpos($path, 'template-parts') !== false) {
        $child_path = str_replace(get_template_directory(), get_stylesheet_directory(), $path);
        
        if (is_dir($child_path) && count(glob($child_path . '*.php')) > 0) {
            // Gunakan child theme files
            $child_files = [];
            $php_files = glob($child_path . '*.php');
            
            foreach ($php_files as $file) {
                $filename = basename($file, '.php');
                $child_files[$filename] = ucwords(str_replace(['-', '_'], ' ', $filename));
            }
            
            return $child_files;
        }
    }
    
    return $files;
}

/**
 * Enable demo import untuk child theme
 */
function automize_child_enable_demo_import() {
    // Pastikan Merlin setup wizard tersedia untuk child theme
    if (class_exists('Merlin')) {
        add_filter('merlin_import_files', 'automize_child_merlin_import_files');
    }
    
    // Simulasi proses yang terjadi setelah import demo
    add_action('init', 'automize_child_simulate_post_import_process', 20);
}
add_action('after_setup_theme', 'automize_child_enable_demo_import');

/**
 * Simulasi proses yang terjadi setelah import demo
 */
function automize_child_simulate_post_import_process() {
    // Clear cache seperti yang dilakukan setelah import
    wp_cache_flush();
    
    // Clear transients yang mungkin mempengaruhi template detection
    delete_transient('wc_attribute_taxonomies');
    
    // Force refresh template files detection
    automize_child_force_refresh_template_files();
    
    // Force refresh customizer options
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'customize.php') {
        // Refresh customizer saat diakses
        add_action('customize_register', 'automize_child_refresh_customizer_options', 1);
    }
}

/**
 * Refresh customizer options untuk memastikan template files terdeteksi
 */
function automize_child_refresh_customizer_options() {
    // Force refresh template files detection
    automize_child_force_refresh_template_files();
}

/**
 * Hook untuk memaksa refresh template files saat customizer dibuka
 */
function automize_child_customizer_init() {
    // Force refresh template files detection saat customizer dibuka
    automize_child_force_refresh_template_files();
}
add_action('customize_register', 'automize_child_customizer_init', 1);

/**
 * Aktifkan template files tanpa perlu import demo
 */
function automize_child_activate_template_files() {
    // Simulasi proses yang sama seperti setelah import demo
    // Clear cache
    wp_cache_flush();
    
    // Clear transients
    delete_transient('wc_attribute_taxonomies');
    
    // Force refresh template files
    automize_child_force_refresh_template_files();
    
    // Set flag bahwa template files sudah diaktifkan
    update_option('automize_child_template_files_activated', true);
}

/**
 * Check dan aktifkan template files jika belum diaktifkan
 */
function automize_child_check_and_activate_templates() {
    if (!get_option('automize_child_template_files_activated', false)) {
        automize_child_activate_template_files();
    }
}
add_action('wp_loaded', 'automize_child_check_and_activate_templates');

/**
 * Force refresh template files saat customizer dibuka
 */
function automize_child_force_refresh_on_customizer() {
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'customize.php') {
        automize_child_force_refresh_template_files();
    }
}
add_action('admin_init', 'automize_child_force_refresh_on_customizer');

/**
 * Tambahkan import files untuk child theme
 */
function automize_child_merlin_import_files($import_files) {
    // Tambahkan import files dari parent theme
    $parent_import_file = get_template_directory() . '/inc/config/theme-setup-wizard-import.php';
    if (file_exists($parent_import_file)) {
        $parent_imports = include $parent_import_file;
        if (is_array($parent_imports)) {
            $import_files = array_merge($import_files, $parent_imports);
        }
    }
    
    return $import_files;
}



<?php
/**
 * Enable WordPress Debug Logging
 * Akses via: yoursite.com/wp-content/themes/automize-child/enable-debug.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check user permissions
if (!current_user_can('manage_options')) {
    wp_die('Akses ditolak. Anda harus login sebagai administrator.');
}

echo "<h1>Enable WordPress Debug Logging</h1>";

// Check current wp-config.php
$wp_config_path = ABSPATH . 'wp-config.php';
echo "<h2>Current wp-config.php Status:</h2>";

if (file_exists($wp_config_path)) {
    echo "✅ wp-config.php exists<br>";
    
    $wp_config_content = file_get_contents($wp_config_path);
    
    // Check current debug settings
    $debug_settings = [
        'WP_DEBUG' => 'define(\'WP_DEBUG\', true);',
        'WP_DEBUG_LOG' => 'define(\'WP_DEBUG_LOG\', true);',
        'WP_DEBUG_DISPLAY' => 'define(\'WP_DEBUG_DISPLAY\', false);'
    ];
    
    echo "<h3>Current Debug Settings:</h3>";
    foreach ($debug_settings as $constant => $setting) {
        if (strpos($wp_config_content, $constant) !== false) {
            echo "✅ " . $constant . " is defined<br>";
        } else {
            echo "❌ " . $constant . " is NOT defined<br>";
        }
    }
    
    // Show the lines to add
    echo "<h3>Add these lines to wp-config.php (before 'That's all, stop editing!'):</h3>";
    echo "<pre style='background: #f1f1f1; padding: 10px;'>";
    echo "// Enable WordPress debug logging\n";
    echo "define('WP_DEBUG', true);\n";
    echo "define('WP_DEBUG_LOG', true);\n";
    echo "define('WP_DEBUG_DISPLAY', false);\n";
    echo "</pre>";
    
    // Check if we can write to wp-config.php
    if (is_writable($wp_config_path)) {
        echo "<h3>Auto-Enable Debug Logging:</h3>";
        echo "<form method='post'>";
        echo "<input type='submit' name='enable_debug' value='Enable Debug Logging' style='background: #0073aa; color: white; padding: 10px 20px; border: none; cursor: pointer;'>";
        echo "</form>";
        
        if (isset($_POST['enable_debug'])) {
            // Add debug settings to wp-config.php
            $debug_lines = "\n// Enable WordPress debug logging\n";
            $debug_lines .= "define('WP_DEBUG', true);\n";
            $debug_lines .= "define('WP_DEBUG_LOG', true);\n";
            $debug_lines .= "define('WP_DEBUG_DISPLAY', false);\n";
            
            // Find the "That's all, stop editing!" line
            $stop_editing_line = "/* That's all, stop editing! Happy publishing. */";
            if (strpos($wp_config_content, $stop_editing_line) !== false) {
                $new_content = str_replace($stop_editing_line, $debug_lines . "\n" . $stop_editing_line, $wp_config_content);
                
                if (file_put_contents($wp_config_path, $new_content)) {
                    echo "<div style='background: #d4edda; color: #155724; padding: 10px; margin: 10px 0;'>";
                    echo "✅ Debug logging enabled successfully! Please refresh the page.";
                    echo "</div>";
                } else {
                    echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 10px 0;'>";
                    echo "❌ Failed to write to wp-config.php. Please add the lines manually.";
                    echo "</div>";
                }
            } else {
                echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 10px 0;'>";
                echo "❌ Cannot find the 'That's all, stop editing!' line in wp-config.php";
                echo "</div>";
            }
        }
    } else {
        echo "<div style='background: #fff3cd; color: #856404; padding: 10px; margin: 10px 0;'>";
        echo "⚠️ wp-config.php is not writable. Please add the debug lines manually.";
        echo "</div>";
    }
    
} else {
    echo "❌ wp-config.php not found<br>";
}

echo "<br><br><a href='" . admin_url('customize.php') . "'>🎨 Buka Customizer</a>";
echo " | <a href='" . admin_url() . "'>🏠 Kembali ke Dashboard</a>";
echo "<br><br><small>Jika sudah selesai debug, Anda bisa menghapus file ini.</small>";

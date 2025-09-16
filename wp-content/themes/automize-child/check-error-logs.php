<?php
/**
 * Check Error Logs WordPress
 * Akses via: yoursite.com/wp-content/themes/automize-child/check-error-logs.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check user permissions
if (!current_user_can('manage_options')) {
    wp_die('Akses ditolak. Anda harus login sebagai administrator.');
}

echo "<h1>WordPress Error Logs Check</h1>";

// Check if WP_DEBUG_LOG is enabled
echo "<h2>Debug Settings:</h2>";
echo "WP_DEBUG: " . (defined('WP_DEBUG') && WP_DEBUG ? 'ON' : 'OFF') . "<br>";
echo "WP_DEBUG_LOG: " . (defined('WP_DEBUG_LOG') && WP_DEBUG_LOG ? 'ON' : 'OFF') . "<br>";
echo "WP_DEBUG_DISPLAY: " . (defined('WP_DEBUG_DISPLAY') && WP_DEBUG_DISPLAY ? 'ON' : 'OFF') . "<br>";

// Check error log file location
$error_log_file = ini_get('error_log');
echo "PHP Error Log File: " . ($error_log_file ? $error_log_file : 'Not set') . "<br>";

// Check WordPress debug log
$wp_debug_log = WP_CONTENT_DIR . '/debug.log';
echo "WordPress Debug Log: " . $wp_debug_log . "<br>";

// Check if WordPress debug log exists
if (file_exists($wp_debug_log)) {
    echo "✅ WordPress debug.log exists<br>";
    
    // Get file size
    $file_size = filesize($wp_debug_log);
    echo "File size: " . size_format($file_size) . "<br>";
    
    // Show last 50 lines
    echo "<h3>Last 50 lines of debug.log:</h3>";
    $lines = file($wp_debug_log);
    $last_lines = array_slice($lines, -50);
    
    echo "<pre style='background: #f1f1f1; padding: 10px; max-height: 400px; overflow-y: auto;'>";
    foreach ($last_lines as $line) {
        // Highlight our custom logs
        if (strpos($line, 'CHILD THEME CUSTOMIZER') !== false) {
            echo "<strong style='color: #0073aa;'>" . esc_html($line) . "</strong>";
        } else {
            echo esc_html($line);
        }
    }
    echo "</pre>";
    
    // Check for our specific logs
    echo "<h3>Child Theme Customizer Logs:</h3>";
    $child_logs = array_filter($lines, function($line) {
        return strpos($line, 'CHILD THEME CUSTOMIZER') !== false;
    });
    
    if (!empty($child_logs)) {
        echo "<pre style='background: #e7f3ff; padding: 10px;'>";
        foreach ($child_logs as $log) {
            echo esc_html($log);
        }
        echo "</pre>";
    } else {
        echo "❌ No child theme customizer logs found<br>";
    }
    
} else {
    echo "❌ WordPress debug.log does not exist<br>";
    echo "<p><strong>To enable debug logging, add this to wp-config.php:</strong></p>";
    echo "<pre style='background: #f1f1f1; padding: 10px;'>";
    echo "define('WP_DEBUG', true);\n";
    echo "define('WP_DEBUG_LOG', true);\n";
    echo "define('WP_DEBUG_DISPLAY', false);\n";
    echo "</pre>";
}

// Check server error logs
echo "<h2>Server Error Logs:</h2>";
$server_logs = [
    '/var/log/apache2/error.log',
    '/var/log/nginx/error.log',
    '/var/log/httpd/error_log',
    'C:\\xampp\\apache\\logs\\error.log',
    'C:\\wamp\\logs\\apache_error.log',
    'C:\\laragon\\logs\\apache_error.log'
];

foreach ($server_logs as $log_path) {
    if (file_exists($log_path)) {
        echo "✅ Found: " . $log_path . "<br>";
    }
}

// Check PHP error log
if ($error_log_file && file_exists($error_log_file)) {
    echo "<h3>PHP Error Log (Last 20 lines):</h3>";
    $php_lines = file($error_log_file);
    $last_php_lines = array_slice($php_lines, -20);
    
    echo "<pre style='background: #f1f1f1; padding: 10px; max-height: 300px; overflow-y: auto;'>";
    foreach ($last_php_lines as $line) {
        echo esc_html($line);
    }
    echo "</pre>";
}

echo "<br><br><a href='" . admin_url('customize.php') . "'>🎨 Buka Customizer</a>";
echo " | <a href='" . admin_url() . "'>🏠 Kembali ke Dashboard</a>";
echo "<br><br><small>Jika sudah selesai debug, Anda bisa menghapus file ini.</small>";

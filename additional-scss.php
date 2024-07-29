<?php
/**
 * Plugin Name: Additional SCSS
 * Description: Custom plugin for SCSS
 * Version: 0.1
 */

if (!defined('ABSPATH')) {
    exit;
}

// Define plugin path constant
if (!defined('PLUGIN_PATH')) {
    define('PLUGIN_PATH', plugin_dir_url(__FILE__));
}

require_once plugin_dir_path(__FILE__) . 'includes/scssphp/scss.inc.php';
require_once plugin_dir_path(__FILE__) . 'admin/settings.php';
require_once plugin_dir_path(__FILE__) . 'frontend/enqueue.php';
require_once plugin_dir_path(__FILE__) . 'utils/compile.php';

// Localization
add_action('plugins_loaded', 'additional_scss_load_textdomain');
function additional_scss_load_textdomain() {
    load_plugin_textdomain('additional-scss', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
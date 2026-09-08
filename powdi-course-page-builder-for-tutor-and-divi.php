<?php

/**
 * Plugin Name: Powdi Course Page Builder for Tutor and Divi
 * Plugin URI: https://wordpress.org/plugins/powdi-course-page-builder-for-tutor-and-divi
 * Description: Disables Tutor LMS's default course page template and adds shortcodes and Divi 5 Modules to be used with Divi Builder for custom course page layouts.
 * Version: 1.1.0
 * Author: Powdi Themes
 * Author URI: https://powdithemes.com
 * License: GPL2
 * Text Domain: powdi-course-page-builder-for-tutor-and-divi
 * Prefix: powdcotu
 */
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!defined('POWDCOTU_VER')) {
    define('POWDCOTU_VER', '1.1.0');
}
if (!defined('POWDCOTU_PATH')) {
    define('POWDCOTU_PATH', plugin_dir_path(__FILE__));
}
if (!defined('POWDCOTU_URL')) {
    define('POWDCOTU_URL', plugin_dir_url(__FILE__));
}

require_once POWDCOTU_PATH . 'includes/class-powdcotu.php';

Powdcotu_Plugin::instance();

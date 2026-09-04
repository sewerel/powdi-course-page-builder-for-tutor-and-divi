<?php

/**
 * Plugin Name: Powdi Course Page Builder for Tutor and Divi
 * Plugin URI: https://wordpress.org/plugins/powdi-course-page-builder-for-tutor-and-divi
 * Description: Disables Tutor LMS's default course page template and adds shortcodes ([powdcotu_course_infobar], [powdcotu_course_action_button], [powdcotu_course_content]) to be used with Divi Builder for custom course page layouts.
 * Version: 1.0.0
 * Author: Powdi Themes
 * Author URI: https://powdithemes.com
 * License: GPL2
 * Text Domain: powdi-course-page-builder-for-tutor-and-divi
 * Prefix: powdcotu
 */
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('POWDCOTU_PATH', plugin_dir_path(__FILE__));
define('POWDCOTU_URL', plugin_dir_url(__FILE__));

require_once __DIR__ . '/includes/disable-content.php';
require_once __DIR__ . '/includes/shortcodes.php';
require_once __DIR__ . '/includes/enqueue.php';

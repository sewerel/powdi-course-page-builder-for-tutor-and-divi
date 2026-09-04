<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('powdcotu_enqueue_styles')) {
    /**
     * Enqueues the plugin's stylesheet on the Tutor LMS course page, where
     * the shortcodes can actually render.
     *
     * @return void
     */
    function powdcotu_enqueue_styles() {
        if (!function_exists('tutor') || !is_singular(tutor()->course_post_type)) {
            return;
        }

        $file = POWDCOTU_PATH . 'assets/css/style.css';
        wp_enqueue_style(
            'powdcotu-style',
            POWDCOTU_URL . 'assets/css/style.css',
            array(),
            file_exists($file) ? filemtime($file) : '1.0.0'
        );
    }
    add_action('wp_enqueue_scripts', 'powdcotu_enqueue_styles');
}

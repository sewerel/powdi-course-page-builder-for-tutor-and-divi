<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Prevents Tutor LMS's own single-course template from loading so a
 * Divi-Builder-authored page layout can render instead.
 *
 * Tutor core hooks `template_include` for the course post type at priority
 * 99 (TUTOR\Template::load_single_course_template). Running at priority 100
 * lets this override win. The `subpage` bail keeps Tutor's own learning-area
 * (lesson player / dashboard) template intact, since that's reached via the
 * same course URL with a `?subpage=` query var.
 *
 * @param string $template
 * @return string
 */
if (!function_exists('powdcotu_bypass_tutor_single_course_template')) {
    function powdcotu_bypass_tutor_single_course_template($template) {
        if (!function_exists('tutor')) {
            return $template;
        }
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only template routing check, no form data is processed and no state changes.
        if (!empty($_GET['subpage'])) {
            return $template;
        }
        if (!is_singular(tutor()->course_post_type)) {
            return $template;
        }

        $theme_template = get_single_template();
        if (!$theme_template) {
            $theme_template = locate_template(array('singular.php', 'index.php'));
        }

        return $theme_template ? $theme_template : $template;
    }
    add_filter('template_include', 'powdcotu_bypass_tutor_single_course_template', 100);
}

<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('powdcotu_wrap_shortcode_output')) {
    /**
     * Wraps a shortcode's rendered output in a common class so all
     * shortcodes can be targeted/spaced consistently with one selector.
     *
     * @param string $output
     * @param array  $css_vars Custom property name => value pairs (e.g.
     *                         ['--btn-color' => '#fff']) set as an inline
     *                         style on the wrapper; empty values are skipped
     *                         so the CSS's own var() fallback applies.
     * @return string
     */
    function powdcotu_wrap_shortcode_output($output, $css_vars = array()) {
        if ('' === $output) {
            return '';
        }

        $style = '';
        foreach ($css_vars as $prop => $value) {
            if ('' === $value || null === $value) {
                continue;
            }
            $style .= esc_attr($prop) . ':' . esc_attr($value) . ';';
        }
        $style_attr = $style ? ' style="' . $style . '"' : '';

        return '<div class="powdcotu_shortcode_wrapper"' . $style_attr . '>' . $output . '</div>';
    }
}

if (!function_exists('powdcotu_sanitize_btn_color')) {
    /**
     * Restricts a `btn_color` shortcode attribute to a hex color, a CSS
     * color keyword, or an rgb()/rgba()/hsl()/hsla() function -- rejecting
     * anything else (e.g. `;`/`{`/`}`/`url(...)`) so it can't be used to
     * break out of the wrapper's inline style attribute and inject
     * arbitrary CSS.
     *
     * @param string $value
     * @return string Sanitized value, or '' if it didn't match.
     */
    function powdcotu_sanitize_btn_color($value) {
        $value = trim((string) $value);
        if ('' === $value) {
            return '';
        }

        $hex = sanitize_hex_color($value);
        if ($hex) {
            return $hex;
        }

        if (preg_match('/^[a-zA-Z]+$/', $value)) {
            return $value; // CSS color keyword, e.g. "red", "transparent".
        }

        if (preg_match('/^(rgb|rgba|hsl|hsla)\(\s*[0-9.%,\s\/]+\)$/i', $value)) {
            return $value;
        }

        return '';
    }
}

if (!function_exists('powdcotu_sanitize_btn_width')) {
    /**
     * Restricts a `btn_width` shortcode attribute to a plain CSS length
     * (number + unit, or "auto") for the same reason as
     * powdcotu_sanitize_btn_color().
     *
     * @param string $value
     * @return string Sanitized value, or '' if it didn't match.
     */
    function powdcotu_sanitize_btn_width($value) {
        $value = trim((string) $value);
        if ('' === $value || 'auto' === $value) {
            return $value;
        }

        if (preg_match('/^\d*\.?\d+(px|em|rem|%|vw|vh)$/', $value)) {
            return $value;
        }

        return '';
    }
}

if (!function_exists('powdcotu_course_infobar_shortcode')) {
    /**
     * Returns the Tutor LMS course entry box (price / progress / enroll
     * button card) for use in Divi Builder.
     *
     * @param array|string $atts Shortcode attributes: btn_color, btn_width.
     * @return string
     */
    function powdcotu_course_infobar_shortcode($atts = array()) {
        if (!function_exists('tutor')) {
            return '';
        }
        global $post;
        if (!$post || $post->post_type !== tutor()->course_post_type) {
            return '';
        }

        $filtered_atts = shortcode_atts(array(
            'btn_color' => '',
            'btn_width' => '',
        ), $atts, 'powdcotu_course_infobar');
        $btn_color = powdcotu_sanitize_btn_color($filtered_atts['btn_color']);
        $btn_width = powdcotu_sanitize_btn_width($filtered_atts['btn_width']);

        $course_id = $post->ID;
        $user_id   = get_current_user_id();

        /**
         * templates/single/course/course-entry-box.php reads `global
         * $is_enrolled;` as its first statement, so it must be set as a
         * true PHP global before calling tutor_load_template() -- passing
         * it via the $variables array is not enough, since that only
         * extract()s into tutor_load_template()'s own local scope.
         */
        global $is_enrolled;
        // Must match Tutor core's own global, read by templates/single/course/course-entry-box.php.
        $is_enrolled = \Tutor\Models\EnrollmentModel::is_enrolled($course_id, $user_id); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

        ob_start();
        tutor_load_template('single.course.course-entry-box');
        return powdcotu_wrap_shortcode_output(ob_get_clean(), array(
            '--btn-color' => $btn_color,
            '--btn-width' => $btn_width,
        ));
    }
    add_shortcode('powdcotu_course_infobar', 'powdcotu_course_infobar_shortcode');
}

if (!function_exists('powdcotu_course_action_button_shortcode')) {
    /**
     * Returns the Tutor LMS course enroll/purchase action button, on its
     * own, for use in Divi Builder.
     *
     * @param array|string $atts Shortcode attributes: btn_color, btn_width.
     * @return string
     */
    function powdcotu_course_action_button_shortcode($atts = array()) {
        if (!function_exists('tutor')) {
            return '';
        }
        global $post;
        if (!$post || $post->post_type !== tutor()->course_post_type) {
            return '';
        }

        $filtered_atts = shortcode_atts(array(
            'btn_color' => '',
            'btn_width' => '',
        ), $atts, 'powdcotu_course_action_button');
        $btn_color = powdcotu_sanitize_btn_color($filtered_atts['btn_color']);
        $btn_width = powdcotu_sanitize_btn_width($filtered_atts['btn_width']);

        $course_id            = $post->ID;
        $user_id              = get_current_user_id();
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- invoking Tutor core's own existing filter, not defining a new one.
        $is_enrolled          = apply_filters('tutor_alter_enroll_status', \Tutor\Models\EnrollmentModel::is_enrolled($course_id, $user_id));
        $is_privileged_user   = tutor_utils()->has_user_course_content_access();
        $is_public            = \TUTOR\Course_List::is_public($course_id);
        $lesson_url           = tutor_utils()->get_course_first_lesson($course_id);
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- invoking Tutor core's own existing filter, not defining a new one.
        $tutor_course_sell_by = apply_filters('tutor_course_sell_by', null);
        $is_purchasable       = tutor_utils()->is_course_purchasable($course_id);

        ob_start();
        if ($is_enrolled || $is_privileged_user) {
            $is_completed_course = tutor_utils()->is_completed_course();
            $retake_course       = tutor_utils()->can_user_retake_course();
            if ($is_completed_course) {
                $label = $retake_course
                    ? __('Retake This Course', 'powdi-course-page-builder-for-tutor-and-divi')
                    : __('Course Completed', 'powdi-course-page-builder-for-tutor-and-divi');
            } else {
                $label = __('Continue Learning', 'powdi-course-page-builder-for-tutor-and-divi');
            }
            echo '<a class="tutor-btn tutor-btn-primary tutor-btn-block" href="' . esc_url($lesson_url) . '">' . esc_html($label) . '</a>';
        } elseif ($is_public) {
            echo '<a class="tutor-btn tutor-btn-primary tutor-btn-block" href="' . esc_url($lesson_url) . '">' . esc_html__('Start Learning', 'powdi-course-page-builder-for-tutor-and-divi') . '</a>';
        } elseif ($is_purchasable && $tutor_course_sell_by) {
            tutor_load_template('single.course.add-to-cart-' . $tutor_course_sell_by);
        } else {
?>
            <form class="tutor-enrol-course-form" method="post">
                <?php wp_nonce_field(tutor()->nonce_action, tutor()->nonce); ?>
                <input type="hidden" name="tutor_course_id" value="<?php echo esc_attr($course_id); ?>">
                <input type="hidden" name="tutor_course_action" value="_tutor_course_enroll_now">
                <button type="submit" class="tutor-btn tutor-btn-primary tutor-btn-block"><?php esc_html_e('Enroll Now', 'powdi-course-page-builder-for-tutor-and-divi'); ?></button>
            </form>
<?php
        }
        return powdcotu_wrap_shortcode_output(ob_get_clean(), array(
            '--btn-color' => $btn_color,
            '--btn-width' => $btn_width,
        ));
    }
    add_shortcode('powdcotu_course_action_button', 'powdcotu_course_action_button_shortcode');
}

if (!function_exists('powdcotu_course_content_shortcode')) {
    /**
     * Returns the Tutor LMS course curriculum (topics/lessons/quizzes
     * accordion) for use in Divi Builder.
     *
     * @return string
     */
    function powdcotu_course_content_shortcode() {
        if (!function_exists('tutor')) {
            return '';
        }
        global $post;
        if (!$post || $post->post_type !== tutor()->course_post_type) {
            return '';
        }

        $course_id = $post->ID;
        $user_id   = get_current_user_id();

        global $is_enrolled;
        // Must match Tutor core's own global, read by templates/single/course/course-topics.php.
        $is_enrolled = \Tutor\Models\EnrollmentModel::is_enrolled($course_id, $user_id); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

        ob_start();
        tutor_load_template('single.course.course-topics');
        return powdcotu_wrap_shortcode_output(ob_get_clean());
    }
    add_shortcode('powdcotu_course_content', 'powdcotu_course_content_shortcode');
}

<?php

/**
 * Template: course action button (start/continue/retake/enroll/purchase).
 *
 * Included by DTUTCourseButtons::get_content(), which sets the variables
 * below in scope before including this file.
 *
 * @var int         $course_id            Course post ID.
 * @var bool         $is_enrolled          Whether the current user is enrolled in the course.
 * @var bool         $is_privileged_user   Whether the current user can access course content without enrolling (admin/instructor).
 * @var bool         $is_public            Whether the course is marked public.
 * @var string       $lesson_url           URL of the course's first lesson.
 * @var string|null  $tutor_course_sell_by Monetization engine slug ('tutor'/'woocommerce'/'edd'), or null.
 * @var bool         $is_purchasable       Whether the course is purchasable.
 * @var string       $login_url            Login URL to use when Tutor's native login is disabled.
 */

if (! defined('ABSPATH')) {
    exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- this template's local variables are kept matching Tutor core's own single/course/course-entry-box.php naming, on purpose, so it stays easy to diff against future Tutor core updates.

if ($is_enrolled || $is_privileged_user) {

    // Course Info
    $completed_percent   = tutor_utils()->get_course_completed_percent();
    $is_completed_course = tutor_utils()->is_completed_course();
    $retake_course       = tutor_utils()->can_user_retake_course();
    $course_progress     = tutor_utils()->get_course_completed_percent($course_id, 0, true);

    // The user is enrolled anyway. No matter manual, free, purchased, woocommerce, edd, membership

    // Show Start/Continue/Retake Button
    if ($lesson_url) {
        $button_class = 'divi-tutor-button divi-tutor-course-button' .
            ($retake_course ? ' tutor-course-retake-button' : '');

        // Button identifier class
        $button_identifier = 'start-continue-retake-button';
        $element               = $retake_course ? 'button' : 'a';
?>
        <<?php echo esc_attr($element); ?> <?php echo $retake_course ? 'disabled="disabled"' : ''; ?> href="<?php echo esc_url_raw($lesson_url); ?>" class="<?php echo esc_attr($button_class . ' ' . $button_identifier); ?>" data-course_id="<?php echo esc_attr($course_id); ?>">
            <?php
            if ($retake_course) {
                esc_html_e('Retake This Course', 'powdi-course-page-builder-for-tutor-and-divi');
            } elseif ($completed_percent <= 0) {
                esc_html_e('Start Learning', 'powdi-course-page-builder-for-tutor-and-divi');
            } else {
                esc_html_e('Continue Learning', 'powdi-course-page-builder-for-tutor-and-divi');
            }
            ?>
        </<?php echo esc_attr($element); ?>>
    <?php
    }

    // Show Course Completion Button.
    //naa
    // check if has enrolled date.

} else if ($is_public) {
    // Get the first content url
    ?>
    <a href="<?php echo esc_url($lesson_url); ?>" class="divi-tutor-button divi-tutor-course-button">
        <?php esc_html_e('Start Learning', 'powdi-course-page-builder-for-tutor-and-divi'); ?>
    </a>
    <?php
} else {
    // The course enroll options like purchase or free enrolment
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- invoking Tutor core's own existing filter, not defining a new one.
    $price = apply_filters('get_tutor_course_price', null, get_the_ID());

    if ($is_purchasable && $price && $tutor_course_sell_by) {
        // Load template based on monetization option
        include POWDCOTU_PATH . "divi5-tutor-modules/partials/divi5_button-{$tutor_course_sell_by}.php";
    } else {
    ?>

        <div class="<?php echo is_user_logged_in() ? '' : 'tutor-course-entry-box-login'; ?>" data-login_url="<?php echo esc_url_raw($login_url); ?>">
            <form class="tutor-enrol-course-form" method="post">
                <?php wp_nonce_field(tutor()->nonce_action, tutor()->nonce); ?>
                <input type="hidden" name="tutor_course_id" value="<?php echo esc_attr(get_the_ID()); ?>">
                <input type="hidden" name="tutor_course_action" value="_tutor_course_enroll_now">
                <button type="submit" class="tutor-enroll-course-button divi-tutor-button divi-tutor-course-button">
                    <?php esc_html_e('Enroll now', 'powdi-course-page-builder-for-tutor-and-divi'); ?>
                </button>
            </form>
        </div>
<?php
    }
}

if (! is_user_logged_in()) {
    // Reuse Tutor core's own login modal (already wired up for the
    // `tutor-open-login-modal` trigger class used by the WooCommerce/EDD
    // add-to-cart partials above); include_once inside the helper keeps
    // repeat calls across multiple modules on one page harmless.
    add_action('wp_footer', function () {
        tutor_load_template_from_custom_path(tutor()->path . '/views/modal/login.php');
    });
}

<?php

/**
 * Template: WooCommerce add-to-cart/purchase button, included by
 * DTUTCourseButtons::get_content() when the course is sold via WooCommerce.
 *
 * @package Tutor\Templates
 * @subpackage Single\Course
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

if (! defined('ABSPATH')) {
    exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- this template is a near-verbatim copy of Tutor core's own templates/single/course/add-to-cart-woocommerce.php, kept unprefixed on purpose so it stays easy to diff against future Tutor core updates.

$product_id = tutor_utils()->get_course_product_id();
$product    = wc_get_product($product_id);

$is_logged_in             = is_user_logged_in();
$enable_guest_course_cart = tutor_utils()->get_option('enable_guest_course_cart');
$required_loggedin_class  = 'single_add_to_cart_button';
if (! $is_logged_in && ! $enable_guest_course_cart) {
    $required_loggedin_class = apply_filters('tutor_enroll_required_login_class', 'tutor-open-login-modal');
}


if ($product) {
    if (tutor_utils()->is_course_added_to_cart($product_id, true)) {
?>
        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="divi-tutor-button divi-tutor-course-button tutor-woocommerce-view-cart">
            <?php esc_html_e('View Cart', 'powdi-course-page-builder-for-tutor-and-divi'); ?>
        </a>
    <?php
    } else {
    ?>

        <form class="cart" action="<?php echo esc_url(apply_filters('tutor_course_add_to_cart_form_action', get_permalink(get_the_ID()))); ?>" method="post" enctype="multipart/form-data">
            <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="divi-tutor-button divi-tutor-course-button tutor-add-to-cart-button <?php echo esc_attr($required_loggedin_class); ?>">
                <?php echo esc_html($product->single_add_to_cart_text()); ?>
            </button>
        </form>
    <?php
    }
} else {
    ?>
    <p class="tutor-alert-warning">
        <?php esc_html_e('Please make sure that your product exists and valid for this course', 'powdi-course-page-builder-for-tutor-and-divi'); ?>
    </p>
<?php
}

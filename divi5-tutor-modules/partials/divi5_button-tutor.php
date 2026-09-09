<?php

/**
 * Template: native-Tutor add-to-cart/purchase button, included by
 * DTUTCourseButtons::get_content() when the course is sold via Tutor's
 * own monetization engine.
 *
 * @package Tutor\Templates
 * @subpackage WooCommerceIntegration
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

if (! defined('ABSPATH')) {
    exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- this template is a near-verbatim copy of Tutor core's own loop add-to-cart template, kept unprefixed on purpose so it stays easy to diff against future Tutor core updates.

use Tutor\Ecommerce\CartController;
use Tutor\Models\CartModel;

$course_id = get_the_ID();
$user_id   = get_current_user_id();

$is_course_in_user_cart = CartModel::is_course_in_user_cart($user_id, $course_id);
$cart_page_url          = CartController::get_page_url();

$conditional_class = apply_filters('tutor_native_add_to_cart_btn_class', is_user_logged_in() ? 'tutor-native-add-to-cart' : 'tutor-open-login-modal');

ob_start();

if ($is_course_in_user_cart) {
?>
    <a href="<?php echo esc_url($cart_page_url ? $cart_page_url : '#'); ?>" class="divi-tutor-button tutor-btn  <?php echo esc_attr($cart_page_url ? '' : 'tutor-cart-page-not-configured'); ?>">
        <?php esc_html_e('View Cart', 'powdi-course-page-builder-for-tutor-and-divi'); ?>
    </a>
<?php
} else {
?>

    <button data-quantity="1" class="divi-tutor-button tutor-btn <?php echo esc_attr($conditional_class); ?>" data-course-id="<?php the_ID(); ?>" rel="nofollow">
        <?php esc_html_e('Add to Cart', 'powdi-course-page-builder-for-tutor-and-divi'); ?>
    </button>

<?php
}

echo apply_filters('tutor_course_loop_add_to_cart_button', ob_get_clean(), $course_id); //phpcs:ignore

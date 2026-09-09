<?php

/**
 * Template: EDD add-to-cart/purchase button, included by
 * DTUTCourseButtons::get_content() when the course is sold via EDD.
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

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- this template is a near-verbatim copy of Tutor core's own templates/single/course/add-to-cart-edd.php, kept unprefixed on purpose so it stays easy to diff against future Tutor core updates.

$product_id = tutor_utils()->get_course_product_id();
$download   = new EDD_Download($product_id);

if ($download->ID) {
    echo edd_get_purchase_link(array('download_id' => $download->ID)); //phpcs:ignore
} else {
?>
    <p class="tutor-alert-warning">
        <?php esc_html_e('Please make sure that your EDD product exists and valid for this course', 'powdi-course-page-builder-for-tutor-and-divi'); ?>
    </p>
<?php
}

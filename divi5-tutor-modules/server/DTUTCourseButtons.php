<?php

namespace Powdcotu\Divi5Modules\Server;

if (! defined('ABSPATH')) {
    die('Direct access forbidden.');
}

// Button for starting/buing/retaking the course


use ET\Builder\Framework\DependencyManagement\Interfaces\DependencyInterface;
use ET\Builder\FrontEnd\Module\Style;
use ET\Builder\Packages\Module\Module;
use ET\Builder\Packages\Module\Options\Element\ElementClassnames;
use ET\Builder\Packages\ModuleLibrary\ModuleRegistration;

/**
 * Class that handle "Simple Quick Module" module output in frontend.
 */

class DTUTCourseButtons implements DependencyInterface {
    /**
     * Register module.
     * `DependencyInterface` interface ensures class method name `load()` is executed for initialization.
     *
     * @return void
     */
    public function load() {
        // Register module.
        add_action('init', [DTUTCourseButtons::class, 'register_module']);
    }

    /**
     * Register module.
     *
     * @return void
     */
    public static function register_module() {
        // Path to module metadata that is shared between Frontend and Visual Builder.
        $module_json_folder_path = dirname(__DIR__, 1) . '/visual-builder/src/modules/DTUTCourseButtons';

        ModuleRegistration::register_module(
            $module_json_folder_path,
            [
                'render_callback' => [DTUTCourseButtons::class, 'render_callback'],
            ]
        );
    }

    /**
     * @param array $props
     * @return string
     */
    public static function declarationFunctionButtonAlignment($props) {
        $attrValue = $props['attrValue']['alignment'] ?? '';
        if ($attrValue) {
            return "text-align:{$attrValue}";
        }
        return '';
    }

    /**
     * Render module style.
     *
     * @param array $args
     * @return void
     */
    public static function module_styles(array $args): void {
        $attrs       = $args['attrs'] ?? [];
        $elements    = $args['elements'];
        $settings    = $args['settings'] ?? [];
        $orderClass  = $args['orderClass'] ?? '';

        Style::add(
            [
                'id'            => $args['id'],
                'name'          => $args['name'],
                'orderIndex'    => $args['orderIndex'],
                'storeInstance' => $args['storeInstance'],
                'styles'        => [
                    // Module.
                    $elements->style(
                        [
                            'attrName'   => 'module',
                            'styleProps' => [
                                'disabledOn' => [
                                    'disabledModuleVisibility' => $args['settings']['disabledModuleVisibility'] ?? null,
                                ]
                            ],
                        ]
                    ),
                    $elements->style([
                        'attrName'   => 'buttons'
                    ])


                ],
            ]
        );
    }

    /**
     * Render module script data.
     *
     * @param array $args
     * @return void
     */
    public static function module_script_data($args) {
        $elements = $args['elements'];

        // Element Script Data Options.
        $elements->script_data(
            [
                'attrName' => 'module'
            ]
        );
    }

    /**
     * Render module classnames.
     *
     * @param array $args
     * @return void
     */
    public static function module_classnames($args) {
        $classnames_instance = $args['classnamesInstance'];
        $attrs               = $args['attrs'];

        // Module.
        $classnames_instance->add(
            ElementClassnames::classnames(
                [
                    'attrs' => $attrs['module']['decoration'] ?? [],
                ]
            )
        );
    }
    /**
     * @return string
     */
    public static function get_html_content() {
        // Nonce is verified in Ajax::handle_ajax()
        // phpcs:disable WordPress.Security.NonceVerification.Missing
        $preview = isset($_POST['preview']) ? sanitize_text_field(wp_unslash($_POST['preview'])) : 'auto';
        $course_id = isset($_POST['course_id']) ? absint($_POST['course_id']) : 0;
        // phpcs:enable WordPress.Security.NonceVerification.Missing
        if ('auto' !== $preview) {

            switch ($preview) {
                case 'enrolled':
                    return '<a href="#" class= "divi-tutor-button divi-tutor-course-button tutor-btn-primary start-continue-retake-button">' . esc_html__('Start Learning', 'powdi-course-page-builder-for-tutor-and-divi') . '</a>';
                    break;
                case 'started':
                    return '<a href="#" class= "divi-tutor-button divi-tutor-course-button tutor-btn-primary start-continue-retake-button">' . esc_html__('Continue Learning', 'powdi-course-page-builder-for-tutor-and-divi') . '</a>';
                    break;
                case 'finished':
                    return '<button href="#" class= "divi-tutor-button divi-tutor-course-button tutor-btn-primary start-continue-retake-button tutor-course-retake-button">' . esc_html__('Retake This Course', 'powdi-course-page-builder-for-tutor-and-divi') . '</button>';
                    break;
                case 'not_enrolled':
                    return '<div><form readonly class="tutor-enrol-course-form"><button type="submit" class="tutor-enroll-course-button divi-tutor-button divi-tutor-course-button">' . esc_html__('Enroll now', 'powdi-course-page-builder-for-tutor-and-divi') . '</button></form></div>';
                    break;
                case 'add_to_cart':
                    return '<form><button class="divi-tutor-button divi-tutor-course-button tutor-add-to-cart-button" type="submit">Add to cart</button></form>';
                    break;
                case 'view_cart':
                    return '<a href="#" class="divi-tutor-button divi-tutor-course-button tutor-woocommerce-view-cart">' . esc_html__('View Cart', 'powdi-course-page-builder-for-tutor-and-divi') . '</a>';
                    break;
            }
        } elseif (!empty($course_id)) {
            return DTUTCourseButtons::get_content($course_id);
        }
        return '';
    }
    /**
     * @param int $course_id
     * @return string
     */
    public static function get_content($course_id = 0) {
        if (!$course_id) {
            $course_id = get_the_ID();
        }
        if (!$course_id) {
            return '';
        }
        $current_user_id       = get_current_user_id();
        $lesson_url            = tutor_utils()->get_course_first_lesson($course_id);
        $is_administrator      = tutor_utils()->has_user_role('administrator');
        $is_instructor         = tutor_utils()->is_instructor_of_this_course($current_user_id, $course_id);
        $course_content_access = (bool) get_tutor_option('course_content_access_for_ia');
        $tutor_course_sell_by  = apply_filters('tutor_course_sell_by', null);
        $is_public             = get_post_meta($course_id, '_tutor_is_public_course', true) == 'yes';
        $is_enrolled           = apply_filters('tutor_alter_enroll_status', tutor_utils()->is_enrolled($course_id, $current_user_id));
        $is_privileged_user    = $course_content_access && ($is_administrator || $is_instructor);
        // Monetization info
        $monetize_by              = tutor_utils()->get_option('monetize_by');
        $is_purchasable           = tutor_utils()->is_course_purchasable($course_id);

        // Get login url if
        $is_tutor_login_disabled = ! tutor_utils()->get_option('enable_tutor_native_login', null, true, true);

        // Utility data.
        $login_url = tutor_utils()->get_option('enable_tutor_native_login', null, true, true) ? '' : wp_login_url(tutor()->current_url);

        ob_start();
        include POWDCOTU_PATH . 'divi5-tutor-modules/partials/course-buttons.php';
        return ob_get_clean();
    }

    /**
     * Render module HTML output.
     *
     * @param array  $attrs
     * @param string $content
     * @param object $block
     * @param object $elements
     * @return string
     */
    public static function render_callback($attrs, $content, $block, $elements) {

        $html_output =  self::get_content();

        return Module::render(
            [
                // FE only.
                'orderIndex'          => $block->parsed_block['orderIndex'],
                'storeInstance'       => $block->parsed_block['storeInstance'],

                // VB equivalent.
                'attrs'               => $attrs,
                'elements'            => $elements,
                'id'                  => $block->parsed_block['id'],
                'moduleClassName'     => 'divi_tutor_course_button',
                'name'                => $block->block_type->name,
                'classnamesFunction'  => [DTUTCourseButtons::class, 'module_classnames'],
                'moduleCategory'      => $block->block_type->category,
                'stylesComponent'     => [DTUTCourseButtons::class, 'module_styles'],
                'scriptDataComponent' => [DTUTCourseButtons::class, 'module_script_data'],
                'children'            => $html_output,
            ]
        );
    }
}

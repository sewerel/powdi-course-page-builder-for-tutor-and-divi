<?php

namespace Powdcotu\Divi5Modules\Server;

if (! defined('ABSPATH')) {
    die('Direct access forbidden.');
}

use ET\Builder\Framework\DependencyManagement\Interfaces\DependencyInterface;
use ET\Builder\Framework\Utility\HTMLUtility;
use ET\Builder\FrontEnd\Module\Style;
use ET\Builder\Packages\Module\Module;
use ET\Builder\Packages\Module\Options\Element\ElementClassnames;
use ET\Builder\Packages\ModuleLibrary\ModuleRegistration;


class DTUTCoursePrice implements DependencyInterface {
    /**
     * Register module.
     * `DependencyInterface` interface ensures class method name `load()` is executed for initialization.
     *
     * @return void
     */
    public function load() {
        // Register module.
        add_action('init', [DTUTCoursePrice::class, 'register_module']);
    }

    /**
     * Register module.
     *
     * @return void
     */
    public static function register_module() {
        // Path to module metadata that is shared between Frontend and Visual Builder.
        $module_json_folder_path = dirname(__DIR__, 1) . '/visual-builder/src/modules/DTUTCoursePrice';

        ModuleRegistration::register_module(
            $module_json_folder_path,
            [
                'render_callback' => [DTUTCoursePrice::class, 'render_callback'],
            ]
        );
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
                            ]
                        ]
                    ),
                    $elements->style([
                        'attrName'   => 'price'
                    ]),
                    $elements->style([
                        'attrName'   => 'freeTag'
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
        $course_id = isset($_POST['course_id']) ? absint($_POST['course_id']) : 0;
        $label     = isset($_POST['label']) ? sanitize_text_field(wp_unslash($_POST['label'])) : '';
        // phpcs:enable WordPress.Security.NonceVerification.Missing

        return self::get_content(['course_id' => $course_id, 'label' => $label]);
    }

    /**
     * @param array $atts {
     *     @type int    $course_id
     *     @type string $label
     * }
     * @return string
     */
    public static function get_content($atts) {

        if (!empty($atts['course_id'])) {
            $course_id = intval($atts['course_id']);
        } else {
            $course_id = is_singular(tutor()->course_post_type) ? get_the_ID() : 0;
        }

        ob_start();
        $price = tutor_utils()->get_course_price($course_id);
?>
        <div class="divi-tutor-course-price">
            <?php if (null != $price) : ?>
                <?php echo et_core_esc_previously(tutor_kses_html($price)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- $price is already sanitized by tutor_kses_html() (Tutor core's own wp_kses()-based HTML sanitizer); et_core_esc_previously() just marks it as already-escaped for Divi's own pass, it isn't a plain unescaped echo. 
                ?>
            <?php else : ?>
                <span class="divi-tutor-free-label">
                    <?php echo esc_html($atts['label']); ?>
                </span>
            <?php endif; ?>
        </div>
<?php
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
        $label = $attrs['freeTag']['advanced']['text']['desktop']['value'] ?? 'Free';
        $html_output =  self::get_content(['label' => $label]);

        return Module::render(
            [
                // FE only.
                'orderIndex'          => $block->parsed_block['orderIndex'],
                'storeInstance'       => $block->parsed_block['storeInstance'],

                // VB equivalent.
                'attrs'               => $attrs,
                'elements'            => $elements,
                'id'                  => $block->parsed_block['id'],
                'moduleClassName'     => 'divi_tutor_course_price',
                'name'                => $block->block_type->name,
                'classnamesFunction'  => [DTUTCoursePrice::class, 'module_classnames'],
                'moduleCategory'      => $block->block_type->category,
                'stylesComponent'     => [DTUTCoursePrice::class, 'module_styles'],
                'scriptDataComponent' => [DTUTCoursePrice::class, 'module_script_data'],
                'children'            => $html_output,
            ]
        );
    }
}

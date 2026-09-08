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


class DTUTCourseStatus implements DependencyInterface {
    /**
     * Register module.
     * `DependencyInterface` interface ensures class method name `load()` is executed for initialization.
     */
    public function load() {
        // Register module.
        add_action('init', [DTUTCourseStatus::class, 'register_module']);
    }

    /**
     * Register module.
     */
    public static function register_module() {
        // Path to module metadata that is shared between Frontend and Visual Builder.
        $module_json_folder_path = dirname(__DIR__, 1) . '/visual-builder/src/modules/DTUTCourseStatus';

        ModuleRegistration::register_module(
            $module_json_folder_path,
            [
                'render_callback' => [DTUTCourseStatus::class, 'render_callback'],
            ]
        );
    }

    /**
     * Render module style.
     */
    public static function module_styles(array $args): void {
        $attrs       = $args['attrs'] ?? [];
        $elements    = $args['elements'];
        $settings    = $args['settings'] ?? [];
        $orderClass  = $args['orderClass'] ?? '';
        $breakpoint  = $attrs['module']['advanced']['breakpoint']['desktop']['value'] ?? '980px';

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
                        'attrName'   => 'bar',
                        'styleProps' => [
                            'advancedStyles' => [

                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .divi-tutor-progress-bar,{$orderClass} .divi-tutor-progress-line",
                                        "attr" => $attrs['bar']['advanced']['thickness'] ?? null,
                                        "property" => 'height'
                                    ]
                                ]

                            ]
                        ]
                    ]),
                    $elements->style([
                        'attrName'   => 'line'
                    ])

                ],
            ]
        );
    }

    /**
     * Render module script data.
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
    public static function get_html_content() {

        return self::get_content(['course_id' => 0]);
    }
    public static function get_content($atts) {

        $visual_builder = isset($atts['course_id']);
        $course_stats = [
            'completed_percent' => '50',
            'completed_count' => '2',
            'total_count' => '4'
        ];
        if (!$visual_builder) {
            $course_id = get_the_ID();

            if (!$course_id) {
                return '';
            }
            $course_stats = tutor_utils()->get_course_completed_percent($course_id, 0, true);
        }
        if (empty($course_stats)) {
            return '';
        }
        ob_start(); ?>
        <div class="divi-tutor-progress">
            <div class="divi-tutor-single-progress-wrap">
                <div class="divi-tutor-progress-text">
                    <span class="divi-tutor-progress-text-percent">
                        <?php echo esc_attr($course_stats['completed_percent']); ?>%&nbsp;
                        <?php esc_html_e('Complete', 'tutor'); ?>
                    </span>
                    <span class="divi-tutor-progress-text-steps">
                        <?php echo esc_html($course_stats['completed_count']); ?>
                        <?php esc_html_e('of', 'tutor'); ?>
                        <?php echo esc_html($course_stats['total_count']); ?>
                    </span>
                </div>
                <div class="divi-tutor-progress-bar">
                    <div class="divi-tutor-progress-line" style="width:<?php echo esc_attr($course_stats['completed_percent']); ?>%"></div>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    /**
     * Render module HTML output.
     */
    public static function render_callback($attrs, $content, $block, $elements) {
        $html_output = self::get_content([]);

        return Module::render(
            [
                // FE only.
                'orderIndex'          => $block->parsed_block['orderIndex'],
                'storeInstance'       => $block->parsed_block['storeInstance'],

                // VB equivalent.
                'attrs'               => $attrs,
                'elements'            => $elements,
                'id'                  => $block->parsed_block['id'],
                'moduleClassName'     => 'divi_tutor_course_status',
                'name'                => $block->block_type->name,
                'classnamesFunction'  => [DTUTCourseStatus::class, 'module_classnames'],
                'moduleCategory'      => $block->block_type->category,
                'stylesComponent'     => [DTUTCourseStatus::class, 'module_styles'],
                'scriptDataComponent' => [DTUTCourseStatus::class, 'module_script_data'],
                'children'            => $html_output,
            ]
        );
    }
}

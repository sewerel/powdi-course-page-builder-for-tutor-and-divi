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


class DTUTCourseContent implements DependencyInterface {
    /**
     * Register module.
     * `DependencyInterface` interface ensures class method name `load()` is executed for initialization.
     *
     * @return void
     */
    public function load() {
        // Register module.
        add_action('init', [DTUTCourseContent::class, 'register_module']);
    }

    /**
     * Register module.
     *
     * @return void
     */
    public static function register_module() {
        // Path to module metadata that is shared between Frontend and Visual Builder.
        $module_json_folder_path = dirname(__DIR__, 1) . '/visual-builder/src/modules/DTUTCourseContent';

        ModuleRegistration::register_module(
            $module_json_folder_path,
            [
                'render_callback' => [DTUTCourseContent::class, 'render_callback'],
            ]
        );
    }

    /**
     * @param array $props
     * @return string
     */
    public static function declarationFunctionNoDivider($props) {
        $attrValue = $props['attrValue'] ?? '';
        if ('on' === $attrValue) {
            return "border-top:none!important";
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
                                ],
                                'advancedStyles' => [
                                    [
                                        "componentName" => "divi/common",
                                        "props" => [
                                            "selector" => "{$orderClass} .tutor-accordion-item:nth-last-child(n+2)",
                                            "attr" => $attrs['module']['advanced']['gap'] ?? null,
                                            "property" => 'margin-bottom'
                                        ]
                                    ]
                                ]
                            ],
                        ]
                    ),
                    $elements->style([
                        'attrName'   => 'lessons',
                        'styleProps' => [
                            'advancedStyles' => [
                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .tutor-course-content-list-item-duration",
                                        "attr" => $attrs['lessons']['advanced']['infoColor'] ?? null,
                                        "property" => 'color'
                                    ]
                                ],
                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .tutor-course-content-list-item-icon,{$orderClass} .tutor-course-content-list-item-status",
                                        "selectors" => [
                                            "desktop" => [
                                                "value" => "{$orderClass} .tutor-course-content-list-item-icon,{$orderClass} .tutor-course-content-list-item-status",
                                                "hover" => "{$orderClass} .tutor-course-content-list-item{{:hover}} .tutor-course-content-list-item-icon,{$orderClass} .tutor-course-content-list-item{{:hover}} .tutor-course-content-list-item-status"
                                            ]
                                        ],
                                        "attr" => $attrs['lessons']['advanced']['iconColor'] ?? null,
                                        "property" => 'color'
                                    ]
                                ],
                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .tutor-course-content-list-item-icon,{$orderClass} .tutor-course-content-list-item-status",
                                        "attr" => $attrs['lessons']['advanced']['iconSize'] ?? null,
                                        "property" => 'font-size'
                                    ]
                                ],



                            ]
                        ]
                    ]),
                    $elements->style([
                        'attrName'   => 'topics',
                        'styleProps' => [
                            'advancedStyles' => [
                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .tutor-accordion-item-header::after",
                                        "selectors" => [
                                            "desktop" => [
                                                "value" => "{$orderClass} .tutor-accordion-item-header::after",
                                                "hover" => "{$orderClass} .tutor-accordion-item-header{{:hover}}::after"
                                            ]
                                        ],
                                        "attr" => $attrs['topics']['advanced']['iconColor'] ?? null,
                                        "property" => 'color'
                                    ]
                                ],
                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .tutor-accordion-item-header::after",
                                        "attr" => $attrs['topics']['advanced']['iconSize'] ?? null,
                                        "property" => 'font-size'
                                    ]
                                ],
                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .tutor-accordion .tutor-accordion-item-header.is-active",
                                        "attr" => $attrs['topics']['advanced']['activeBackground'] ?? null,
                                        "property" => 'background-color'
                                    ]
                                ],
                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .tutor-accordion .tutor-accordion-item-header.is-active",
                                        "attr" => $attrs['topics']['advanced']['activeColor'] ?? null,
                                        "property" => 'color'
                                    ]
                                ],
                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .tutor-accordion-item-header.is-active::after",
                                        "selectors" => [
                                            "desktop" => [
                                                "value" => "{$orderClass} .tutor-accordion-item-header.is-active::after",
                                                "hover" => "{$orderClass} .tutor-accordion-item-header.is-active{{:hover}}::after"
                                            ]
                                        ],
                                        "attr" => $attrs['topics']['advanced']['activeIconColor'] ?? null,
                                        "property" => 'color'
                                    ]
                                ],
                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .tutor-accordion-item-header.is-active::after",
                                        "attr" => $attrs['topics']['advanced']['activeIconSize'] ?? null,
                                        "property" => 'font-size'
                                    ]
                                ],


                            ]
                        ]
                    ]),
                    $elements->style([
                        'attrName'   => 'topicsContent',
                        'styleProps' => [
                            'advancedStyles' => [
                                [
                                    "componentName" => "divi/common",
                                    "props" => [
                                        "selector" => "{$orderClass} .tutor-accordion-item .tutor-accordion-item-body-content",
                                        "attr" => $attrs['topicsContent']['advanced']['noDivider'] ?? null,
                                        "declarationFunction" => [self::class, 'declarationFunctionNoDivider']
                                    ]
                                ]
                            ]
                        ]
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
        // phpcs:ignore WordPress.Security.NonceVerification.Missing
        $course_id = isset($_POST['course_id']) ? absint($_POST['course_id']) : 0;

        if (!empty($course_id)) {
            return DTUTCourseContent::get_content($course_id);
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
            return '<p>NO COURSE FOUND</p>';
        }

        $topics      = tutor_utils()->get_topics($course_id);
        $topic_title = '';
        $is_enrolled = tutor_utils()->is_enrolled($course_id);
        $index       = 0;
        $course_content_access = (bool) get_tutor_option('course_content_access_for_ia');
        $is_administrator      = tutor_utils()->has_user_role('administrator');
        $is_instructor         = tutor_utils()->is_instructor_of_this_course(get_current_user_id(), $course_id);
        $is_privileged_user    = $course_content_access && ($is_administrator || $is_instructor);


        ob_start();
        include POWDCOTU_PATH . 'divi5-tutor-modules/partials/course-content.php';
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
                'moduleClassName'     => 'divi_tutor_course_content',
                'name'                => $block->block_type->name,
                'classnamesFunction'  => [DTUTCourseContent::class, 'module_classnames'],
                'moduleCategory'      => $block->block_type->category,
                'stylesComponent'     => [DTUTCourseContent::class, 'module_styles'],
                'scriptDataComponent' => [DTUTCourseContent::class, 'module_script_data'],
                'children'            => $html_output,
            ]
        );
    }
}

<?php

namespace Powdcotu\Divi5Modules;

if (! defined('ABSPATH')) {
    die('Direct access forbidden.');
}

use ET\Builder\VisualBuilder\Assets\PackageBuildManager;

class Loader {

    /** @var self|null */
    private static ?self $instance = null;

    /** @var string[] Module class basenames, shared across server include, style enqueue and script enqueue. */
    public $modules = [
        "DTUTCourseButtons",
        "DTUTCourseContent",
        "DTUTCoursePrice",
        "DTUTCourseStatus",
    ];

    private function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('divi_visual_builder_assets_before_enqueue_scripts', [$this, 'enqueue_visual_builder_scripts']);
    }

    /**
     * @return self
     */
    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return void
     */
    function enqueue_styles() {
        foreach ($this->modules as $name) {
            if (file_exists(POWDCOTU_PATH . "divi5-tutor-modules/styles/{$name}.css")) {
                wp_enqueue_style($name, POWDCOTU_URL . "divi5-tutor-modules/styles/{$name}.css", [], POWDCOTU_VER);
            }
        }
    }

    /**
     * @return void
     */
    function enqueue_visual_builder_scripts() {
        $data = [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('powdcotu_divi5_module_nonce'),
        ];
        foreach ($this->modules as $name) {
            PackageBuildManager::register_package_build(
                [
                    'name'   => "{$name}-visual-builder",
                    'version' => POWDCOTU_VER,
                    'script' => [
                        'src' => POWDCOTU_URL . "divi5-tutor-modules/build/{$name}.js",
                        'deps'               => [
                            'divi-module-library',
                            'divi-vendor-wp-hooks',
                            'react',
                            'jquery-core',
                            'divi-rest',
                            'wp-hooks',
                        ],
                        'data_app_window' => $data,
                        'enqueue_top_window' => false,
                        'enqueue_app_window' => true,
                    ],
                ]
            );
        }
    }

    /**
     * Requires each module's server class and adds it directly to Divi's dependency
     * tree. Must be called synchronously from inside a
     * `divi_module_library_modules_dependency_tree` callback (see
     * `Powdcotu_Plugin::maybe_register_divi5_modules()`) — that action's single
     * `do_action()` call (in Divi core's `Packages/ModuleLibrary/Modules.php`) has
     * already fully returned, and `DependencyTree::load_dependencies()` already run,
     * by the time a plain `init` hook (even priority 0) gets a chance to run, so a
     * callback registered any later than this action itself never fires.
     *
     * @param \ET\Builder\Framework\DependencyManagement\DependencyTree $dependency_tree
     * @return void
     */
    function register_dependencies($dependency_tree) {

        // Defer to Divi 5's own autoloader instead of guessing a filesystem path to it -
        // this plugin isn't a Divi child theme, so it can't assume Divi's install location.
        // Always true in practice here, since this only runs from inside Divi 5's own
        // dependency-tree hook, which fires after Divi's autoloader is registered.
        if (!interface_exists('ET\\Builder\\Framework\\DependencyManagement\\Interfaces\\DependencyInterface')) {
            return;
        }

        foreach ($this->modules as $module) {

            $path = POWDCOTU_PATH . "divi5-tutor-modules/server/{$module}.php";

            if (!file_exists($path)) {
                continue;
            }

            require_once $path;

            $class = "Powdcotu\\Divi5Modules\\Server\\{$module}";
            $dependency_tree->add_dependency(new $class());
        }
        require_once POWDCOTU_PATH . 'divi5-tutor-modules/server/Ajax.php';
    }
}
Loader::instance();

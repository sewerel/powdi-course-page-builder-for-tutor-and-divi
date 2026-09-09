<?php

if (! defined('ABSPATH')) {
    die('Direct access forbidden.');
}

if (!class_exists('Powdcotu_Plugin')) {
    /**
     * Main plugin bootstrap - owns which hooks get registered and whether the
     * native Divi 5 modules get loaded. Shortcodes live in their own file
     * (includes/shortcodes.php, self-registering) so they can be dropped as a
     * unit once Divi 4 support is no longer needed, without touching this class.
     */
    class Powdcotu_Plugin {

        /** @var self|null */
        private static ?self $instance = null;

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
        private function __construct() {
            $this->includes();
            $this->add_hooks();
        }

        /**
         * @return void
         */
        private function includes() {
            require_once POWDCOTU_PATH . 'includes/shortcodes.php';
        }

        /**
         * @return void
         */
        private function add_hooks() {
            add_filter('template_include', [$this, 'load_single_course_template'], 100);
            add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
            add_action('divi_module_library_modules_dependency_tree', [$this, 'maybe_register_divi5_modules']);
        }

        /**
         * Prevents Tutor LMS's own single-course template from loading so a
         * Divi-Builder-authored page layout can render instead.
         *
         * Tutor core hooks `template_include` for the course post type at priority
         * 99 (TUTOR\Template::load_single_course_template). Running at priority 100
         * lets this override win. The `subpage` bail keeps Tutor's own learning-area
         * (lesson player / dashboard) template intact, since that's reached via the
         * same course URL with a `?subpage=` query var.
         *
         * @param string $template
         * @return string
         */
        public function load_single_course_template($template) {
            if (!function_exists('tutor')) {
                return $template;
            }
            // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only template routing check, no form data is processed and no state changes.
            if (!empty($_GET['subpage'])) {
                return $template;
            }
            if (!is_singular(tutor()->course_post_type)) {
                return $template;
            }

            $theme_template = get_single_template();
            if (!$theme_template) {
                $theme_template = locate_template(array('singular.php', 'index.php'));
            }

            return $theme_template ? $theme_template : $template;
        }

        /**
         * Enqueues the plugin's stylesheet on the Tutor LMS course page, where
         * the shortcodes can actually render.
         *
         * @return void
         */
        public function enqueue_styles() {
            if (!function_exists('tutor') || !is_singular(tutor()->course_post_type)) {
                return;
            }

            $file = POWDCOTU_PATH . 'assets/css/style.css';
            wp_enqueue_style(
                'powdcotu-style',
                POWDCOTU_URL . 'assets/css/style.css',
                array(),
                file_exists($file) ? filemtime($file) : POWDCOTU_VER
            );
        }

        /**
         * Whether the active Divi Builder version is Divi 5.
         *
         * @return bool
         */
        public function is_divi_5() {
            static $is_divi_5 = null;
            if (!defined('ET_CORE_VERSION')) {
                return false;
            }
            if ($is_divi_5 === null) {
                $is_divi_5 = version_compare(ET_CORE_VERSION, '5.0', '>');
            }
            return $is_divi_5;
        }

        /**
         * Registers this plugin's native Divi 5 modules (Course Buttons, Course Content,
         * Course Price, Course Status) into Divi's own module dependency tree, unless the
         * divi-tutor-theme is active and already provides them.
         *
         * Hooked on `divi_module_library_modules_dependency_tree` — Divi core's own
         * documented extension point for 3rd-party modules (fired once, synchronously,
         * from `ET\Builder\Packages\ModuleLibrary\Modules.php`, itself required by
         * `et_setup_builder_5()` on `init` priority 0) — rather than on `init` directly.
         * `add_action()` for THIS hook must be registered before Divi ever fires it, which
         * happens the moment `et_setup_builder_5()` runs; a callback added any later
         * (including from a plain `init` hook at any priority, even 0) is too late, because
         * by then that one-off `do_action()` call — and the `DependencyTree::load_dependencies()`
         * call right after it, which is what actually invokes each dependency's `load()` —
         * has already returned. Registering here in the constructor (i.e. at plugin-file-load
         * time, well before `init`) guarantees we're in time regardless.
         *
         * Checking `DIVI_TUT_VER`/Divi 5 state *inside* this callback (rather than at
         * registration time) is still safe: although our plugin loads before the active
         * theme's `functions.php` runs, this callback itself only actually executes once
         * Divi 5's own bootstrap fires the hook — by which point the theme's `functions.php`
         * (and its unconditional `DIVI_TUT_VER` define, if that theme is active) has long
         * since run, and `ET_CORE_VERSION`/Divi's autoloader are both already in place.
         *
         * @param \ET\Builder\Framework\DependencyManagement\DependencyTree $dependency_tree
         * @return void
         */
        public function maybe_register_divi5_modules($dependency_tree) {
            if (defined('DIVI_TUT_VER')) {
                return;
            }
            if (!function_exists('tutor')) {
                return;
            }
            if (!$this->is_divi_5()) {
                return;
            }
            require_once POWDCOTU_PATH . 'divi5-tutor-modules/divi5-tutor-modules.php';
            \Powdcotu\Divi5Modules\Loader::instance()->register_dependencies($dependency_tree);
        }
    }
}

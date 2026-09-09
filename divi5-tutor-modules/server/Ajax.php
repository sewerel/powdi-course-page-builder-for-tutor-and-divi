<?php

namespace Powdcotu\Divi5Modules\Server;

if (! defined('ABSPATH')) {
    die('Direct access forbidden.');
}

class Ajax {
    /** @var string[] Module class basenames allowed as an ajax `context`. */
    public $allowed = [
        'DTUTCourseButtons',
        'DTUTCourseContent',
        'DTUTCoursePrice',
        'DTUTCourseStatus'
    ];

    /**
     * @return void
     */
    public function __construct() {
        add_action('wp_ajax_powdcotu_divi5_module_action', [$this, 'handle_ajax']);
    }

    /**
     * Handles the Visual Builder's sample-content ajax request for a module.
     *
     * @return void
     */
    public function handle_ajax() {
        $nonce = sanitize_text_field(wp_unslash($_POST['nonce'] ?? ''));
        if (! wp_verify_nonce($nonce, 'powdcotu_divi5_module_nonce')) {
            wp_send_json_error(['message' => 'Nonce verification failed']);
        }
        // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash -- $context is immediately checked against the $allowed whitelist below; any corruption from skipping wp_unslash() just fails that check and falls into the "Invalid context" branch, it can never reach class_exists()/get_html_content() unsanitized.
        $context = isset($_POST['context']) ? sanitize_text_field($_POST['context']) : '';

        if (empty($context) || !in_array($context, $this->allowed)) {
            wp_send_json_success(['html' => "<p>Invalid context: {$context}</p>"]);
        }
        $namespace = __NAMESPACE__ . '\\';
        $class = $namespace . $context;
        if (class_exists($class)) {
            wp_send_json_success(['html' => $class::get_html_content()]);
        } else {
            wp_send_json_success(['html' => "<p>Warning! Class named:'{$class}' does not exists!</p>"]);
        }
    }
}
new Ajax();

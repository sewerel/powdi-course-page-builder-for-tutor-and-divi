<?php

namespace Powdcotu\Divi5Modules\Server;

if (! defined('ABSPATH')) {
    die('Direct access forbidden.');
}

class Ajax {
    public $allowed = [
        'DTUTCourseButtons',
        'DTUTCourseContent',
        'DTUTCoursePrice',
        'DTUTCourseStatus'
    ];
    public function __construct() {
        add_action('wp_ajax_powdcotu_divi5_module_action', [$this, 'handle_ajax']);
    }
    public function handle_ajax() {
        $nonce = sanitize_text_field(wp_unslash($_POST['nonce'] ?? ''));
        if (! wp_verify_nonce($nonce, 'powdcotu_divi5_module_nonce')) {
            wp_send_json_error(['message' => 'Nonce verification failed']);
        }
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

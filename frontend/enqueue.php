<?php

// Enqueue compiled css
add_action('wp_enqueue_scripts', 'compile_and_enqueue_additional_scss');
function compile_and_enqueue_additional_scss() {
    $scss_additional_code = get_option('scss_additional_code');
    if ($scss_additional_code) {
        $css = compile_scss($scss_additional_code);
        if ($css) {
            wp_add_inline_style('wp-block-library', $css);
        }
    }
}

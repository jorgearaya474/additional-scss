<?php

use ScssPhp\ScssPhp\Compiler;

// Add menu page for plugin settings
function additional_scss_menu() {
    add_menu_page(
        __( 'Additional SCSS', 'additional-scss' ),
        __( 'Additional SCSS', 'additional-scss' ),
        'manage_options',
        'additional-scss',
        'additional_scss_page',
        'dashicons-format-aside',
        100
    );
}
add_action( 'admin_menu', 'additional_scss_menu' );

// Plugin setttings page
function additional_scss_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Additional SCSS', 'additional-scss'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('additional_scss_settings');
            do_settings_sections('additional-scss');
            ?>
            <textarea id="scss_additional_code" name="scss_additional_code" rows="10" cols="50"><?php echo esc_textarea(get_option('scss_additional_code')); ?></textarea>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
add_action( 'admin_init', 'additional_scss_page' );

// Register settings
function additional_scss_settings() {
    register_setting( 'additional_scss_settings', 'scss_additional_code' );
}
add_action( 'admin_init', 'additional_scss_settings' );

// Enqueue Codemirror assets
function enqueue_codemirror_assets($hook) {
    if ($hook !== 'toplevel_page_additional-scss') {
        return;
    }

    wp_enqueue_style( 'codemirror', plugins_url( 'assets/codemirror/lib/codemirror.css', __FILE__ ) );
    wp_enqueue_script( 'codemirror', plugins_url( 'assets/codemirror/lib/codemirror.js', __FILE__ ), array(), null, true );
    wp_enqueue_script( 'codemirror-css', plugins_url( 'assets/codemirror/mode/css/css.js', __FILE__ ), array( 'codemirror' ), null, true );
    wp_enqueue_script( 'codemirror-sass', plugins_url( 'assets/codemirror/mode/sass/sass.js', __FILE__ ), array( 'codemirror' ), null, true );
    wp_enqueue_script( 'additional-scss-codemirror', plugins_url( 'assets/js/additional-scss-codemirror.js', __FILE__ ), array( 'codemirror' ), null, true );
}
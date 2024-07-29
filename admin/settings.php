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
    $value = get_option('scss_additional_code');
    ?>
    <div class="wrap">
        <h1>Additional SCSS</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('additional_scss_settings');
            do_settings_sections('additional-scss');
            ?>
            <textarea id="scss_additional_code" name="scss_additional_code" rows="10" cols="50"><?php echo stripslashes( $value ); ?></textarea>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

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

    wp_enqueue_style( 'codemirror', PLUGIN_PATH  . 'assets/codemirror/lib/codemirror.css');
    wp_enqueue_script( 'codemirror', PLUGIN_PATH . 'assets/codemirror/lib/codemirror.js', array(), null, true );
    wp_enqueue_script( 'codemirror-css', PLUGIN_PATH  . 'assets/codemirror/mode/css/css.js', array( 'codemirror' ), null, true );
    wp_enqueue_script( 'codemirror-sass', PLUGIN_PATH . 'assets/codemirror/mode/sass/sass.js', array( 'codemirror' ), null, true );

    // Codemirror addons
    wp_enqueue_script('codemirror-addon-closebrackets', PLUGIN_PATH . 'assets/codemirror/addon/edit/closebrackets.js', array('codemirror'), null, true);
    wp_enqueue_script('codemirror-addon-show-hint', PLUGIN_PATH . 'assets/codemirror/addon/hint/show-hint.js', array('codemirror'), null, true);
    wp_enqueue_style('codemirror-addon-show-hint', PLUGIN_PATH . 'assets/codemirror/addon/hint/show-hint.css');

    // Editor settings
    wp_enqueue_script( 'additional-scss-codemirror', PLUGIN_PATH . 'assets/js/additional-scss-codemirror.js', array( 'codemirror' ), null, true );
}
add_action('admin_enqueue_scripts', 'enqueue_codemirror_assets');

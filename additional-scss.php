<?php
/**
 * Plugin Name: Additional SCSS
 * Description: Custom plugin for SCSS
 * Version: 0.01
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/scssphp/scss.inc.php';

// Asegúrate de que SCSSPHP esté instalado y cargado

use ScssPhp\ScssPhp\Compiler;



// Add menu page
add_action('admin_menu', 'additional_scss_menu');

function additional_scss_menu() {
    add_menu_page(
        'Additional SCSS',
        'Additional SCSS',
        'manage_options',
        'additional-scss',
        'additional_scss_page',
        'dashicons-format-aside',
        100
    );
}

function additional_scss_page(){
    ?>
    <div class="wrap">
        <h1>Additional SCSS</h1>
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

add_action('admin_init', 'additional_scss_settings');
function additional_scss_settings() {
    register_setting('additional_scss_settings', 'scss_additional_code');
}

add_action('wp_enqueue_scripts', 'compile_and_enqueue_additional_scss');

function compile_and_enqueue_additional_scss() {
    $scss_additional_code = get_option('scss_additional_code');
    if ($scss_additional_code) {
        
        $compiler = new Compiler();

    try {
        $css = $compiler->compileString($scss_additional_code)->getCss();
        // Enqueue the compiled CSS
        wp_add_inline_style('wp-block-library', $css);
    } catch (Exception $e) {
        error_log('SCSS compilation error: ' . $e->getMessage());
    }
    }
}

function compile_scss($sass_code) {
    // Utilizar la librería scssphp para compilar el SASS a CSS
    $scss = new \ScssPhp\ScssPhp\Compiler();
    try {
        $css = $scss->compileString($sass_code);
        return $css;
    } catch (Exception $e) {
        // Manejar errores de compilación aquí.
        return '';
    }
}

add_action('admin_enqueue_scripts', 'enqueue_codemirror_assets');

function enqueue_codemirror_assets($hook) {
    // Carga los archivos solo en la página de tu plugin.
    if ($hook !== 'toplevel_page_additional-scss') { // Actualiza el slug aquí
        return;
    }

    // Enqueue CodeMirror CSS and JS files.
    wp_enqueue_style('codemirror', plugins_url('codemirror/lib/codemirror.css', __FILE__));
    wp_enqueue_script('codemirror', plugins_url('codemirror/lib/codemirror.js', __FILE__), array(), null, true);
    wp_enqueue_script('codemirror-css', plugins_url('codemirror/mode/css/css.js', __FILE__), array('codemirror'), null, true);
    wp_enqueue_script('codemirror-sass', plugins_url('codemirror/mode/sass/sass.js', __FILE__), array('codemirror'), null, true);

    // Enqueue custom JS to initialize CodeMirror.
    wp_enqueue_script('additional-scss-codemirror', plugins_url('additional-scss-codemirror.js', __FILE__), array('codemirror'), null, true);
}

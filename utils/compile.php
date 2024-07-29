<?php

use ScssPhp\ScssPhp\Compiler;

// Compile SCSS function
function compile_scss($sass_code) {
    $scss = new Compiler();
    try {
        return $scss->compileString($sass_code)->getCss();
    } catch (Exception $e) {
        error_log('SCSS compilation error: ' . $e->getMessage());
        return '';
    }
}

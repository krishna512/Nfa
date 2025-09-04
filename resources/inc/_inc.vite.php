<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

// default server address, port and entry point can be customized in vite.config.json
define('VITE_SERVER', 'http://localhost:2222');
define('VITE_ENTRY_POINT', '/src/app.js');

/**
 * ==========================================================
 * Enqueue files based  on development or production mode
 * ==========================================================
 */
add_action('wp_enqueue_scripts', function () {

    if (defined('IS_VITE_DEVELOPMENT')) {

        // Develoment Mode
        // insert hmr into head for live reload
        // function vite_head_module_hook()
        // {
        //     echo '<script type="module" crossorigin src="' . VITE_SERVER . VITE_ENTRY_POINT . '"></script>';
        // }
        // add_action('wp_head', 'vite_head_module_hook');

        wp_enqueue_script(
            'main-script',
            VITE_SERVER . VITE_ENTRY_POINT,
            array('jquery'),
            _THEME_VERSION,
            true
        );
    } else {

        // Production Mode
        wp_enqueue_style(
            'main-style',
            get_stylesheet_directory_uri() . '/dist/app.min.css',
            [],
            filemtime(get_stylesheet_directory() . '/dist/app.min.css')
        );

        wp_enqueue_script(
            'main-script',
            get_stylesheet_directory_uri() . '/dist/app.min.js',
            array('jquery'),
            _THEME_VERSION,
            true
        );
    }
}, 11);

function change_type_attribute($tag, $handle)
{
    $scripts_to_defer = array(
        'vite-script',
    );
    //check if this script is in the array
    if (!is_admin() && in_array($handle, $scripts_to_defer)) {
        //return with defer
        return str_replace(' type="text/javascript"', ' type="module" crossorigin', $tag);
    } else {
        //return without defer
        return $tag;
    }
}
add_filter('script_loader_tag', 'add_type_attribute', 11, 20);

function add_type_attribute($tag, $handle, $src)
{
    // if not your script, do nothing and return original $tag
    if ('main-script' !== $handle) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" crossorigin src="' . esc_url($src) . '"></script>';
    return $tag;
}

/**
 * ==========================================================
 * theme's styles for editor block
 * ==========================================================
 */
$styleURL = 'dist/app.min.css';

add_editor_style($styleURL);

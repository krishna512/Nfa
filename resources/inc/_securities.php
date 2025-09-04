<?php

/**
 *  wp security hooks
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


/**
 * =========================================
 * nonce_life
 * https://developer.wordpress.org/reference/hooks/nonce_life/
 *=========================================
 */
add_filter('nonce_life', function () {
    return 30 * MINUTE_IN_SECONDS;
});


/**
 *=========================================
 * Disable rest api for not logged in user if the _nonce is not verified
 * https://developer.wordpress.org/reference/hooks/rest_authentication_errors/
 *=========================================
 */

add_filter('rest_authentication_errors',  'png_rest_auth');
function png_rest_auth($access) {
    if (true === $access || is_wp_error($access)) {
        return $access;
    }

    $_nonce = (isset($_REQUEST['_nonce'])) ? $_REQUEST['_nonce'] : '';
    if (!wp_verify_nonce($_nonce, home_url(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)))) {
        if (!is_user_logged_in()) {
            return new WP_Error(
                'rest_disabled',
                __('The WordPress REST API has been disabled.'),
                array(
                    'status' => rest_authorization_required_code(),
                )
            );
        }
    }
}

/**
 *==============================
 * Hide wordpress version
 *==============================
 */
add_filter('the_generator', '__return_empty_string');
remove_action('wp_head', 'wp_generator');

/**
 * =========================================================
 * Hide style and script version 
 * https://developer.wordpress.org/reference/hooks/style_loader_src/
 * https://developer.wordpress.org/reference/hooks/script_loader_src/
 * =========================================================
 */
function remove_version_from_scripts_styles($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'remove_version_from_scripts_styles', 9999);
add_filter('script_loader_src', 'remove_version_from_scripts_styles', 9999);


/**
 *==============================
 * Disable xmlrpc and pingback
 *==============================
 */

add_filter('xmlrpc_enabled', '__return_false');
add_filter('wp_headers', 'disable_x_pingback');
function disable_x_pingback($headers) {
    unset($headers['X-Pingback']);

    return $headers;
}

// Disable Self Pingbacks
add_action('pre_ping', function (&$links) {
    $home = get_option('home');
    foreach ($links as $l => $link) {
        if (0 === strpos($link, $home)) {
            unset($links[$l]);
        }
    }
});


/**
 *================================================================
 * Completely Disable Comments since we dont have comment feature
 *================================================================
 */
disable_comment_feature();
function disable_comment_feature() {
    add_action('admin_init', function () {
        // // Redirect any user trying to access comments page
        global $pagenow;
        if ($pagenow === 'edit-comments.php') {
            wp_safe_redirect(admin_url());
            exit;
        }
        // Remove comments metabox from dashboard
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

        // Disable support for comments and trackbacks in post types
        foreach (get_post_types() as $post_type) {
            if ($post_type != 'update') {
                if (post_type_supports($post_type, 'comments')) {
                    remove_post_type_support($post_type, 'comments');
                    remove_post_type_support($post_type, 'trackbacks');
                }
            }
        }

        // Remove comments page in menu
        remove_menu_page('edit-comments.php');
    });

    // // Close comments on the front-end
    add_filter('comments_open', '__return_false', 20, 2);
    add_filter('pings_open', '__return_false', 20, 2);

    // // Hide existing comments
    add_filter('comments_array', '__return_empty_array', 10, 2);

    // Remove comments links from admin bar
    add_action('init', function () {
        if (is_admin_bar_showing()) {
            remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
        }
    });

    // Disable Comment Form Website URL
    add_filter('comment_form_default_fields', function ($fields) {
        if (isset($fields['url'])) {
            unset($fields['url']);
        }
        return $fields;
    }, 150);
}



/**
 *==============================
 * Disable wlwmanifest link
 *==============================
 */
remove_action('wp_head', 'wlwmanifest_link');


/**
 * =========================================================
 * header protection
 * https://developer.wordpress.org/reference/hooks/send_headers/
 * Add header to stop site loading in an iFrame.
 * =========================================================
 **/
function header_protection() {
    header('X-FRAME-OPTIONS: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('X-Content-Type-Options: nosniff');
    header('X-XSS-Protection: 1; mode=block');
    header("Content-Security-Policy: frame-ancestors 'self';");
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    header("Permissions-Policy: geolocation=(self), microphone=(), camera=(), payment=(), fullscreen=*");
    header("X-Permitted-Cross-Domain-Policies: none");
    // header("Access-Control-Allow-Origin: " . home_url());
}
add_action('send_headers', 'header_protection');

/**
 * ================================================
 * ================================================
 */
add_action('wp_dashboard_setup', 'remove_dashboard_widgets', 99999);
function remove_dashboard_widgets() {
    global $wp_meta_boxes;

    unset($wp_meta_boxes['dashboard']['normal']['core']['happy_addons_news_update']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['e-dashboard-overview']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);

    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
}


/**
 * ================================================
 * https://developer.wordpress.org/reference/classes/wp_admin_bar/add_menu/
 * https://developer.wordpress.org/reference/classes/wp_admin_bar/remove_menu/
 * ================================================
 */
function modify_top_admin_bar_menu($wp_admin_bar) {
    $wp_admin_bar->remove_menu('customize');
    $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_node('new-content');
}
add_action('admin_bar_menu', 'modify_top_admin_bar_menu', 99);



/**
 * =========================================================
 * Disable plugin installation, update
 * To re-enable plugin installations or updates need to remove disable_plugin_modifications
 * =========================================================
 */
// add_action('admin_init', 'disable_plugin_modifications');
// function disable_plugin_modifications() {
//     // Disable plugin and theme editor
//     define('DISALLOW_FILE_EDIT', true);

//     // Disable plugin and theme installation, updates, and deletion
//     define('DISALLOW_FILE_MODS', true);
// }

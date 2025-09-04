<?php if (!defined('_THEME_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_THEME_VERSION', '1.0.0');
}

// theme set up
if (!function_exists('theme_setup')) {
	function theme_setup()
	{

		// custom logo
		add_theme_support('custom-logo');

		// manage document title
		add_theme_support('title-tag');

		// Post Thumbnails on posts and pages.
		add_theme_support('post-thumbnails');

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// remove_theme_support( 'widgets-block-editor' );

		// register location for nav menus
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'nfa'),
				'primary-mobile-menu' => ('Primary Mobile'),
				'top-secondary-menu' =>  esc_html__('Top Secondary Menu'),
				'single_work-menu' =>  esc_html__('Single page Work Menu'),
				'footer-about-menu' =>  esc_html__('Footer About Menu'),
				'footer-resources-menu' =>  esc_html__('Footer Resources Menu'),
				'footer-works-menu' =>  esc_html__('Footer Works Menu'),
                'sticky-menu' =>  esc_html__('Sticky Menu'),
			)
		);

		// allows the use of HTML5 markup for the 
		// search forms, comment forms, comment lists, gallery, and caption
		add_theme_support(
			'html5',
			array(
				'navigation-widgets',
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}

	add_action('after_setup_theme', 'theme_setup');
}


/**
 * ===================================================
 * theme's styles for gutenberg
 * ===================================================
 */
$editor_stylesheet_path = 'dist/css/app.css';
add_editor_style($editor_stylesheet_path);


/**
 * ===================================================
 * include custom functions
 * ===================================================
 */
require_once dirname(__FILE__) . '/resources/inc/includes.php';


// Theme General Settings

if (function_exists('acf_add_options_page')) {


	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug' => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect' => false
		)
	);
}



// Register ACF Blocks
function nfa_register_acf_blocks()
{
	$path = dirname(__FILE__) . '/resources/blocks';

	foreach (new \DirectoryIterator($path) as $file) {
		if ($file->isDot())
			continue;

		if ($file->isDir()) {
			$dir = $path . '/' . $file->getFilename();
			$files = scandir($dir);

			foreach ($files as $filename) {

				if ($filename === '.' or $filename === '..')
					continue;

				$path_info_folder = pathinfo($filename);

				// handle is same as folder name
				$handle = $file->getFilename();

				// file inside the folder
				$assetPath = get_template_directory_uri() . '/resources/blocks/' . $handle . '/' . $filename;

				// register block if json file found
				if ($path_info_folder['extension'] == 'json' && $filename) {
					register_block_type($dir . '/' . $path_info_folder['basename']);
				}

				// register css file with handle id same as its folder name
				if ($path_info_folder['extension'] == 'css' && $filename) {
					wp_register_style($handle, $assetPath);
				}

				// register js file with handle id same as its folden name
				if ($path_info_folder['extension'] == 'js' && $filename) {
					wp_register_script($handle, $assetPath, ['jquery']);
				}
			}
		}
	}
}

add_action('init', 'nfa_register_acf_blocks');


// block asset optimization
add_filter('should_load_separate_core_block_assets', '__return_true');

/**
 *==============================
 * Disable wordpress default post type
 *==============================
 */
function remove_default_post_type($args, $postType) {
  if ($postType === 'post') {
      $args['public']                = false;
      $args['show_ui']               = false;
      $args['show_in_menu']          = false;
      $args['show_in_admin_bar']     = false;
      $args['show_in_nav_menus']     = false;
      $args['can_export']            = false;
      $args['has_archive']           = false;
      $args['exclude_from_search']   = true;
      $args['publicly_queryable']    = false;
      $args['show_in_rest']          = false;
  }

  return $args;
}
add_filter('register_post_type_args', 'remove_default_post_type', 0, 2);

/**
 *==============================
 * Hide wordpress version
 *==============================
 */
add_filter('the_generator', '__return_empty_string');
remove_action('wp_head', 'wp_generator');


/**
 * =========================================================
 * Disable plugin installation, update
 * To re-enable plugin installations or updates need to remove disable_plugin_modifications
 * =========================================================
 */
// add_action('admin_init', 'disable_plugin_modifications');
function disable_plugin_modifications()
{
    // Disable plugin and theme editor
    define('DISALLOW_FILE_EDIT', true);
    // Disable plugin and theme installation, updates, and deletion
    define('DISALLOW_FILE_MODS', true);
}
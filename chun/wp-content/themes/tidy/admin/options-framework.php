<?php
/**
 * Tidy Options Framework
 *
 * @package   Tidy Options Framework
 * @author    Devin Price <devin@wptheming.com>
 * @license   GPL-2.0+
 * @link      http://wptheming.com
 * @copyright 2013 WP Theming
 *
 * @subpackage Tidy
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Don't load if tidy_themeoptions_init is already defined
if ( ! function_exists( 'tidy_themeoptions_init' ) ) :

$tidy_get_theme_info = wp_get_theme();

define( 'THEMENAME', $tidy_get_theme_info->get( 'Name' ) );
define( 'VERSION',  $tidy_get_theme_info->get( 'Version' ) );

function tidy_themeoptions_init() {

	//  If user can't edit theme options, exit
	if ( ! current_user_can( 'edit_theme_options' ) )
		return;

	// Loads the required Tidy Options Framework classes.
	require TIDY_ADMIN_DIRECTORY_PATH . '/includes/class-options-framework.php';
	require TIDY_ADMIN_DIRECTORY_PATH . '/includes/class-options-framework-admin.php';
	require TIDY_ADMIN_DIRECTORY_PATH . '/includes/class-options-interface.php';
	require TIDY_ADMIN_DIRECTORY_PATH . '/includes/class-options-media-uploader.php';
	require TIDY_ADMIN_DIRECTORY_PATH . '/includes/class-options-sanitization.php';

	// Instantiate the main plugin class.
	$tidy_options_framework = new Tidy_Options_Framework;
	$tidy_options_framework->init();

	// Instantiate the options page.
	$tidy_options_framework_admin = new Tidy_Options_Framework_Admin;
	$tidy_options_framework_admin->init();

	// Instantiate the media uploader class
	$tidy_options_framework_media_uploader = new Tidy_Options_Framework_Media_Uploader;
	$tidy_options_framework_media_uploader->init();

}

add_action( 'init', 'tidy_themeoptions_init', 20 );

endif;


/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */

if ( ! function_exists( 'tidy_of_get_option' ) ) :

function tidy_of_get_option( $name, $default = false ) {
	$config = get_option( 'tidy_optionsframework' );

	if ( ! isset( $config['id'] ) ) {
		return $default;
	}

	$options = get_option( $config['id'] );

	if ( isset( $options[$name] ) ) {
		return $options[$name];
	}

	return $default;
}

endif;

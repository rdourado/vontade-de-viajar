<?php
/**
 * VdV functions and definitions
 *
 * This file must be parseable by PHP 5.2.
 *
 * @package vdv
 */

// Setup autoloader.
require get_template_directory() . '/vendor/autoload.php';

// Load the `vdv()` entry point function.
require get_template_directory() . '/inc/functions.php';

// Initialize the theme.
call_user_func( 'RDourado\VdV\vdv' );

$dotenv = Dotenv\Dotenv::createImmutable( ABSPATH );
$dotenv->safeLoad();

/**
 * ============================================
 * Everything after this has not been reviewed.
 * ============================================
 */

global $posts_to_skip;
$posts_to_skip = array();

if ( ! is_admin() && ! function_exists( 'get_field' ) ) {
	wp_die( __( 'Por favor, instale o plugin <a href="https://www.advancedcustomfields.com/pro/">Advanced Custom Fields Pro</a>.', 'vdv' ), __( 'Plugin não encontrado', 'vdv' ) );
}

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Filters
 */
require get_theme_file_path( '/inc/filters.php' );

/**
 * Actions
 */
require get_theme_file_path( '/inc/actions.php' );

/**
 * View Counter
 */
require get_theme_file_path( '/inc/counter.php' );

/**
 * Customizer additions
 */
require get_theme_file_path( '/inc/customizer.php' );

/**
 * Custom login
 */
require get_theme_file_path( '/inc/custom-login.php' );

/**
 * Theme widgets
 */
require get_theme_file_path( '/inc/widgets.php' );

/**
 * ACF fields and hooks
 */
require get_theme_file_path( '/inc/acf.php' );

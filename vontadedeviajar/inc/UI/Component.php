<?php
/**
 * RDourado\VdV\UI\Component class
 *
 * @package vdv
 */

namespace RDourado\VdV\UI;

use RDourado\VdV\Component_Interface;
use function RDourado\VdV\vdv;
use WP_Post;
use function add_action;
use function add_filter;
use function get_theme_file_uri;
use function get_theme_file_path;
use function wp_enqueue_script;
use function wp_script_add_data;

/**
 * Class for improving UI among various core features.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'ui';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_enqueue_scripts', array( $this, 'action_enqueue_ui_scripts' ) );
		add_filter( 'nav_menu_link_attributes', array( $this, 'filter_nav_menu_link_attributes_aria_current' ), 10, 2 );
		add_filter( 'page_menu_link_attributes', array( $this, 'filter_nav_menu_link_attributes_aria_current' ), 10, 2 );
	}

	/**
	 * Undocumented function
	 */
	public function action_enqueue_ui_scripts() {
		if ( vdv()->is_amp() ) {
			return;
		}

		$js_uri = get_theme_file_uri( '/assets/js/app.js' );
		$js_dir = get_theme_file_path( '/assets/js/app.js' );

		wp_enqueue_script( 'vdv-ui', $js_uri, array(), vdv()->get_asset_version( $js_dir ), true );
		wp_script_add_data( 'vdv-ui', 'defer', true );

		if ( is_single() ) {
			wp_enqueue_script( 'comment-reply' );
		} elseif ( is_page( 'contato' ) && function_exists( 'wpcf7_enqueue_scripts' ) ) {
			wpcf7_enqueue_scripts();
		}
	}

	/**
	 * Filters the HTML attributes applied to a menu item's anchor element.
	 *
	 * Checks if the menu item is the current menu item and adds the aria "current" attribute.
	 *
	 * @param array   $atts The HTML attributes applied to the menu item's `<a>` element.
	 * @param WP_Post $item The current menu item.
	 * @return array Modified HTML attributes
	 */
	public function filter_nav_menu_link_attributes_aria_current( array $atts, WP_Post $item ) : array {
		if ( isset( $item->current ) ) {
			if ( $item->current ) {
				$atts['aria-current'] = 'page';
			}
		} elseif ( ! empty( $item->ID ) ) {
			global $post;

			if ( ! empty( $post->ID ) && (int) $post->ID === (int) $item->ID ) {
				$atts['aria-current'] = 'page';
			}
		}

		return $atts;
	}
}

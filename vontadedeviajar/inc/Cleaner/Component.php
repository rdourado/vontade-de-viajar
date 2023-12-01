<?php
/**
 * RDourado\VdV\Cleaner\Component class
 *
 * @package vdv
 */

namespace RDourado\VdV\Cleaner;

use RDourado\VdV\Component_Interface;
use function add_action;
use function remove_action;
use function esc_url;
use function home_url;

/**
 * Class for removing useless WP features.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'cleaner';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'init', array( $this, 'clear_header' ) );
		add_action( 'init', array( $this, 'disable_wp_emojis' ) );
		add_action( 'init', array( $this, 'disable_wp_embed' ) );
		add_action( 'pre_ping', array( $this, 'no_self_ping' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_dashicon' ) );
	}

	/**
	 * Undocumented function
	 */
	public function clear_header() {
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
	}

	/**
	 * Disable WP Emojis, except for Posts
	 */
	public function disable_wp_emojis() {
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		if ( ! is_single() ) {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
		}
	}

	/**
	 * Remove `wp-embed.min.js`
	 */
	public function disable_wp_embed() {
		if ( ! is_admin() ) {
			wp_deregister_script( 'wp-embed' );
		}
	}

	/**
	 * Undocumented function
	 *
	 * @param array $links
	 */
	public function no_self_ping( &$links ) {
		$home = esc_url( home_url() );
		foreach ( $links as $index => $link ) {
			if ( 0 === strpos( $link, $home ) ) {
				unset( $links[ $index ] );
			}
		}
	}

	/**
	 * Undocumented function
	 */
	public function dequeue_dashicon() {
		if ( ! is_user_logged_in() ) {
			wp_deregister_style( 'dashicons' );
		}
	}

}

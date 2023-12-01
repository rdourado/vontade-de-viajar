<?php
/**
 * RDourado\VdV\Transients\Component class
 *
 * @package vdv
 */

namespace RDourado\VdV\Transients;

use RDourado\VdV\Component_Interface;
use RDourado\VdV\Templating_Component_Interface;
use function wp_json_encode;
use function get_transient;
use function set_transient;

/**
 * Class for managing theme transients.
 *
 * @link https://codex.wordpress.org/Transients_API
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Undocumented variable
	 *
	 * @var string
	 */
	private $transient_name = null;

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'transients';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `vdv()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return array(
			'cache_get' => array( $this, 'cache_get' ),
			'cache_set' => array( $this, 'cache_set' ),
		);
	}

	/**
	 * Undocumented function
	 *
	 * @param mixed $unsanitized_name
	 * @return string|bool
	 */
	public function cache_get( $unsanitized_name ) {
		$sanitized_name       = md5( wp_json_encode( $unsanitized_name ) );
		$this->transient_name = $sanitized_name;
		$stored_value         = get_transient( $this->transient_name );

		if ( false !== $stored_value ) {
			return $stored_value;
		} else {
			ob_start();
			return false;
		}
	}

	/**
	 * Undocumented function
	 *
	 * @param integer $expiration
	 * @return void
	 */
	public function cache_set( $expiration = MONTH_IN_SECONDS ) {
		$value = ob_get_flush();
		set_transient( $this->transient_name, $value, $expiration );
		$this->transient_name = null;
	}
}

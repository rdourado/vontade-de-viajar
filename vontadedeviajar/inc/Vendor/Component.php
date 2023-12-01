<?php
/**
 * RDourado\VdV\Vendor\Component class
 *
 * @package vdv
 */

namespace RDourado\VdV\Vendor;

use RDourado\VdV\Component_Interface;
use function add_action;

/**
 * Class for managing external vendor scripts.
 */
class Component implements Component_Interface {

	/**
	 * Undocumented variable
	 *
	 * @var string
	 */
	private $gtm_container_id = 'GTM-5K75K84';

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'vendor';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_head', array( $this, 'gtm_head' ), 1 );
		add_action( 'wp_body_open', array( $this, 'gtm_body' ), 1 );
	}

	/**
	 * Undocumented function
	 */
	public function gtm_head() {
		$id = $this->gtm_container_id;
		?>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','<?php echo esc_attr( $id ); ?>');</script>
		<!-- End Google Tag Manager -->
		<?php
	}

	/**
	 * Undocumented function
	 */
	public function gtm_body() {
		$id = $this->gtm_container_id;
		?>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( $id ); ?>"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<?php
	}

}

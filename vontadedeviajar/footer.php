<?php
/**
 * The footer for our theme
 *
 * @package vdv
 */

namespace RDourado\VdV;

?>

<hr class="vdv-hr">

<footer class="vdv-foot" id="footer">
	<aside class="vdv-foot__partners">
		<h4 class="vdv-foot__heading"><?php esc_html_e( 'Parcerias', 'vdv' ); ?></h4>
		<div class="vdv-foot__logos"><?php dynamic_sidebar( 'footer' ); ?></div>
	</aside>

	<?php get_template_part( 'template-parts/footer/belief' ); ?>

	<div class="vdv-footer">
		<?php get_template_part( 'template-parts/footer/newsletter' ); ?>

		<nav class="vdv-footer__nav">
			<?php vdv_menu( 'footer', 'vdv-footer__menu', 1 ); ?>
			<?php vdv_menu( 'social', 'vdv-footer__social', 1 ); ?>
		</nav>

		<p class="vdv-footer__copyright">
			<?php
			/* translators: %d: ano atual */
			$copy = sprintf( __( '&copy; %d Vontade de Viajar', 'vdv' ), gmdate( 'Y' ) );
			echo ( $copy );
			?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>

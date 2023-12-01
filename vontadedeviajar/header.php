<?php
/**
 * The header for our theme
 *
 * @package vdv
 */

namespace RDourado\VdV;

?>
<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class( 'vdv-body' ); ?>>

		<?php wp_body_open(); ?>

		<header class="vdv-head">

			<div class="vdv-head__navigation">
				<?php vdv_logo(); ?>
				<button type="button" class="vdv-head__toggle">
					<span></span>
					<span></span>
					<span></span>
				</button>
				<nav class="vdv-nav">
					<?php vdv_menu( 'primary', 'vdv-nav__menu vdv-menu' ); ?>
					<?php get_search_form(); ?>
				</nav>
			</div>

			<div class="vdv-head__contact">
				<ul class="vdv-head__contact-wrap">
					<li class="vdv-head__shortcut">
						<?php /* TODO: Allow this to be managed on WP */ ?>
						<a class="vdv-head__anchor-news" href="http://eepurl.com/M4TtP" target="_blank">
							<?php esc_html_e( 'Receba as melhores dicas no seu email', 'vdv' ); ?>
						</a>
					</li>
					<li class="vdv-head__social">
						<span><?php esc_html_e( 'Siga-nos', 'vdv' ); ?></span>
						<?php vdv_menu( 'social', 'vdv-head__social-links', 1 ); ?>
					</li>
				</ul>
			</div>

		</header>

<?php
global $post, $page_id;
$page_id = get_option( 'page_on_front' );
get_header();
?>

<main class="vdv-main">
	<?php vdv_loop_rows( 'vdv_highlights', 'template-parts/sections/hero', 1 ); ?>
	<div class="vdv-content vdv-features">
		<?php vdv_loop_rows( 'vdv_highlights', 'template-parts/loop/primary' ); ?>
	</div>

	<hr class="vdv-hr">

	<div class="vdv-sidebar">
		<?php
		$cache_key = md5( 'vdv_box_1' );
		$cache_str = get_transient( $cache_key );
		if ( false === $cache_str ) {

			ob_start();

			while ( have_rows( 'vdv_box_1', $page_id ) ) {
				the_row();
				$title = get_sub_field( 'title' );
				$post  = get_sub_field( 'post' );
				if ( $post ) {
					setup_postdata( $post );
					if ( is_object_in_term( get_the_ID(), 'tema', 'tres-dicas' ) ) {
						get_template_part( 'template-parts/loop/box', 'tres-dicas' );
					} else {
						get_template_part( 'template-parts/loop/box' );
					}
					wp_reset_postdata();
				}
			}

			$cache_str = ob_get_clean();
			set_transient( $cache_key, $cache_str, MONTH_IN_SECONDS );

		}
		echo ( $cache_str );
		?>
	</div>


	<hr class="vdv-hr">

	<div class="vdv-keep-in-touch">
		<?php get_template_part( 'template-parts/sections/newsletter' ); ?>
		<?php vdv_menu( 'social', 'vdv-keep-in-touch__social', 1 ); ?>
	</div>

	<hr class="vdv-hr">

	<?php
	$cache_key = md5( 'vdv_features' );
	$cache_str = get_transient( $cache_key );
	if ( false === $cache_str ) {

		ob_start();

		while ( have_rows( 'vdv_features', $page_id ) ) {
			the_row();
			while ( have_rows( 'main' ) ) {
				the_row();
				get_template_part( 'template-parts/sections/features' );
			}
			get_template_part( 'template-parts/sections/subfeatures' );
		}

		$cache_str = ob_get_clean();
		set_transient( $cache_key, $cache_str, MONTH_IN_SECONDS );

	}
	echo $cache_str;
	?>

	<section class="vdv-content">
		<?php get_template_part( 'template-parts/sections/special' ); ?>
	</section>


	<hr class="vdv-hr">


	<section class="vdv-sidebar">
	<?php
	$cache_key = md5( 'vdv_query_top_3' );
	$cache_str = get_transient( $cache_key );
	if ( false === $cache_str ) {

		ob_start();

		$top_3 = vdv_query_top_3();
		if ( $top_3->have_posts() ) :
			?>
			<h2 class="vdv-sidebar__heading vdv-sidebar__heading--alt">
				<?php _e( 'Top <span>do arquivo</span>', 'vdv' ); ?>
			</h2>

			<ol class="vdv-top">
				<?php
				while ( $top_3->have_posts() ) :
					$top_3->the_post();
					get_template_part( 'template-parts/loop/top' );
				endwhile;
				?>
			</ol>
			<?php
		endif;
		wp_reset_postdata();

		$cache_str = ob_get_clean();
		set_transient( $cache_key, $cache_str, MONTH_IN_SECONDS );

	}
	echo ( $cache_str );
	?>
	</section>

	<hr class="vdv-hr">

	<?php
	$args = array(
		'posts_per_page' => 3,
		'tax_query'      => array(
			array(
				'taxonomy' => 'tema',
				'field'    => 'slug',
				'terms'    => 'diario-de-bordo',
			),
		),
	);

	$cache_key = md5( wp_json_encode( $args ) );
	$cache_str = get_transient( $cache_key );
	if ( false === $cache_str ) {

		ob_start();

		$query = new WP_Query( $args );

		?>
		<section class="vdv-content vdv-content--alt">
			<h2 class="vdv-content__heading vdv-content__heading--alt">
				<?php _e( 'Diário <span>de um viajante</span>', 'vdv' ); ?>
			</h2>
			<div class="vdv-features">
				<?php
				while ( $query->have_posts() ) {
					$query->the_post();
					get_template_part( 'template-parts/loop/quaternary' );
				}
				wp_reset_postdata();
				?>
			</div>
		</section>
		<?php

		$cache_str = ob_get_clean();
		set_transient( $cache_key, $cache_str, MONTH_IN_SECONDS );

	}
	echo ( $cache_str );
	?>

	<hr class="vdv-hr">

	<section class="vdv-content">
		<h2 class="vdv-content__heading">
			<?php _e( 'Destinos em destaque', 'vdv' ); ?>
		</h2>
		<ul class="vdv-destinations">
			<?php
			$cache_key = md5( 'vdv_destinations' );
			$cache_str = get_transient( $cache_key );
			if ( false === $cache_str ) {

				ob_start();

				while ( have_rows( 'vdv_destinations', $page_id ) ) {
					the_row();
					get_template_part( 'template-parts/loop/destination' );
				}

				$cache_str = ob_get_clean();
				set_transient( $cache_key, $cache_str, MONTH_IN_SECONDS );

			}
			echo ( $cache_str );
			?>
		</ul>
	</section>

	<?php get_template_part( 'template-parts/sections/instagram' ); ?>
</main>

<?php get_footer(); ?>

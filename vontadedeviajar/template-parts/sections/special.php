<?php
global $page_id;
while ( have_rows( 'vdv_specials', $page_id ) ) :
	the_row();
	$count     = 0;
	$term      = get_sub_field( 'term' );
	$showposts = get_sub_field( 'showposts' );
	if ( is_object( $term ) && isset( $term->term_id ) ) :
		$query = new WP_Query(
			array(
				'posts_per_page' => $showposts,
				'tax_query'      => array(
					array(
						'taxonomy' => 'serie',
						'terms'    => $term->term_id,
					),
				),
			)
		);
		?>
		<h2 class="vdv-content__heading vdv-content__heading--alt">
			<?php
			/* translators: 1: nome da categoria especial */
			printf(
				wp_kses(
					__( 'Especial <span>%s</span>', 'vdv' ),
					array(
						'span' => array(),
					)
				),
				esc_html( $term->name )
			);
			?>
		</h2>
		<?php
		while ( ! $count++ && $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'template-parts/sections/hero' );
		}
		?>
		<div class="vdv-features">
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'template-parts/loop/primary' );
			}
			wp_reset_postdata();
			?>
		</div>
		<?php
	endif;
endwhile;

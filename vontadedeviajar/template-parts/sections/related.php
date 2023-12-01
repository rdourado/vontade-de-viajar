<?php global $query, $term, $alt, $posts_to_skip; ?>
<div class="vdv-post__related<?php echo $alt ? ' vdv-post__related--alt' : ''; ?>">
	<h4 class="vdv-post__name">
	<?php if ( isset( $query->query['tag__in'] ) ) : ?>
		<?php _e( 'Temas relacionados', 'vdv' ); ?>
	<?php else : ?>
		<a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
	<?php endif; ?>
	</h4>
	<div class="vdv-post__related-all">
		<?php
		while ( $query->have_posts() ) {
			$query->the_post();
			$posts_to_skip[] = get_the_ID();
			get_template_part( 'template-parts/loop/quinary' );
		}
		wp_reset_postdata();
		?>
	</div>
</div>

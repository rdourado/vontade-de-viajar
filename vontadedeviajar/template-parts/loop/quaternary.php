<section class="vdv-features__entry vdv-features__entry--quaternary">
	<div class="vdv-features__thumb vdv-features__thumb--alt">
		<a href="<?php the_permalink(); ?>" <?php vdv_thumbnail( 'medium' ); ?>	></a>
		<?php echo get_avatar( get_the_author_meta( 'email' ), '50' ); ?>
	</div>
	<div class="vdv-features__content">
		<h3 class="vdv-features__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php the_author_posts_link(); ?>
	</div>
</section>

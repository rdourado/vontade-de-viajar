<section class="vdv-features__entry vdv-features__entry--primary">
	<a class="vdv-features__thumb" href="<?php the_permalink(); ?>" <?php vdv_thumbnail( 'medium' ); ?>></a>
	<?php vdv_term( 'category', 'vdv-features__tag' ); ?>
	<h2 class="vdv-features__title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<!-- <div class="vdv-features__meta">
		<time class="vdv-features__date" datetime="<?php /* the_time( 'c' ); */ ?>"><?php /* the_time( 'M Y' ); */ ?></time>
		<?php /* get_template_part( 'template-parts/sections/share' ); */ ?>
	</div> -->
</section>

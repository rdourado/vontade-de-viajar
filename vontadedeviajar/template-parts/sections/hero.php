<div class="vdv-hero">
	<a href="<?php the_permalink(); ?>" class="vdv-hero__thumb" <?php vdv_thumbnail( 'large' ); ?>></a>
	<div class="vdv-hero__body">
		<?php vdv_term( 'category', 'vdv-hero__tag' ); ?>
		<h2 class="vdv-hero__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<!-- <div class="vdv-hero__meta">
			<time class="vdv-hero__date" datetime="<?php /* the_time( 'c' ); */ ?>"><?php /* the_time( 'M Y' ); */ ?></time>
			<?php /* get_template_part( 'template-parts/sections/share' ); */ ?>
		</div> -->
	</div>
</div>

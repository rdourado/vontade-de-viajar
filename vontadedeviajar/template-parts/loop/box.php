<?php global $title; ?>
<section class="vdv-special">
	<h2 class="vdv-special__heading"><?php echo $title; ?></h2>
	<a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'vdv-special__thumb' ) ); ?>
	</a>
	<h3 class="vdv-special__title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>
	<!-- <div class="vdv-special__meta">
		<time class="vdv-special__date" datetime="<?php /* the_time( 'c' ); */ ?>"><?php /* the_time( 'M Y' ); */ ?></time>
		<?php /* get_template_part( 'template-parts/sections/share' ); */ ?>
	</div> -->
</section>

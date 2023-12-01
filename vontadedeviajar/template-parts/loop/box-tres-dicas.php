<?php global $title; ?>
<section class="vdv-special vdv-special--alt">
	<h2 class="vdv-special__heading"><?php echo $title; ?></h2>
	<div class="vdv-special__tips">
		<h3 class="vdv-special__subheading"><?php the_field( 'titulo_box' ); ?></h3>
		<a href="<?php the_permalink(); ?>">
			<?php vdv_image_field( 'foto_logo_apoio', 'thumbnail', 'vdv-special__avatar' ); ?>
			<p class="vdv-special__name"><strong><?php the_field( 'marca_apoio' ); ?></strong></p>
			<p class="vdv-special__bio"><?php the_field( 'definicao_apoio' ); ?></p>
		</a>
	</div>
	<h3 class="vdv-special__title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>
	<div class="vdv-special__meta">
		<time class="vdv-special__date" datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'M Y' ); ?></time>
		<?php get_template_part( 'template-parts/sections/share' ); ?>
	</div>
</section>

<?php get_header(); ?>

<main class="vdv-main">
	<div class="vdv-archive">
		<h1 class="vdv-archive__heading">
			<?php
			/* translators: 1: termo procurado */
			printf( __( 'Busca por “%s”', 'vdv' ), get_search_query() );
			?>
		</h1>
		<div class="vdv-archive__body">
			<ol class="vdv-archive__list">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<li <?php post_class( 'vdv-archive__item' ); ?>>
					<?php get_template_part( 'template-parts/loop/senary' ); ?>
				</li>
				<?php
			endwhile;
			?>
			</ol>
			<?php the_posts_pagination(); ?>
		</div>
		<div class="vdv-widgets">
			<?php dynamic_sidebar( 'search' ); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>

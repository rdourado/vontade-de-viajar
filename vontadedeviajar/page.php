<?php get_header(); ?>

<main class="vdv-main">
<?php
while ( have_posts() ) :
	the_post();
	?>
	<article class="vdv-page">
		<header class="vdv-page__header<?php echo has_post_thumbnail() ? ' vdv-page__header--with-thumb' : ''; ?>">
			<div class="vdv-page__thumbnail" <?php vdv_thumbnail( 'large' ); ?>></div>
			<div class="vdv-page__wrap">
				<h1 class="vdv-page__title"><?php the_title(); ?></h1>
			</div>
		</header>
		<div class="vdv-page__content">
			<?php the_content(); ?>
			<?php dynamic_sidebar( 'page_footer' ); ?>
		</div>

	</article>
	<?php
endwhile;
?>
</main>

<?php get_footer(); ?>

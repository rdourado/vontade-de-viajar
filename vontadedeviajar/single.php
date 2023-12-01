<?php get_header(); ?>

<main class="vdv-main">
<?php
while ( have_posts() ) :
	the_post();
	?>
	<article class="vdv-post">
		<header class="vdv-post__header">
			<div class="vdv-post__thumbnail" <?php vdv_thumbnail( 'large' ); ?>></div>
			<div class="vdv-post__wrap">
				<?php vdv_term( 'category', 'vdv-post__tag' ); ?>
				<h1 class="vdv-post__title"><?php the_title(); ?></h1>
			</div>
			<div class="vdv-post__meta">
				<div class="vdv-post__wrap">
					<?php echo get_avatar( get_the_author_meta( 'email' ), '80' ); ?>
					<span class="vdv-post__author">
						<?php
						/* translators: 1: get_the_author_posts_link() */
						printf( __( 'Por <b>%s</b>', 'vdv' ), get_the_author_posts_link() );
						?>
					</span>
					<time class="vdv-post__date" datetime="<?php the_time( 'c' ); ?>"><?php the_date(); ?></time>
					<div class="vdv-post__share vdv-share">
						<?php vdv_share( 'facebook' ); ?>
						<?php vdv_share( 'twitter' ); ?>
						<div class="vdv-share__toggle"></div>
						<?php vdv_share(); ?>
					</div>
				</div>
			</div>
		</header>
		<div class="vdv-post__body">
			<?php
			the_widget(
				'Vdv_Partner',
				array(),
				array(
					'before_title' => '<h3 class="vdv-widget__title widgettitle">',
					'before_widget' => '<aside class="vdv-post__widget-extra vdv-widget widget vdv-widget--partner">',
				)
			);
			?>
			<div class="vdv-post__content">
				<?php the_content(); ?>
				<?php dynamic_sidebar( 'post_footer' ); ?>


			</div>
			<div class="vdv-post__widgets">
				<?php dynamic_sidebar( 'single' ); ?>
			</div>
		</div>
		<footer class="vdv-post__footer">
			<section class="vdv-post__more-posts">
				<h3 class="vdv-post__heading"><?php _e( 'Viaje mais', 'vdv' ); ?></h3>
				<?php vdv_related( 'category', 2 ); ?>
				<?php vdv_related( 'tema', 2 ); ?>
				<?php vdv_related( 'post_tag', 4, true ); ?>
			</section>
			<div class="vdv-post__content" style="display:block;">
				<?php comments_template(); ?>
			</div>

				<?php the_tags( '<p class="vdv-post__tags">', ' ', '</p>' ); ?>

		</footer>
	</article>
	<?php
endwhile;
?>
</main>

<?php get_footer(); ?>

<?php
/**
 * The main template file, used as a fallback for archive pages.
 *
 * @package vdv
 */

namespace RDourado\VdV;

?>

<?php get_header(); ?>

<main class="vdv-main">
	<div class="vdv-archive">

		<header class="vdv-archive__header">
			<div class="vdv-archive__wrap">
				<?php the_archive_title( '<h1 class="vdv-archive__heading">', '</h1>' ); ?>
				<?php the_archive_description( '<p>', '</p>' ); ?>
			</div>
			<div class="vdv-archive__ad">
				<?php vdv_ad(); ?>
			</div>
		</header>

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
			<?php dynamic_sidebar( 'archive' ); ?>
		</div>

	</div>
</main>

<?php get_footer(); ?>

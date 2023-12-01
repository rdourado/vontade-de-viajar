<?php
$count     = 0;
$term      = get_sub_field( 'term' );
$showposts = get_sub_field( 'showposts' );
?>
<section class="vdv-content">
<?php
if ( is_object( $term ) && isset( $term->term_id ) ) :
	$query = new WP_Query(
		array(
			'posts_per_page' => $showposts,
			'tax_query'      => array(
				array(
					'taxonomy' => 'tema',
					'field'    => 'term_id',
					'terms'    => $term->term_id,
				),
			),
		)
	);
	?>
	<h2 class="vdv-content__heading">
		<a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
	</h2>
	<?php
	while ( ! $count++ && $query->have_posts() ) {
		$query->the_post();
		get_template_part( 'template-parts/sections/hero' );
	}
	?>

	<div class="vdv-features">
		<?php
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'template-parts/loop/secondary' );
		}
		wp_reset_postdata();
		?>
	</div>
	<?php
endif;
?>
</section>

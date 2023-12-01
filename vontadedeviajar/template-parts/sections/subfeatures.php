<?php global $page_id, $title; ?>
<div class="vdv-sidebar">
<?php
while ( have_rows( 'side', $page_id ) ) :
	the_row();
	$term      = get_sub_field( 'term' );
	$showposts = get_sub_field( 'showposts' );
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
		<h2 class="vdv-sidebar__heading">
			<a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
		</h2>
		<div class="vdv-features">
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'template-parts/loop/tertiary', get_post_format() );
			}
			wp_reset_postdata();
			?>
		</div>

		<?php
	endif;
endwhile;
?>

<?php
while ( have_rows( 'extra', $page_id ) ) :
	the_row();
	if ( ! get_sub_field( 'show_ad' ) ) {
		$title = get_sub_field( 'title' );
		$post  = get_sub_field( 'post' );
		setup_postdata( $post );
		get_template_part(
			'template-parts/loop/box',
			is_object_in_term( $post->ID, 'tema', 'tres-dicas' )
				? 'tres-dicas' : null
		);
		wp_reset_postdata();
	} elseif ( get_sub_field( 'ad_side' ) ) {
		if ( function_exists( 'adrotate_group' ) ) {
			$ad = adrotate_group( get_sub_field( 'ad_side' ) );
		} else {
			$ad = vdv_adrotate_replacer( get_sub_field( 'ad_side' ) );
		}
		echo '<div class="vdv-ad vdv-ad--side">' . $ad . '</div>';
	}
endwhile;
?>
</div>

<hr class="vdv-hr">

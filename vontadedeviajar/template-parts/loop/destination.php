<?php $term = get_sub_field( 'term' ); ?>
<li class="vdv-destinations__item">
	<a href="<?php echo get_term_link( $term, $term->taxonomy ); ?>">
		<span class="vdv-destinations__thumb" <?php vdv_image_field_bg( 'image', 'medium' ); ?>></span>
		<span class="vdv-destinations__title"><?php echo $term->name; ?></span>
	</a>
</li>

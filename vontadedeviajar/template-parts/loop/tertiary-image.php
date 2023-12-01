<?php
$thumb_id = get_post_thumbnail_id();
if ( $thumb_id ) :
	?>
<figure class="vdv-loop">
	<a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $thumb_id, 'medium_large' ); ?></a>
	<figcaption class="vdv-loop__caption"><?php the_title(); ?></figcaption>
</figure>
	<?php
endif;

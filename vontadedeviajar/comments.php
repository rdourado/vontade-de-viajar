<?php
if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="vdv-comments">
	<?php if ( have_comments() ) : ?>

	<h2 class="vdv-comments__heading">
		<?php
		$comments_number = get_comments_number();
		if ( 1 === $comments_number ) {
			printf( esc_html__( 'Um comentário', 'vdv' ), $comments_number );
		} else {
			/* translators: 1: número de comentários */
			printf( esc_html( _n( '%d comentário', '%d comentários', $comments_number, 'vdv' ) ), $comments_number );
		}
		?>
	</h2>

	<ol class="vdv-comments__list">
		<?php
		wp_list_comments(
			array(
				'avatar_size' => 100,
				'style'       => 'ol',
				'short_ping'  => true,
				'reply_text'  => __( 'Responder', 'vdv' ),
			)
		);
		?>
	</ol>

		<?php the_comments_pagination(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="vdv-comments__closed"><?php _e( 'Comentários fechados', 'vdv' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</section>

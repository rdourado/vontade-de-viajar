<?php

class Vdv_Top extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'vdv-widget--top-3',
			'description' => __( 'Top 3 posts mais vistos da categoria, autor ou geral.', 'vdv' ),
		);
		parent::__construct( 'vdv_top', __( 'Top 3', 'vdv' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		$title = __( 'Top <span>do arquivo</span>', 'vdv' );
		if ( is_category() || is_author() || is_tax() ) {
			$obj  = get_queried_object();
			$text = isset( $obj->display_name ) ? $obj->display_name : $obj->name;
			/* translators: 1: nome da categoria ou autor */
			$title = sprintf(
				wp_kses(
					__( 'Top <span>%s</span>', 'vdv' ),
					array(
						'span' => array(),
					)
				),
				esc_html( $text )
			);
		}

		$transient = sanitize_title( $title );
		$query     = vdv_query_top_3( $transient );

		echo $args['before_widget'];
		echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
		echo '<ol class="vdv-top">';
		while ( $query->have_posts() ) :
			$query->the_post();
			get_template_part( 'template-parts/loop/top' );
		endwhile;
		wp_reset_postdata();
		echo '</ol>';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p></p>';
	}

	public function update( $new, $old ) {
		return $new;
	}
}

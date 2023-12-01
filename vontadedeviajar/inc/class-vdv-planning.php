<?php

class Vdv_Planning extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'vdv-widget--planning',
			'description' => __( 'Exibe dados do artigo cadastrados no bloco ‘Planeje sua viagem’.', 'vdv' ),
		);
		parent::__construct( 'vdv_planning', __( 'Planeje sua viagem', 'vdv' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		if ( ! is_single() || ! function_exists( 'get_field' ) ) {
			return;
		}
		$destination = get_field( 'vdv_destination' ) ? get_field( 'vdv_destination' ) : get_field( 'destino' );
		if ( empty( $destination ) ) {
			return;
		}
		/* translators: 1: nome do destino */
		$title = sprintf(
			wp_kses(
				__( 'Planeje sua viagem <span>%s</span>', 'vdv' ),
				array(
					'span' => array(),
				)
			),
			esc_html( $destination )
		);
		$items = get_field( 'vdv_planning' );

		if ( empty( $items ) ) {
			return;
		}

		echo $args['before_widget'];
		echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
		echo '<ul class="vdv-planning">';
		foreach ( $items as $item ) :
			$target   = isset( $item['blank'] ) && ! ! $item['blank'] ? ' target="_blank"' : '';
			$nofollow = isset( $item['nofollow'] ) && ! ! $item['nofollow'] ? ' rel="nofollow"' : '';
			echo '<li class="vdv-planning__item">';
			echo '<a href="' . $item['link'] . '"' . $target . $nofollow . ' class="vdv-planning__link">';
			echo '<div class="vdv-planning__image" style="background-image:url(';
			if ( intval( $item['image'] ) ) {
				echo wp_get_attachment_image_url( $item['image'], 'thumbnail' );
			} else {
				echo $item['image'];
			}
			echo ')"></div>';
			echo '<span class="vdv-planning__title">' . $item['title'] . '</span>';
			echo '</a></li>';
		endforeach;
		echo '</ul>';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p></p>';
	}

	public function update( $new, $old ) {
		return $new;
	}
}

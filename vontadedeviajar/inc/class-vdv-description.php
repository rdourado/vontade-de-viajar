<?php

class Vdv_Description extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'vdv-widget--description',
			'description' => __( 'Exibe o nome e descrição da categoria ou nome e bio do autor.', 'vdv' ),
		);
		parent::__construct( 'vdv_description', __( 'Descrição/Bio', 'vdv' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		if ( is_category() || is_tax() ) {
			$title = get_the_archive_title();
			$text  = get_the_archive_description();
		} elseif ( is_author() ) {
			$obj   = get_queried_object();
			$title = $obj->display_name;
			$text  = get_field( 'bio', "user_{$obj->ID}" );
			if ( empty( $text ) ) {
				$text = get_the_archive_description();
			}
		}

		if ( empty( $text ) || ! is_category() && ! is_author() && ! is_tax() ) {
			return;
		}
		echo $args['before_widget'];
		echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
		echo $text . $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p></p>';
	}

	public function update( $new, $old ) {
		return $new;
	}
}

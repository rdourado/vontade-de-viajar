<?php

class Vdv_Partner extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'vdv-widget--partner',
			'description' => __( 'Exibe dados do artigo cadastrados no bloco ‘Parceria’.', 'vdv' ),
		);
		parent::__construct( 'vdv_partner', __( 'Parceiro ou Autor convidado', 'vdv' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		if ( ! is_single() || ! function_exists( 'get_field' ) ) {
			return;
		}

		$title = get_field( 'titulo_box' );
		$name  = get_field( 'marca_apoio' );
		if ( empty( $title ) || empty( $name ) ) {
			return;
		}
		$avatar = get_field( 'foto_logo_apoio' );
		$bio    = get_field( 'definicao_apoio' );
		$text   = get_field( 'decricao_da_serie' );
		if ( empty( $bio ) ) {
			$bio = '&nbsp;';
		}
		if ( intval( $avatar ) ) {
			$avatar = wp_get_attachment_image( $avatar, 'thumbnail' );
		} else {
			$avatar = '';
		}

		echo $args['before_widget'];
		echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
		echo '<div class="vdv-partner">';
		echo "<figure class='vdv-partner__author'>$avatar";
		echo "<figcaption class='vdv-partner__caption'><b>$name</b><br>$bio</figcaption>";
		echo '</figure>' . wpautop( $text ) . '</div>';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p></p>';
	}

	public function update( $new, $old ) {
		return $new;
	}
}

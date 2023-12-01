<?php

add_action( 'pre_amp_render_post', 'vdv_skip_filters_for_amp' );
add_filter( 'acf/load_value/key=field_59b552e18b562', 'vdv_default_planning', 10, 3 );
add_filter( 'get_the_archive_title', 'vdv_archive_title' );
add_filter( 'script_loader_tag', 'vdv_async_js', 10, 2 );
add_filter( 'the_content_feed', 'vdv_rss_thumbnail' );
// add_filter( 'the_content', 'vdv_lazy_images' );
add_filter( 'the_content', 'vdv_fix_old_embed' );
add_filter( 'the_excerpt_rss', 'vdv_rss_thumbnail' );
add_filter( 'tiled_gallery_content_width', 'vdv_tiled_gallery_width' );
add_filter( 'wp_feed_cache_transient_lifetime', 'vdv_refresh_rss' );
add_filter( 'wp_nav_menu_objects', 'vdv_menu_item_css', 10, 2 );
add_filter( 'wpcf7_load_css', '__return_false' );
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'xmlrpc_enabled', '__return_false' );
remove_filter( 'widget_title', 'esc_html' );

function vdv_archive_title( $title ) {
	$arr = explode( ': ', $title );
	if ( 1 < count( $arr ) ) {
		return implode( '', array_slice( $arr, 1 ) );
	}
	return $title;
}

function vdv_async_js( $tag, $handle ) {
	if ( 'vdv-js' === $handle ) {
		return str_replace( ' src=', ' async src=', $tag );
	}
	return $tag;
}

function vdv_default_planning( $value, $post_id, $field ) {
	if ( false === $value ) {
		$value = array(
			array(
				'field_59b5532c8b563' => 16372,
				'field_59b553498b564' => 'Reserve hotéis e albergues',
				'field_59b553588b565' => 'http://www.booking.com/index.html?aid=379521',
			),
			array(
				'field_59b5532c8b563' => 16374,
				'field_59b553498b564' => 'Faça seu seguro de viagem',
				'field_59b553588b565' => 'http://vdeviajar.click/seguroviagem',
			),
			array(
				'field_59b5532c8b563' => 16370,
				'field_59b553498b564' => 'Alugue um carro para viajar',
				'field_59b553588b565' => 'http://vdeviajar.click/alugueldecarro',
			),
			array(
				'field_59b5532c8b563' => 18781,
				'field_59b553498b564' => 'Encontre o câmbio mais barato',
				'field_59b553588b565' => 'http://vdeviajar.click/ingressos',
			),
		);
	}
	return $value;
}

function vdv_lazy_images( $content ) {
	$pattern1    = '/<img (.*?) (src)=/';
	$pattern2    = '/<img (.*?) (srcset)=/';
	$replacement = '<img $1 data-$2=';
	$new_content = preg_replace( $pattern1, $replacement, $content );
	$new_content = preg_replace( $pattern2, $replacement, $new_content );

	return $new_content;
}

function vdv_menu_item_css( $items, $args ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $items;
	}

	return array_map(
		function( $item ) {
				$class_attr = get_field( 'icon_class', $item );
			if ( ! empty( $class_attr ) ) {
				$item->classes[] = $class_attr;
			}
				return $item;
		},
		$items
	);
}

function vdv_refresh_rss( $seconds ) {
	return 3600;
}

function vdv_fix_old_embed( $content ) {
	return preg_replace( '/(<p><iframe.*?\/iframe><\/p>)/i', '<div class="embed-container">$1</div>', $content );
}

function vdv_rss_thumbnail( $content ) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ) {
		$thumbnail = get_the_post_thumbnail( $post->ID );
		return "<p>${thumbnail}</p>${content}";
	}
	return $content;
}

function vdv_skip_filters_for_amp() {
	remove_filter( 'the_content', 'vdv_lazy_images' );
}

function vdv_tiled_gallery_width( $width ) {
	$tiled_gallery_content_width = $width;
	$width                       = 514;
	return $width;
}

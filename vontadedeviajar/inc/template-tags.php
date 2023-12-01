<?php

function vdv_ad( $group = 0 ) {
	if ( function_exists( 'adrotate_group' ) ) {
		if ( is_category() || is_author() ) {
			echo adrotate_group( 1 );
		} elseif ( is_tax() ) {
			echo adrotate_group( 2 );
		}
	} else {
		if ( is_category() || is_author() ) {
			echo vdv_adrotate_replacer( 1 );
		} elseif ( is_tax() ) {
			echo vdv_adrotate_replacer( 2 );
		}
	}
}

function vdv_adrotate_replacer( $group = 0 ) {
	global $wpdb;

	$table_a = $wpdb->prefix . 'adrotate';
	$table_b = $wpdb->prefix . 'adrotate_linkmeta';
	$code    = $wpdb->get_var( $wpdb->prepare( "SELECT `bannercode` FROM `$table_a` a INNER JOIN `$table_b` b ON a.id = b.ad AND b.group = %d ORDER BY rand() LIMIT 1;", $group ) );

	return ! empty( $code ) ? stripslashes( htmlspecialchars_decode( $code, ENT_QUOTES ) ) : '';
}

function vdv_logo() {
	global $post;
	$tag = is_front_page() ? 'h1' : 'div';
	echo "<$tag class='vdv-head__logo'><span></span><span></span><a href='/'>Vontade de Viajar</a></$tag>";
}

function vdv_menu( $theme_location, $menu_class, $depth = 0 ) {
	$location  = is_page() ? get_the_title() : ( is_archive() ? get_the_archive_title() : 'menu' );
	$cache_key = md5( wp_json_encode( array( $location, $theme_location, $menu_class, $depth ) ) );
	$cache_str = get_transient( $cache_key );
	if ( false === $cache_str ) {

		$cache_str = wp_nav_menu(
			array(
				'echo'           => false,
				'container'      => false,
				'fallback_cb'    => false,
				'menu_class'     => $menu_class,
				'theme_location' => $theme_location,
			)
		);

		set_transient( $cache_key, $cache_str, MONTH_IN_SECONDS );

	}
	echo ( $cache_str );
}

function vdv_term( $taxonomy, $css = '' ) {
	global $post;
	$terms = wp_get_post_terms( $post->ID, $taxonomy );
	if ( ! is_array( $terms ) ) {
		return;
	}
	$first = reset( $terms );
	$last  = end( $terms );
	$term  = isset( $first->parent ) && ! empty( $first->parent ) ? $first : $last;
	if ( $term ) {
		$term_link = get_term_link( $term, $taxonomy );
		echo "<a href='$term_link' class='$css'>{$term->name}</a>";
	}
}

$above_the_fold = 0;

function vdv_thumbnail( $size ) {
	global $post, $above_the_fold;
	$id = get_post_thumbnail_id( $post );
	if ( ! empty( $id ) ) {
		$src = wp_get_attachment_image_src( $id, $size );
		echo "style='background-image: url({$src[0]})'";
	}
}

function vdv_image_field( $field_name, $size, $class_name = '' ) {
	global $post;
	$id = get_sub_field( $field_name );
	if ( empty( $id ) ) {
		$id = get_field( $field_name );
	}
	if ( intval( $id ) ) {
		echo wp_get_attachment_image( $id, $size, false, array( 'class' => $class_name ) );
	}
}

function vdv_image_field_bg( $field_name, $size ) {
	global $post;
	$id = get_sub_field( $field_name );
	if ( empty( $id ) ) {
		$id = get_field( $field_name );
	}
	if ( intval( $id ) ) {
		$src = wp_get_attachment_image_src( $id, $size );
		echo "style='background-image: url({$src[0]})'";
	}
}

function vdv_loop_rows( $field_name, $template_part, $limit = -1 ) {
	$cache_key = md5( wp_json_encode( array( $field_name, $template_part, $limit ) ) );
	$cache_str = get_transient( $cache_key );
	if ( false === $cache_str ) {

		ob_start();

		global $post, $page_id;
		$count = 0;
		$id    = isset( $page_id ) ? $page_id : null;

		while ( ( $limit < 0 || $count++ < $limit ) && have_rows( $field_name, $id ) ) {
			the_row();
			$post = get_sub_field( 'post' );
			setup_postdata( $post );
			get_template_part( $template_part );
			wp_reset_postdata();
		}

		$cache_str = ob_get_clean();
		set_transient( $cache_key, $cache_str, MONTH_IN_SECONDS );

	}
	echo ( $cache_str );
}

function vdv_primary_term( $taxonomy ) {
	global $post;
	$term_id = get_post_meta( $post->ID, "_yoast_wpseo_primary_{$taxonomy}", true );
	if ( ! empty( $term_id ) ) {
		return get_term_by( 'id', $term_id, $taxonomy );
	} else {
		$terms = wp_get_post_terms( $post->ID, $taxonomy );
		return reset( $terms );
	}
}

function vdv_query_top_3( $transient = 'top-do-arquivo' ) {
	$query = get_transient( $transient );
	if ( false !== $query && ! empty( $query ) ) {
		return $query;
	}

	$query_args = array(
		'meta_key'       => 'post_views_count',
		'orderby'        => 'meta_value_num',
		'posts_per_page' => 3,
	);
	if ( is_category() ) {
		$obj               = get_queried_object();
		$query_args['cat'] = $obj->term_id;
	} elseif ( is_author() ) {
		$obj                  = get_queried_object();
		$query_args['author'] = $obj->ID;
	} elseif ( is_tax() ) {
		$obj                     = get_queried_object();
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => $obj->taxonomy,
				'terms'    => $obj->term_id,
			),
		);
	}
	$query = new WP_Query( $query_args );
	set_transient( $transient, $query, 8 * HOUR_IN_SECONDS );

	return $query;
}

function vdv_related( $term_tax, $posts_per_page = 2, $alternative = false ) {
	global $post, $term, $query, $alt, $posts_to_skip;

	$alt      = $alternative;
	$args     = array();
	$defaults = array(
		'post__not_in'        => array_merge( $posts_to_skip, array( $post->ID ) ),
		'posts_per_page'      => $posts_per_page,
		'ignore_sticky_posts' => true,
	);

	if ( 'post_tag' === $term_tax ) {
		$tags = wp_get_post_tags( $post->ID );
		if ( empty( $tags ) ) {
			return;
		}
		$tag_ids = array();
		foreach ( $tags as $tag ) {
			$tag_ids[] = $tag->term_id;
		}
		$args = wp_parse_args(
			array(
				'tag__in' => $tag_ids,
			),
			$defaults
		);
	} else {
		$term = vdv_primary_term( $term_tax );
		if ( ! is_object( $term ) ) {
			return;
		}
		$args = wp_parse_args(
			array(
				'tax_query' => array(
					array(
						'taxonomy' => $term->taxonomy,
						'terms'    => $term->term_id,
						'field'    => 'term_id',
					),
				),
			),
			$defaults
		);
	}

	$query = new WP_Query( $args );
	get_template_part( 'template-parts/sections/related', $term_tax );
}

function vdv_share( $service = null ) {
	global $post;

	$facebook      = 'https://www.facebook.com/sharer/sharer.php?u=%s';
	$twitter       = 'https://twitter.com/home?status=%s';
	$googleplus    = 'https://plus.google.com/share?url=%s';
	$linkedin      = 'https://www.linkedin.com/shareArticle?mini=true&amp;url=%s&amp;title=%s';
	$pinterest     = 'https://pinterest.com/pin/create/button/?url=%s&amp;media=%s&amp;description=%s';
	$reddit        = 'http://reddit.com/submit?url=%s&amp;title=%s';
	$tumblr        = 'http://www.tumblr.com/share/link?url=%s&amp;title=%s';
	$email         = 'mailto:?&amp;subject=%s&amp;body=%s';
	$title         = get_the_title( $post );
	$link          = get_permalink( $post );
	$thumb_url     = get_the_post_thumbnail_url( $post, 'large' );
	$thumb_caption = get_the_post_thumbnail_caption( $post );

	$links = array(
		'facebook'   => '<a href="' . sprintf( $facebook, urlencode( $link ) ) . '" class="vdv-share__link vdv-share__link--facebook" target="_blank">Facebook</a>',
		'twitter'    => '<a href="' . sprintf( $twitter, urlencode( "$title $link via @vontadedeviajar" ) ) . '" class="vdv-share__link vdv-share__link--twitter" target="_blank">Twitter</a>',
		'googleplus' => '<a href="' . sprintf( $googleplus, urlencode( $link ) ) . '" class="vdv-share__link vdv-share__link--googleplus" target="_blank">Google+</a>',
		'linkedin'   => '<a href="' . sprintf( $linkedin, urlencode( $link ), urlencode( $title ) ) . '" class="vdv-share__link vdv-share__link--linkedin" target="_blank">LinkedIn</a>',
		'pinterest'  => '<a href="' . sprintf( $pinterest, urlencode( $link ), urlencode( $thumb_url ), urlencode( $thumb_caption ) ) . '" class="vdv-share__link vdv-share__link--pinterest" target="_blank">Pinterest</a>',
		'reddit'     => '<a href="' . sprintf( $reddit, urlencode( $link ), urlencode( $title ) ) . '" class="vdv-share__link vdv-share__link--reddit" target="_blank">Reddit</a>',
		'tumblr'     => '<a href="' . sprintf( $tumblr, urlencode( $link ), urlencode( $title ) ) . '" class="vdv-share__link vdv-share__link--tumblr" target="_blank">Tumblr</a>',
		'email'      => '<a href="' . sprintf( $email, urlencode( 'Vontade de Viajar' ), urlencode( "$title – $link" ) ) . '" class="vdv-share__link vdv-share__link--email" target="_blank">Email</a>',
	);

	if ( isset( $links[ $service ] ) ) {
		echo $links[ $service ];
	} else {
		echo '<div class="vdv-share__wrap">' . implode( ' ', $links ) . '</div>';
	}
}

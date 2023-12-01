<?php

add_action( 'manage_posts_custom_column', 'vdv_post_views_column', 5, 2 );
add_action( 'pre_get_posts', 'vdv_sort_column', 1 );
// add_action( 'wp_ajax_nopriv_vdv_counter', 'vdv_counter' );
// add_action( 'wp_ajax_vdv_counter', 'vdv_counter' );
// add_action( 'wp_footer', 'vdv_counter_script' );
add_filter( 'manage_edit-post_sortable_columns', 'vdv_sortable_column' );
add_filter( 'manage_posts_columns', 'vdv_post_views_column_name' );

function vdv_counter_script() {
	global $post;
	if ( is_single() ) :
		?>
<script>
var r=new XMLHttpRequest();
r.open('POST','<?php echo admin_url( 'admin-ajax.php' ); ?>',true);
r.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
r.send('action=vdv_counter&post_id=<?php echo $post->ID; ?>');
</script>
		<?php
	endif;
}

function vdv_post_views_column( $column_name, $post_id ) {
	if ( 'post_views' !== $column_name ) {
		return;
	}
	$count = (int) get_post_meta( $post_id, 'post_views_count', true );
	if ( empty( $count ) ) {
		echo __( 'Nunca', 'vdv' );
	} elseif ( 1 === $count ) {
		printf( esc_html__( 'Uma vez', 'vdv' ), $count );
	} else {
		/* translators: 1: número de visualizações */
		printf( esc_html( _n( '%d vez', '%d vezes', $count, 'vdv' ) ), $count );
	}
}

function vdv_sort_column( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( 'post_views' === $query->get( 'orderby' ) ) {
		$query->set( 'meta_key', 'post_views_count' );
		$query->set( 'orderby', 'meta_value_num' );
	}
	return $query;
}

function vdv_counter() {
	$post_id    = $_REQUEST['post_id'];
	$meta_key   = 'post_views_count';
	$meta_value = (int) get_post_meta( $post_id, $meta_key, true );
	echo update_post_meta( $post_id, $meta_key, $meta_value + 1 );
	die();
}

function vdv_sortable_column( $sortable_columns ) {
	$sortable_columns['post_views'] = 'post_views';
	return $sortable_columns;
}

function vdv_post_views_column_name( $defaults ) {
	$defaults['post_views'] = __( 'Visualizado', 'vdv' );
	return $defaults;
}

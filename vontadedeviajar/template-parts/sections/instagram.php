<?php
$data = get_transient( 'vdv_instagram' );
if ( false === $data || empty( $data ) ) {
	$token    = get_theme_mod( 'instagram_token' );
	$response = wp_remote_get( "https://api.instagram.com/v1/users/self/media/recent/?access_token=$token" );
	if ( is_array( $response ) && ! is_wp_error( $response ) && isset( $response['body'] ) ) {
		$result = json_decode( $response['body'] );
		if ( isset( $result->data ) && is_array( $result->data ) && ! empty( $result->data ) ) {
			$data = $result->data[0];
			set_transient( 'vdv_instagram', $data, 12 * HOUR_IN_SECONDS );
		}
	}
}

if ( ! empty( $data ) ) :
	$image = $data->images->standard_resolution;
	?>
	<section class="vdv-sidebar">
		<h2 class="vdv-sidebar__heading"><?php _e( 'Instagram', 'vdv' ); ?></h2>
		<figure class="vdv-instagram">
			<a href="<?php echo $data->link; ?>" class="vdv-instagram__link" target="_blank">
				<img src="<?php echo $image->url; ?>" alt="" class="vdv-instagram__photo" width="<?php echo $image->width; ?>" height="<?php echo $image->height; ?>">
			</a>
			<figcaption class="vdv-instagram__caption"><a href="https://www.instagram.com/<?php echo $data->user->username; ?>/" target="_blank">@<?php echo $data->user->username; ?></a></figcaption>
		</figure>
		<div class="vdv-instagram"></div>
	</section>
	<?php
endif;

<?php

require '../../../wp-load.php';

if ( isset( $_GET['code'] ) && ! empty( $_GET['code'] ) ) {
	$body = array(
		'client_id' => $_ENV['INSTAGRAM_CLIENT_ID'],
		'client_secret' => $_ENV['INSTAGRAM_CLIENT_SECRET'],
		'grant_type' => 'authorization_code',
		'redirect_uri' => get_theme_file_uri( 'instagram-callback.php' ),
		'code' => $_GET['code'],
	);
	$response = wp_remote_post(
		'https://api.instagram.com/oauth/access_token',
		array(
			'blocking' => true,
			'body' => $body,
			'cookies' => array(),
			'headers' => array(),
			'httpversion' => '1.0',
			'method' => 'POST',
			'redirection' => 5,
			'timeout' => 45,
		)
	);
	if ( ! ! $response && ! is_wp_error( $response ) && isset( $response['body'] ) ) {
		$result = json_decode( $response['body'] );
		set_theme_mod( 'instagram_token', trim( $result->access_token ) );
		delete_transient( 'vdv_instagram' );
	}
	wp_redirect( admin_url( '/customize.php' ) );
	exit;
}

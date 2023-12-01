<?php

add_action( 'admin_enqueue_scripts', 'vdv_admin_stylesheet' );
add_action( 'login_enqueue_scripts', 'vdv_login_stylesheet' );
add_filter( 'login_headertext', 'vdv_login_logo_url_title' );
add_filter( 'login_headerurl', 'vdv_login_logo_url' );

function vdv_admin_stylesheet() {
	wp_enqueue_style( 'vdv-fonts', 'https://fonts.googleapis.com/css?family=Bree+Serif|Roboto:400,400i,700' );
	wp_enqueue_style( 'vdv-custom-admin', get_theme_file_uri( 'assets/css/admin.css' ) );
}

function vdv_login_stylesheet() {
	wp_enqueue_style( 'vdv-fonts', 'https://fonts.googleapis.com/css?family=Bree+Serif|Roboto:400,400i,700' );
	wp_enqueue_style( 'vdv-custom-login', get_theme_file_uri( 'assets/css/login.css' ) );
}

function vdv_login_logo_url_title() {
	return get_bloginfo( 'name' );
}

function vdv_login_logo_url() {
	return home_url( '/' );
}

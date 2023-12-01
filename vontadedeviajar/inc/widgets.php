<?php

add_action( 'widgets_init', 'vdv_widgets_init' );

function vdv_widgets_init() {
	register_widget( 'Vdv_Description' );
	register_widget( 'Vdv_Partner' );
	register_widget( 'Vdv_Planning' );
	register_widget( 'Vdv_Top' );
}

require get_theme_file_path( '/inc/class-vdv-description.php' );
require get_theme_file_path( '/inc/class-vdv-partner.php' );
require get_theme_file_path( '/inc/class-vdv-planning.php' );
require get_theme_file_path( '/inc/class-vdv-top.php' );

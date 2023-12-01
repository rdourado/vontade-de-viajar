<?php

add_action( 'customize_register', 'vdv_customize_theme' );

function vdv_customize_theme( $wp_customize ) {
	// Section
	$wp_customize->add_section(
		'em_que_acreditamos',
		array(
			'title' => __( 'Em que acreditamos', 'vdv' ),
		)
	);

	$defaults = array(
		__( 'Viajar pode ser uma experiência transformadora para quem tem olhar criativo e interpreta o que vê pelo mundo', 'vdv' ),
		__( 'Buscar inspiração nas artes, no cinema e na música torna a viagem mais divertida e criativa', 'vdv' ),
		__( 'Viajar é a melhor maneira de criar memórias especiais com quem a gente ama, fazer novos amigos e conhecer outras culturas', 'vdv' ),
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting(
			"belief_$i",
			array(
				'type'              => 'theme_mod',
				'default'           => $defaults[ $i - 1 ],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			"belief_$i",
			array(
				/* translators: 1: Ordem da frase */
				'label'   => sprintf( __( 'Frase %d', 'vdv' ), $i ),
				'type'    => 'textarea',
				'section' => 'em_que_acreditamos',
			)
		);
	}

	// Section
	$client   = urlencode( INSTAGRAM_CLIENT_ID );
	$redirect = urlencode( get_theme_file_uri( 'instagram-callback.php' ) );
	$wp_customize->add_section(
		'instagram',
		array(
			'title'       => __( 'Instagram', 'vdv' ),
			/* translators: 1: Link para a API do Instagram */
			'description' => sprintf(
				__( '<a href="%s">Crie um token de acesso</a> para acessar suas fotos do Instagram.', 'vdv' ),
				"https://api.instagram.com/oauth/authorize/?client_id={$client}&amp;redirect_uri={$redirect}&amp;response_type=code"
			),
		)
	);

	$wp_customize->add_setting(
		'instagram_token',
		array(
			'type' => 'theme_mod',
		)
	);
	$wp_customize->add_control(
		'instagram_token',
		array(
			'label'   => __( 'Token de acesso', 'vdv' ),
			'type'    => 'text',
			'section' => 'instagram',
		)
	);
}

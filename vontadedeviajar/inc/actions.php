<?php

add_action( 'after_setup_theme', 'vdv_setup' );
add_action( 'init', 'vdv_custom_taxonomies', 0 );
add_action( 'init', 'vdv_rename_author_base' );
add_action( 'widgets_init', 'vdv_register_sidebar' );

function vdv_custom_taxonomies() {
	$labels = array(
		'name'                       => __( 'Temas', 'vdv' ),
		'singular_name'              => __( 'Tema', 'vdv' ),
		'menu_name'                  => __( 'Temas', 'vdv' ),
		'all_items'                  => __( 'Todos os temas', 'vdv' ),
		'parent_item'                => __( 'Tema pai', 'vdv' ),
		'parent_item_colon'          => __( 'Tema pai:', 'vdv' ),
		'new_item_name'              => __( 'Novo tema', 'vdv' ),
		'add_new_item'               => __( 'Adicionar novo tema', 'vdv' ),
		'edit_item'                  => __( 'Editar tema', 'vdv' ),
		'update_item'                => __( 'Atualizar tema', 'vdv' ),
		'view_item'                  => __( 'Ver Tema', 'vdv' ),
		'separate_items_with_commas' => __( 'Separe os temas com vírgulas', 'vdv' ),
		'add_or_remove_items'        => __( 'Adicionar ou remover temas', 'vdv' ),
		'choose_from_most_used'      => __( 'Escolha entre os temas mais usados', 'vdv' ),
		'popular_items'              => __( 'Temas populares', 'vdv' ),
		'search_items'               => __( 'Pesquisar Temas', 'vdv' ),
		'not_found'                  => __( 'Nenhum tema encontrado', 'vdv' ),
		'no_terms'                   => __( 'Nenhum tema', 'vdv' ),
		'items_list'                 => __( 'Lista de temas', 'vdv' ),
		'items_list_navigation'      => __( 'Navegação da lista de temas', 'vdv' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'tema', array( 'post' ), $args );

	$labels = array(
		'name'                       => __( 'Séries especiais', 'vdv' ),
		'singular_name'              => __( 'Série especial', 'vdv' ),
		'menu_name'                  => __( 'Séries Especiais', 'vdv' ),
		'all_items'                  => __( 'Todas as séries', 'vdv' ),
		'parent_item'                => __( 'Série mãe', 'vdv' ),
		'parent_item_colon'          => __( 'Série mãe:', 'vdv' ),
		'new_item_name'              => __( 'Nova série', 'vdv' ),
		'add_new_item'               => __( 'Adicionar nova série', 'vdv' ),
		'edit_item'                  => __( 'Editar série', 'vdv' ),
		'update_item'                => __( 'Atualizar série', 'vdv' ),
		'view_item'                  => __( 'Ver Série', 'vdv' ),
		'separate_items_with_commas' => __( 'Separe as séries com vírgulas', 'vdv' ),
		'add_or_remove_items'        => __( 'Adicionar ou remover séries', 'vdv' ),
		'choose_from_most_used'      => __( 'Escolha entre as séries mais usadas', 'vdv' ),
		'popular_items'              => __( 'Séries populares', 'vdv' ),
		'search_items'               => __( 'Pesquisar Séries', 'vdv' ),
		'not_found'                  => __( 'Nenhuma série encontrada', 'vdv' ),
		'no_terms'                   => __( 'Nenhuma série', 'vdv' ),
		'items_list'                 => __( 'Lista de séries', 'vdv' ),
		'items_list_navigation'      => __( 'Navegação da lista de séries', 'vdv' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'serie', array( 'post' ), $args );
}

function vdv_register_sidebar() {
	$defaults = array(
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="vdv-widget widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="vdv-widget__title widgettitle">',
		'after_title'   => '</h3>',
	);
	register_sidebar(
		wp_parse_args(
			array(
				'name'        => __( 'Artigos', 'vdv' ),
				'id'          => 'single',
				'description' => __( 'Página de leitura de artigos', 'vdv' ),
			),
			$defaults
		)
	);
	register_sidebar(
		wp_parse_args(
			array(
				'name'        => __( 'Arquivo', 'vdv' ),
				'id'          => 'archive',
				'description' => __( 'Listagem de posts por categoria, tag, autor, busca, etc', 'vdv' ),
			),
			$defaults
		)
	);
	register_sidebar(
		wp_parse_args(
			array(
				'name'        => __( 'Busca', 'vdv' ),
				'id'          => 'search',
				'description' => __( 'Listagem de posts por categoria, tag, autor, busca, etc', 'vdv' ),
			),
			$defaults
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Parcerias', 'vdv' ),
			'id'            => 'footer',
			'description'   => __( 'Adicione as marcas parceiras com o widget de imagens.', 'vdv' ),
			'before_widget' => '<div id="%1$s" class="vdv-widget--%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widgettitle">',
			'after_title'   => '</h5>',
		)
	);

	// TODO: Talvez seja melhor pensar em outra solução para este caso
	register_sidebar(
		array(
			'name'          => __( 'Rodapé de Artigo', 'vdv' ),
			'id'            => 'post_footer',
			'description'   => __( 'Widgets inseridos logo após o conteúdo dos artigos.', 'vdv' ),
			'before_widget' => '<div id="%1$s" class="vdv-post__special-widget vdv-post__special-widget--%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="vdv-post__special-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Rodapé de Página', 'vdv' ),
			'id'            => 'page_footer',
			'description'   => __( 'Widgets inseridos logo após o conteúdo das páginas.', 'vdv' ),
			'before_widget' => '<div id="%1$s" class="vdv-post__special-widget vdv-post__special-widget--%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="vdv-post__special-title">',
			'after_title'   => '</h4>',
		)
	);
}

function vdv_rename_author_base() {
	global $wp_rewrite;
	$wp_rewrite->author_base = 'autor';
}

function vdv_setup() {
	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'vdv' ),
			'footer'  => __( 'Menu Rodapé', 'vdv' ),
			'social'  => __( 'Menu Social', 'vdv' ),
		)
	);
}

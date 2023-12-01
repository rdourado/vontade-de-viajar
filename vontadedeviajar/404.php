<?php get_header(); ?>

<main class="vdv-not-found">
	<h1 class="vdv-not-found__title"><?php _e( '404', 'vdv' ); ?></h1>
	<p class="vdv-not-found__text"><?php _e( 'Parece que você se perdeu.<br>Em instantes estaremos te direcionando<br>para nossa página inicial.', 'vdv' ); ?></p>
	<form action="<?php echo home_url( '/' ); ?>" method="get" class="vdv-not-found__search">
		<p class="vdv-not-found__field">
			<input type="search" name="s" class="vdv-not-found__input" placeholder="<?php esc_attr_e( 'Busque destinos, culturas, dicas…', 'vdv' ); ?>" aria-label="<?php esc_attr_e( 'Busca', 'vdv' ); ?>" required aria-required="true">
		</p>
	</form>
</main>

<?php get_footer(); ?>

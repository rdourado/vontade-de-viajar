<form class="vdv-nav__search-form vdv-search-form vdv-search-form--show" action="<?php echo home_url( '/' ); ?>" method="get">
	<div class="vdv-search-form__field">
		<label class="vdv-search-form__label">
			<span><?php _e( 'Procurar por', 'vdv' ); ?></span>
			<input class="vdv-search-form__input" type="search" name="s" required placeholder="<?php _e( 'Busca', 'vdv' ); ?>" aria-required="true" value="<?php esc_attr( get_search_query() ); ?>">
		</label>
		<button class="vdv-search-form__button" type="submit"><?php _e( 'OK', 'vdv' ); ?></button>
	</div>
</form>

<?php
/**
 * MailChimp newsletter form.
 *
 * @package vdv
 */

namespace RDourado\VdV;

?>

<form class="vdv-newsletter" action="<?php echo esc_url( $_ENV['MAILCHIMP_FORM_ACTION'] ); ?>" method="post">
	<fieldset class="vdv-newsletter__wrap">
		<legend class="vdv-newsletter__heading"><?php esc_html_e( 'Newsletter', 'vdv' ); ?></legend>
		<div class="vdv-newsletter__body">
			<input class="vdv-newsletter__input" type="email" name="EMAIL" required placeholder="<?php esc_attr_e( 'As melhores dicas no seu email', 'vdv' ); ?>" aria-required="true" aria-label="<?php esc_attr_e( 'Recebas dicas no seu email', 'vdv' ); ?>">
			<button id="btnSend" class="vdv-newsletter__button" type="submit"><?php esc_html_e( 'Cadastrar', 'vdv' ); ?></button>
		</div>
	</fieldset>
</form>

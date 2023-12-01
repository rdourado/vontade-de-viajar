<!-- DISPARO PARA WATSON BY VINNY -->
<?php
if ( isset( $_GET['email'] ) ) {
	$email = $_GET['email'];
} else {
	$email = null;
}
?>
<!-- DISPARO PARA WATSON BY VINNY -->

<!DOCTYPE html>
<html>
<head>
	<title>sendToDicas</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<form id="toWca" method="post" action="http://www.pages02.net/kindle-sandbox2/dicas/cadastro-dicas" pageId="8714681" siteId="388739" parentPageId="8714679" >

		<input type="text" name="Email" id="control_EMAIL" label="Email" value="<?php echo '' . $email; ?>">

		<input type="submit" class="defaultText buttonStyle" value="Submit">

		<input type="hidden" name="Origem" id="control_COLUMN27" value="dicas-vontade-de-viajar">
		<input type="hidden" name="formSourceName" value="StandardForm"><!-- DO NOT REMOVE HIDDEN FIELD sp_exp -->
		<input type="hidden" name="sp_exp" value="yes">
	</form>

	<script>
		jQuery(document).ready(function(){
			   // jQuery("#toWca").submit(); // faz o submit automaticamente quando carregada a página
			   // window.close(); // fecha essa janela quando tudo tiver sido enviado
		});
	</script>
</body>
</html>



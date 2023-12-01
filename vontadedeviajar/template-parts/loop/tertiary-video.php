<div class="vdv-video"><?php
	remove_filter( 'the_content', 'wpautop' );
	the_content();
	add_filter( 'the_content', 'wpautop' );
?></div>

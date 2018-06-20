<?php
$description = get_bloginfo( 'description', 'display' );
if ( $description ) { ?>
	<p class="tagline"><?php echo $description; ?></p><?php
}
?>
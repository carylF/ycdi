<?php
global $header_type;

if ( 'show' === get_option( 'pearl_header_search', 'show' ) ) {

	if ( 'header_4' == $header_type ) {
		?>
		<form action="<?php echo esc_url( home_url('/') ); ?>" class="search-form">
			<input type="text" name="s" id="s" value="" placeholder="Search">
			<input type="submit" id="search-submit" value="">
			<i class="fa fa-search" aria-hidden="true"></i>
		</form>
		<?php
	} else {
		?>
		<div class="search-form-wrap">
			<div id="search-toggle" class="search-toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-search-form">
				<input type="text" name="s" id="s" value="" placeholder="Search">
				<input type="submit" id="search-submit" value="Go">
			</form>
		</div>
		<?php
	}
}
?>
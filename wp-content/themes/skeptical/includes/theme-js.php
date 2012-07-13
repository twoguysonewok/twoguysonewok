<?php
if ( !is_admin() ) add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
if ( !function_exists( 'woothemes_add_javascript' ) ) {
	function woothemes_add_javascript( ) {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/includes/js/superfish.js', array( 'jquery' ) );
		wp_enqueue_script( 'general', get_template_directory_uri() . '/includes/js/general.js', array( 'jquery' ) );
	}
}
?>
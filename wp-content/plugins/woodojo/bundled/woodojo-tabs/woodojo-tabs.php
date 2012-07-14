<?php
/**
 * Module Name: WooDojo - Tabs
 * Module Description: The popular WooDojo - Tabs widget, classically placed within your website's main widgetized area.
 * Module Version: 1.0.0
 *
 * @package WooDojo
 * @subpackage Bundled
 * @author Matty
 * @since 1.0.0
 */
 
 require_once( 'classes/widget-woodojo-tabs.php' );

 /**
  * woodojo_tabs_register function.
  * 
  * @access public
  * @since 1.0.0
  * @return void
  */
 if ( ! function_exists( 'woodojo_tabs_register' ) ) {
 	 add_action( 'widgets_init', 'woodojo_tabs_register' );
 	 
	 function woodojo_tabs_register () {
	 	return register_widget( 'WooDojo_Widget_Tabs' );
	 } // End woodojo_tabs_register()
 }
?>
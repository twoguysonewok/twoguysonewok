<?php
/**
 * Module Name: WooDojo - Custom Code
 * Module Description: The WooDojo Custom Code feature adds the facility to easy add custom CSS code to your website, as well as custom HTML code in the <head> section or before the </body> tag.
 * Module Version: 1.0.0
 * Module Settings: woodojo-custom-code
 *
 * @package WooDojo
 * @subpackage Bundled
 * @author WooThemes
 * @since 1.0.0
 */
 
 /* Include Class */
 require_once( 'classes/woodojo-custom-code.class.php' );
 /* Instantiate Class */
 if ( class_exists( 'WooDojo' ) ) {
 	$woodojo_custom_code = new WooDojo_CustomCode();
 } // End IF Statement
?>
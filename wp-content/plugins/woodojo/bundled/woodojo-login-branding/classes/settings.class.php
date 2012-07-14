<?php
/*-----------------------------------------------------------------------------------

CLASS INFORMATION

Description: Settings Screen Data
Date Created: 2012-03-22.
Last Modified: 2011-03-23.
Author: Jeffikus
Since: 1.0.0


TABLE OF CONTENTS

- function __construct
- function init_sections
- function init_fields

-----------------------------------------------------------------------------------*/

class WooDojo_LoginBranding_Settings extends WooDojo_Settings_API {
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct () {
	
	    parent::__construct(); // Required in extended classes.
	
	} // End __construct()
	
	/**
	 * init_sections function.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function init_sections () {
	
	   $sections = array();
			
		$sections['general'] = array(
		    'name' 			=> __('General Settings', 'woodojo' ), 
		    'description'	=> __('General login branding settings. If you do not wish to use a specific option, leave the setting blank to disable.', 'woodojo')
		);
		
		$this->sections = $sections;
	
	} // End init_sections()
	
	/**
	 * init_fields function.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function init_fields () {
	
	    $fields = array();
		
		$fields['logo_url'] = array(
		    'name' => __('Logo URL', 'woodojo' ), 
		    'description' => __('Change the logo image for the WordPress login page. This is the URL of your logo.', 'woodojo'), 
		    'type' => 'text', 
		    'default' => plugin_dir_url(plugin_basename(dirname(__FILE__))).'/assets/woothemes-login-logo.png', 
		    'section' => 'general', 
		    'validate' => 'woo_login_branding_validate_logo', 
		    'form' => 'woo_login_branding_form_logo'
		);
		
		$fields['title_text'] = array(
		    'name' => __('Title Text', 'woodojo' ), 
		    'description' => __('Change the title of the logo image on the WordPress login page.', 'woodojo'), 
		    'type' => 'text', 
		    'default' => get_bloginfo('name').' &raqu; Log In', 
		    'section' => 'general', 
		    'validate' => 'woo_login_branding_validate_title', 
		    'form' => 'woo_login_branding_form_title'
		);
		
		$fields['login_url'] = array(
		    'name' => __('Logo Image URL', 'woodojo' ), 
		    'description' => __('Change the URL that the logo image on the WordPress login page links to when clicked on.', 'woodojo'), 
		    'type' => 'text', 
		    'default' => home_url(), 
		    'section' => 'general', 
		    'validate' => 'woo_login_branding_validate_login', 
		    'form' => 'woo_login_branding_form_login'
		);
		
		$this->fields = $fields;
	
	} // End init_fields()
	
} // End Class WooDojo_LoginBranding_Settings
?>
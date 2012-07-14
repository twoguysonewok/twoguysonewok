<?php
/*-----------------------------------------------------------------------------------

CLASS INFORMATION

Description: Brand your WordPress Login!
Date Created: 2012-03-22.
Last Modified: 2011-03-22.
Author: Patrick
Since: 1.0.0


TABLE OF CONTENTS

- var $token
- var $settings_screen

- function __construct
- function load_settings_screen
- function login_head
- function login_header_url
- function login_header_title

-----------------------------------------------------------------------------------*/
class WooDojo_Login_Branding extends WooDojo_Settings_API {
		
	/* Variable Declarations */
	var $token;
	var $settings_screen;
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct () {
		
		parent::__construct(); // Required in extended classes.
	    add_filter('login_headerurl', array(&$this,'login_header_url'));
	    add_filter('login_headertitle', array(&$this,'login_header_title'));
	    add_filter('login_head', array(&$this,'login_head'));
	    
	    /* Settings Screen */
	    $this->load_settings_screen();
	
	} // End __construct()
		
	/**
	 * load_settings_screen function.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function load_settings_screen () {
		
		/* Settings Screen */
		require_once( 'settings.class.php' );
		$this->settings_screen = new WooDojo_LoginBranding_Settings();
		
		/* Setup login branding data */
		$this->settings_screen->token = 'woodojo-login-branding';
		if ( is_admin() ) {
			$this->settings_screen->name = __( 'WooDojo Login Branding', 'woodojo' );
			$this->settings_screen->menu_label = __( 'Login Branding', 'woodojo' );
			$this->settings_screen->page_slug = 'woodojo-login-branding';
		}
		$this->settings_screen->setup_settings();
	
	} // End load_settings_screen()
	
	/**
	 * login_head function.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function login_head() {
	
		/* Setup settings to use */
		$settings = $this->settings_screen->get_settings();
		$logo_url = '';
		if ( isset($settings['logo_url']) && $settings['logo_url'] != '' ) {
			$logo_url = $settings['logo_url'];
		}
		if ( $logo_url != '' ) {
			$dimensions = @getimagesize( $logo_url );
			echo '<style>' . "\n" . 'body.login #login h1 a { background: url("' . $logo_url . '") no-repeat scroll center top transparent; height: ' . $dimensions[1] . 'px; width: auto; }' . "\n" . '</style>' . "\n";
		}
	
	} // End login_head()
	
	/**
	 * login_header_url function.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function login_header_url($url) {
		
		/* Setup settings to use */
		$settings = $this->settings_screen->get_settings();
		$login_url = home_url();
		if ( isset($settings['login_url']) && $settings['login_url'] != '' ) {
			$login_url = $settings['login_url'];
		}
		return $login_url;
	    
	} // End login_header_url()
	
	/**
	 * login_header_title function.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */	
	public function login_header_title($title) {
		
		/* Setup settings to use */
		$settings = $this->settings_screen->get_settings();
		$title_text = get_bloginfo('name').' &raquo; Log In';
		if ( isset($settings['title_text']) && $settings['title_text'] != '' ) {
			$title_text = $settings['title_text'];
		}
		return $title_text;
	
	} // End login_header_title()
		
}
?>
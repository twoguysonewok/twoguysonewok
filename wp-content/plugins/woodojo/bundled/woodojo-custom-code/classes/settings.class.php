<?php
/*-----------------------------------------------------------------------------------

CLASS INFORMATION

Description: Settings Screen Data
Date Created: 2012-03-20.
Last Modified: 2011-03-20.
Author: WooThemes
Since: 1.0.0


TABLE OF CONTENTS

- function __construct
- function init_sections
- function init_fields
- validate_field_css

-----------------------------------------------------------------------------------*/

class WooDojo_CustomCode_Settings extends WooDojo_Settings_API {
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct () {
		global $woodojo;
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
	    
	    $sections['custom-css'] = array(
	    						'name' => __( 'Custom CSS', 'woodojo' ), 
	    						'description' => __( 'Add custom CSS code to your website.', 'woodojo' )
	    						);

	    if ( current_user_can( 'unfiltered_html' ) ) {
		    $sections['custom-html'] = array(
		    						'name' => __( 'Custom HTML', 'woodojo' ), 
		    						'description' => __( 'Add custom HTML code to the &lt;head&gt; section or before the closing &lt;/body&gt; tag on your website.', 'woodojo' )
	    							);
		}
	    
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
	    
	     $fields['custom-css-enable'] = array(
	    						'name' => __( 'Enable Custom CSS', 'woodojo' ), 
	    						'description' => __( 'Output the custom CSS code on your website.', 'woodojo' ), 
	    						'type' => 'checkbox', 
	    						'default' => '', 
	    						'section' => 'custom-css', 
	    						'required' => 0
	    						);

	    $fields['custom-css-code'] = array(
	    						'name' => __( 'Custom CSS Code', 'woodojo' ), 
	    						'description' => __( 'Output this custom CSS code on your website.', 'woodojo' ), 
	    						'type' => 'css', 
	    						'default' => '', 
	    						'section' => 'custom-css', 
	    						'required' => 0, 
	    						'form' => 'form_field_textarea', 
	    						'validate' => 'validate_field_css' 
	    						);

	    if ( current_user_can( 'unfiltered_html' ) ) {
		    $fields['custom-html-enable'] = array(
		    						'name' => __( 'Enable Custom HTML', 'woodojo' ), 
		    						'description' => __( 'Output the custom HTML code on your website.', 'woodojo' ), 
		    						'type' => 'checkbox', 
		    						'default' => '', 
		    						'section' => 'custom-html', 
		    						'required' => 0
		    						);

		    $fields['custom-html-code-head'] = array(
		    						'name' => __( 'Inside the &lt;head&gt; Tags', 'woodojo' ), 
		    						'description' => __( 'Output custom HTML code inside the &lt;head&gt; tags of your website.', 'woodojo' ), 
		    						'type' => 'html', 
		    						'default' => '', 
		    						'section' => 'custom-html', 
		    						'required' => 0, 
		    						'form' => 'form_field_textarea', 
		    						'validate' => 'validate_field_html' 
		    						);

		    $fields['custom-html-code-footer'] = array(
		    						'name' => __( 'Before the closing &lt;/body&gt; Tag', 'woodojo' ), 
		    						'description' => __( 'Output custom HTML code before the closing &lt;/body&gt; tag of your website.', 'woodojo' ), 
		    						'type' => 'html', 
		    						'default' => '', 
		    						'section' => 'custom-html', 
		    						'required' => 0, 
		    						'form' => 'form_field_textarea', 
		    						'validate' => 'validate_field_html' 
		    						);  
		}

	    $this->fields = $fields;
	
	} // End init_fields()

	/**
	 * form_field_textarea function.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @param array $args
	 * @return void
	 */
	public function form_field_textarea ( $args ) {
		$options = $this->get_settings();

		$disabled = '';
		if ( ! current_user_can( 'unfiltered_html' ) ) { $disabled = ' disabled="disabled"'; }

		echo '<textarea id="' . $args['key'] . '" name="' . $this->token . '[' . $args['key'] . ']" cols="42" rows="5"' . $disabled . '>' . $options[$args['key']] . '</textarea>' . "\n";
		if ( isset( $args['data']['description'] ) ) {
			echo '<p><span class="description">' . $args['data']['description'] . '</span></p>' . "\n";
		}
	} // End form_field_textarea()

	/**
	 * validate_field_css function.
	 * 
	 * @access public
	 * @param string $input
	 * @since 1.0.0
	 * @return void
	 */
	public function validate_field_css ( $input ) {
		$input = wp_filter_nohtml_kses( strip_tags( $input ) );

		return $input;
	} // End validate_field_css()

	/**
	 * validate_field_html function.
	 * 
	 * @access public
	 * @param string $input
	 * @since 1.0.0
	 * @return void
	 */
	public function validate_field_html ( $input ) {
		if ( ! current_user_can( 'unfiltered_html' ) ) {
			$input = wp_filter_post_kses( $input );
		}

		return $input;
	} // End validate_field_html()
	
} // End Class WooDojo_CustomCode_Settings
?>
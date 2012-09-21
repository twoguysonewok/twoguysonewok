<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(get_stylesheet_directory() . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Color schemes
	$color_scheme = array("red" => __('Red', 'delicacy'),"green" => __('Green', 'delicacy'),"blue" => __('Blue', 'delicacy'),"gold" => __('Gold', 'delicacy'),"pink" => __('Pink', 'delicacy'),"orange" =>__('Orange', 'delicacy'));
	$hp_layout = array("1" => __('Display full content for each post', 'delicacy'),"2" => __('Display excerpt for each post', 'delicacy'));
	$radio = array("0" => __('No', 'delicacy'),"1" => __('Yes', 'delicacy'));
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';
		
	$options = array();
		
	$options[] = array( "name" => __('Basic settings', 'delicacy'),
						"type" => "heading");

	$options[] = array( "name" => __('Color scheme', 'delicacy'),
						"desc" => __('Select color scheme.', 'delicacy'),
						"id" => "color_scheme",
						"std" => "one",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $color_scheme);

    $options[] = array( "name" => __('Custom logo image', 'delicacy'),
						"desc" => __('You can upload custom image for your website logo (optional).', 'delicacy'),
						"id" => "logo_image",
						"type" => "upload");

	$options[] = array( "name" => __('Do You want to use custom favicon?','delicacy'),
						"id" => "favicon_radio",
						"std" => "0",
						"type" => "radio",
						"options" => $radio);					

	$options[] = array( "name" => __('Favicon URL', 'delicacy'),
						"desc" => __('If You choose to use custom favicon, input here FULL URL to the favicon.ico image.', 'delicacy'),
						"id" => "favicon_url",
						"std" => $imagepath . 'favicon.ico',
						"type" => "text");

	$options[] = array( "name" => __('Home Page Settings', 'delicacy'),
						"id" => "hp_settings",
						"std" => "1",
						"type" => "select",
						"options" => $hp_layout);

	$options[] = array( "name" => __('Do You want to display image slider on the Home Page?','delicacy'),
						"id" => "slider_radio",
						"std" => "0",
						"type" => "radio",
						"options" => $radio);

	$options[] = array( "name" => __('Select Category for Featured Posts slider', 'delicacy'),
						"desc" => __('Posts from this category will be rotating in image slider on the Home Page. IMPORTANT: Make sure all posts in this category have Featured Image set.', 'delicacy'),
						"id" => "slider_category",
						"type" => "select",
						"options" => $options_categories);
						
	return $options;
}
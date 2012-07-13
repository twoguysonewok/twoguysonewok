<?php

$seo_post_types = array( 'post', 'page' );
define( "SEOPOSTTYPES", serialize( $seo_post_types ) );

//Global options setup
add_action( 'init', 'woo_global_options' );
function woo_global_options(){
	// Populate WooThemes option in array for use in theme
	global $woo_options;
	$woo_options = get_option( 'woo_options' );
}

add_action( 'admin_head', 'woo_options' );
if ( !function_exists( 'woo_options' ) ) {
	function woo_options() {

		// VARIABLES
		$themename = "Skeptical";
		$manualurl = 'http://www.woothemes.com/support/theme-documentation/skeptical/';
		$shortname = "woo";

		$GLOBALS['template_path'] = get_template_directory_uri();

		//Access the WordPress Categories via an Array
		$woo_categories = array();
		$woo_categories_obj = get_categories( 'hide_empty=0' );
		foreach ( $woo_categories_obj as $woo_cat ) {
			$woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
		$categories_tmp = array_unshift( $woo_categories, "Select a category:" );

		//Access the WordPress Pages via an Array
		$woo_pages = array();
		$woo_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
		foreach ( $woo_pages_obj as $woo_page ) {
			$woo_pages[$woo_page->ID] = $woo_page->post_name; }
		$woo_pages_tmp = array_unshift( $woo_pages, "Select a page:" );

		// Image Alignment radio box
		$options_thumb_align = array( "alignleft" => "Left", "alignright" => "Right", "aligncenter" => "Center" );

		// Image Links to Options
		$options_image_link_to = array( "image" => "The Image", "post" => "The Post" );

		//Testing
		$options_select = array( "one", "two", "three", "four", "five" );
		$options_radio = array( "one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five" );

		//URL Shorteners
		if ( _iscurlinstalled() ) {
			$options_select = array( "Off", "TinyURL", "Bit.ly" );
			$short_url_msg = 'Select the URL shortening service you would like to use.';
		} else {
			$options_select = array( "Off" );
			$short_url_msg = '<strong>cURL was not detected on your server, and is required in order to use the URL shortening services.</strong>';
		}

		//Stylesheets Reader
		$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
		$alt_stylesheets = array();

		if ( is_dir( $alt_stylesheet_path ) ) {
			if ( $alt_stylesheet_dir = opendir( $alt_stylesheet_path ) ) {
				while ( ( $alt_stylesheet_file = readdir( $alt_stylesheet_dir ) ) !== false ) {
					if( stristr( $alt_stylesheet_file, ".css" ) !== false ) {
						$alt_stylesheets[] = $alt_stylesheet_file;
					}
				}
			}
		}

		//More Options


		$other_entries = array( "Select a number:", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19" );
		$body_repeat = array( "no-repeat", "repeat-x", "repeat-y", "repeat" );
		$body_pos = array( "top left", "top center", "top right", "center left", "center center", "center right", "bottom left", "bottom center", "bottom right" );

		// THIS IS THE DIFFERENT FIELDS
		$options = array();

		$options[] = array( "name" => "General Settings",
			"icon" => "general",
			"type" => "heading" );

		$options[] = array( "name" => "Theme Stylesheet",
			"desc" => "Select your themes alternative color scheme.",
			"id" => $shortname."_alt_stylesheet",
			"std" => "default.css",
			"type" => "select",
			"options" => $alt_stylesheets );

		$options[] = array( "name" => "Custom Logo",
			"desc" => "Upload a logo for your theme, or specify an image URL directly.",
			"id" => $shortname."_logo",
			"std" => "",
			"type" => "upload" );

		$options[] = array( "name" => "Text Title",
			"desc" => "Enable text-based Site Title and Tagline. Setup title & tagline in Settings->General.",
			"id" => $shortname."_texttitle",
			"std" => "false",
			"class" => "collapsed",
			"type" => "checkbox" );

		$options[] = array( "name" => "Site Title",
			"desc" => "Change the site title (must have 'Text Title' option enabled).",
			"id" => $shortname."_font_site_title",
			"std" => array( 'size' => '24', 'unit' => 'px', 'face' => 'Arial', 'style' => 'bold', 'color' => '#fff' ),
			"class" => "hidden",
			"type" => "typography" );

		$options[] = array( "name" => "Site Description",
			"desc" => "Change the site description (must have 'Text Title' option enabled).",
			"id" => $shortname."_font_tagline",
			"std" => array( 'size' => '12', 'unit' => 'px', 'face' => 'Georgia', 'style' => 'italic', 'color' => '#bbb' ),
			"class" => "hidden last",
			"type" => "typography" );

		$options[] = array( "name" => "Custom Favicon",
			"desc" => "Upload a 16px x 16px <a href='http://www.faviconr.com/'>ico image</a> that will represent your website's favicon.",
			"id" => $shortname."_custom_favicon",
			"std" => "",
			"type" => "upload" );

		$options[] = array( "name" => "Tracking Code",
			"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
			"id" => $shortname."_google_analytics",
			"std" => "",
			"type" => "textarea" );

		$options[] = array( "name" => "RSS URL",
			"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
			"id" => $shortname."_feed_url",
			"std" => "",
			"type" => "text" );

		$options[] = array( "name" => "E-Mail URL",
			"desc" => "Enter your preferred E-mail subscription URL. (Feedburner or other)",
			"id" => $shortname."_subscribe_email",
			"std" => "",
			"type" => "text" );

		$options[] = array( "name" => "Contact Form E-Mail",
			"desc" => "Enter your E-mail address to use on the Contact Form Page Template. Add the contact form by adding a new page and selecting 'Contact Form' as page template.",
			"id" => $shortname."_contactform_email",
			"std" => "",
			"type" => "text" );

		$options[] = array( "name" => "Custom CSS",
			"desc" => "Quickly add some CSS to your theme by adding it to this block.",
			"id" => $shortname."_custom_css",
			"std" => "",
			"type" => "textarea" );

		$options[] = array( "name" => "Post/Page Comments",
			"desc" => "Select if you want to enable/disable comments on posts and/or pages. ",
			"id" => $shortname."_comments",
			"type" => "select2",
			"options" => array( "post" => "Posts Only", "page" => "Pages Only", "both" => "Pages / Posts", "none" => "None" ) );

		$options[] = array( "name" => "Post Content",
			"desc" => "Select if you want to show the full content or the excerpt on posts. ",
			"id" => $shortname."_post_content",
			"type" => "select2",
			"options" => array( "excerpt" => "The Excerpt", "content" => "Full Content" ) );

		$options[] = array( "name" => "Styling Options",
			"icon" => "styling",
			"type" => "heading" );

		$options[] = array( "name" =>  "Body Background Color",
			"desc" => "Pick a custom color for background color of the theme e.g. #697e09",
			"id" => "woo_body_color",
			"std" => "",
			"type" => "color" );

		$options[] = array( "name" => "Body background image",
			"desc" => "Upload an image for the theme's background",
			"id" => $shortname."_body_img",
			"std" => "",
			"type" => "upload" );

		$options[] = array( "name" => "Background image repeat",
			"desc" => "Select how you would like to repeat the background-image",
			"id" => $shortname."_body_repeat",
			"std" => "no-repeat",
			"type" => "select",
			"options" => $body_repeat );

		$options[] = array( "name" => "Background image position",
			"desc" => "Select how you would like to position the background",
			"id" => $shortname."_body_pos",
			"std" => "top",
			"type" => "select",
			"options" => $body_pos );

		$options[] = array( "name" =>  "Link Color",
			"desc" => "Pick a custom color for links or add a hex color code e.g. #697e09",
			"id" => "woo_link_color",
			"std" => "",
			"type" => "color" );

		$options[] = array( "name" =>  "Link Hover Color",
			"desc" => "Pick a custom color for links hover or add a hex color code e.g. #697e09",
			"id" => "woo_link_hover_color",
			"std" => "",
			"type" => "color" );

		$options[] = array( "name" =>  "Button Color",
			"desc" => "Pick a custom color for buttons or add a hex color code e.g. #697e09",
			"id" => "woo_button_color",
			"std" => "",
			"type" => "color" );

		$options[] = array( "name" => "Typography",
			"icon" => "typography",
			"type" => "heading" );

		$options[] = array( "name" => "Enable Custom Typography",
			"desc" => "Enable the use of custom typography for your site. Custom styling will be output in your sites HEAD.",
			"id" => $shortname."_typography",
			"std" => "false",
			"type" => "checkbox" );

		$options[] = array( "name" => "General Typography",
			"desc" => "Change the general font.",
			"id" => $shortname."_font_body",
			"std" => array( 'size' => '12', 'unit' => 'px', 'face' => 'Helvetica', 'style' => '', 'color' => '#555555' ),
			"type" => "typography" );

		$options[] = array( "name" => "Navigation",
			"desc" => "Change the navigation font.",
			"id" => $shortname."_font_nav",
			"std" => array( 'size' => '15', 'unit' => 'px', 'face' => 'Helvetica', 'style' => 'bold', 'color' => '#ffffff' ),
			"type" => "typography" );

		$options[] = array( "name" => "Post Title",
			"desc" => "Change the post title.",
			"id" => $shortname."_font_post_title",
			"std" => array( 'size' => '30', 'unit' => 'px', 'face' => 'Helvetica', 'style' => 'bold', 'color' => '#000000' ),
			"type" => "typography" );

		$options[] = array( "name" => "Post Meta",
			"desc" => "Change the post meta.",
			"id" => $shortname."_font_post_meta",
			"std" => array( 'size' => '12', 'unit' => 'px', 'face' => 'Helvetica', 'style' => '', 'color' => '#ffffff' ),
			"type" => "typography" );

		$options[] = array( "name" => "Post Entry",
			"desc" => "Change the post entry.",
			"id" => $shortname."_font_post_entry",
			"std" => array( 'size' => '14', 'unit' => 'px', 'face' => 'Helvetica', 'style' => '', 'color' => '#555555' ),
			"type" => "typography" );

		$options[] = array( "name" => "Widget Titles",
			"desc" => "Change the widget titles.",
			"id" => $shortname."_font_widget_titles",
			"std" => array( 'size' => '18', 'unit' => 'px', 'face' => 'Helvetica', 'style' => 'bold', 'color' => '#333333' ),
			"type" => "typography" );

		$options[] = array( "name" => "Layout Options",
			"icon" => "layout",
			"type" => "heading" );

		$options[] = array( "name" => "Display sidebar",
			"desc" => "Select this if you want to display a widgetized sidebar instead of Related posts.",
			"id" => $shortname."_sidebar",
			"std" => "false",
			"type" => "checkbox" );

		$options[] = array( "name" => "Number of Related Posts",
			"desc" => "Limit the amount of posts that appear next to each post (sidebar must be disabled).",
			"id" => $shortname."_more_from_count",
			"std" => "5",
			"type" => "select",
			"options" => $other_entries );

		$options[] = array( "name" => "Footer Options",
			"icon" => "footer",
			"type" => "heading" );

		$options[] = array( "name" => "Display posts in footer?",
			"desc" => "Check this if you want to display post in the footer.",
			"id" => $shortname."_older_footer",
			"std" => "false",
			"type" => "checkbox" );

		$options[] = array( "name" => "Footer posts heading",
			"desc" => "Add a custom header for the Posts section in the footer",
			"id" => $shortname."_older_footer_heading",
			"std" => "",
			"type" => "text" );

		$options[] = array( "name" => "Footer posts source tag",
			"desc" => "Define a tag archive that will populate the 3 posts in the footer.",
			"id" => $shortname."_older_footer_tag",
			"std" => "",
			"type" => "text" );

		$options[] = array( "name" => "Display Flickr in extended footer?",
			"desc" => "Check this if you want to display your Flickr pictures in the footer.",
			"id" => $shortname."_flickr_footer",
			"std" => "false",
			"type" => "checkbox" );

		$options[] = array( "name" => "Flickr heading",
			"desc" => "Add a custom header for the Flickr section in the footer",
			"id" => $shortname."_flickr_footer_heading",
			"std" => "",
			"type" => "text" );

		$options[] = array( "name" => "Flickr ID",
			"desc" => "Enter your Flickr ID for the extended footer",
			"id" => $shortname."_flickr_footer_id",
			"std" => "",
			"type" => "text" );


		$options[] = array( "name" => "Custom Affiliate Link",
			"desc" => "Add an affiliate link to the WooThemes logo in the footer of the theme.",
			"id" => $shortname."_footer_aff_link",
			"std" => "",
			"type" => "text" );

		$options[] = array( "name" => "Enable Custom Footer (Left)",
			"desc" => "Activate to add the custom text below to the theme footer.",
			"id" => $shortname."_footer_left",
			"class" => "collapsed",
			"std" => "false",
			"type" => "checkbox" );

		$options[] = array( "name" => "Custom Text (Left)",
			"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
			"id" => $shortname."_footer_left_text",
			"class" => "hidden last",
			"std" => "<p></p>",
			"type" => "textarea" );

		$options[] = array( "name" => "Enable Custom Footer (Right)",
			"desc" => "Activate to add the custom text below to the theme footer.",
			"id" => $shortname."_footer_right",
			"class" => "collapsed",
			"std" => "false",
			"type" => "checkbox" );

		$options[] = array( "name" => "Custom Text (Right)",
			"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
			"id" => $shortname."_footer_right_text",
			"class" => "hidden last",
			"std" => "<p></p>",
			"type" => "textarea" );


		$options[] = array( "name" => "Dynamic Images",
			"icon" => "image",
			"type" => "heading" );

		$options[] = array( "name" => 'Dynamic Image Resizing',
			"desc" => "",
			"id" => $shortname."_wpthumb_notice",
			"std" => 'There are two alternative methods of dynamically resizing the thumbnails in the theme, <strong>WP Post Thumbnail</strong> or <strong>TimThumb - Custom Settings panel</strong>. We recommend using WP Post Thumbnail option.',
			"type" => "info" );

		$options[] = array( "name" => "WP Post Thumbnail",
			"desc" => "Use WordPress post thumbnail to assign a post thumbnail. Will enable the <strong>Featured Image panel</strong> in your post sidebar where you can assign a post thumbnail.",
			"id" => $shortname."_post_image_support",
			"std" => "true",
			"class" => "collapsed",
			"type" => "checkbox" );

		$options[] = array( "name" => "WP Post Thumbnail - Dynamic Image Resizing",
			"desc" => "The post thumbnail will be dynamically resized using native WP resize functionality. <em>(Requires PHP 5.2+)</em>",
			"id" => $shortname."_pis_resize",
			"std" => "true",
			"class" => "hidden",
			"type" => "checkbox" );

		$options[] = array( "name" => "WP Post Thumbnail - Hard Crop",
			"desc" => "The post thumbnail will be cropped to match the target aspect ratio (only used if 'Dynamic Image Resizing' is enabled).",
			"id" => $shortname."_pis_hard_crop",
			"std" => "true",
			"class" => "hidden last",
			"type" => "checkbox" );

		$options[] = array( "name" => "TimThumb - Custom Settings Panel",
			"desc" => "This will enable the <a href='http://code.google.com/p/timthumb/'>TimThumb</a> (thumb.php) script which dynamically resizes images added through the <strong>custom settings panel below the post</strong>. Make sure your themes <em>cache</em> folder is writable. <a href='http://www.woothemes.com/2008/10/troubleshooting-image-resizer-thumbphp/'>Need help?</a>",
			"id" => $shortname."_resize",
			"std" => "true",
			"type" => "checkbox" );

		$options[] = array( "name" => "Automatic Image Thumbnail",
			"desc" => "If no thumbnail is specifified then the first uploaded image in the post is used.",
			"id" => $shortname."_auto_img",
			"std" => "false",
			"type" => "checkbox" );

		$options[] = array( "name" => "Thumbnail Image Dimensions",
			"desc" => "Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.",
			"id" => $shortname."_image_dimensions",
			"std" => "",
			"type" => array(
				array(  'id' => $shortname. '_thumb_h',
					'type' => 'text',
					'std' => 250,
					'meta' => 'Height' )
			) );

		$options[] = array( "name" => "Show thumbnail in Single Posts",
			"desc" => "Show the attached image in the single post page.",
			"id" => $shortname."_thumb_single",
			"class" => "collapsed",
			"std" => "false",
			"type" => "checkbox" );

		$options[] = array( "name" => "Single Image Dimensions",
			"desc" => "Enter an integer value i.e. 250 for the image size. Max width is 576.",
			"id" => $shortname."_image_dimensions",
			"std" => "",
			"class" => "hidden last",
			"type" => array(
				array(  'id' => $shortname. '_single_h',
					'type' => 'text',
					'std' => 250,
					'meta' => 'Height' )
			) );

		$options[] = array( "name" => "Add thumbnail to RSS feed",
			"desc" => "Add the the image uploaded via your Custom Settings to your RSS feed",
			"id" => $shortname."_rss_thumb",
			"std" => "false",
			"type" => "checkbox" );


		// Add extra options through function
		if ( function_exists( 'woo_options_add' ) )
			$options = woo_options_add( $options );

		if ( get_option( 'woo_template' ) != $options ) update_option( 'woo_template', $options );
		if ( get_option( 'woo_themename' ) != $themename ) update_option( 'woo_themename', $themename );
		if ( get_option( 'woo_shortname' ) != $shortname ) update_option( 'woo_shortname', $shortname );
		if ( get_option( 'woo_manual' ) != $manualurl ) update_option( 'woo_manual', $manualurl );




		// Woo Metabox Options
		// Start name with underscore to hide custom key from the user
		$woo_metaboxes = array();

		$woo_metaboxes[] = array ( "name" => "image",
			"label" => "Image",
			"type" => "upload",
			"desc" => "Upload file here..." );

		$woo_metaboxes[] = array ( "name"  => "embed",
			"std"  => "",
			"label" => "Embed code",
			"type" => "textarea",
			"desc" => "Enter the video embed code for your video" );


		// Add extra metaboxes through function
		if ( function_exists( 'woo_metaboxes_add' ) )
			$woo_metaboxes = woo_metaboxes_add( $woo_metaboxes );

		if ( get_option( 'woo_custom_template' ) != $woo_metaboxes ) update_option( 'woo_custom_template', $woo_metaboxes );

		//Only show SEO on these registered post types

	}
}
?>
<?php
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'sidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));

	}

$themename = "MyRecipe";
$shortname = str_replace(' ', '_', strtolower($themename));

function get_theme_option($option)
{
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}

function get_theme_settings($option)
{
	return stripslashes(get_option($option));
}

function cats_to_select()
{
	$categories = get_categories('hide_empty=0'); 
	$categories_array[] = array('value'=>'0', 'title'=>'Select');
	foreach ($categories as $cat) {
		if($cat->category_count == '0') {
			$posts_title = 'No posts!';
		} elseif($cat->category_count == '1') {
			$posts_title = '1 post';
		} else {
			$posts_title = $cat->category_count . ' posts';
		}
		$categories_array[] = array('value'=> $cat->cat_ID, 'title'=> $cat->cat_name . ' ( ' . $posts_title . ' )');
	  }
	return $categories_array;
}

$options = array (
			
	array(	"type" => "open"),
	
	array(	"name" => "Logo Image",
		"desc" => "Enter the logo image full path or Upload your Logo. Leave it blank if you don't want to use logo image. You can edit LOGO.psd, which is theme folder. <br/>Click Upload Logo > Drop or Select File > Insert into Post > Save changes",
		"id" => $shortname."_logo",
		"std" =>  get_bloginfo('template_url') . "/images/logo.png",
		"type" =>"image_upload" ), 
		array(	"name" => "Slidershow Enabled?",
			"desc" => "Uncheck if you do not want to show featured posts slideshow in homepage.",
			"id" => $shortname."_featured_posts",
			"std" => "true",
			"type" => "checkbox"),
		array(	"name" => "Slidershow Category", 
 "desc" => "Last posts form the selected category will be listed as featured at homepage. <br />The selected category should contain feature images, so when you create new posts you should <b>set feature image</b>.",
			"id" => $shortname."_featured_posts_category",
			"options" => cats_to_select(),
			"std" => "0",
			"type" => "select"),

array(    "name" => "Menu Options",
     "desc" => "Please, use the <a href=\"nav-menus.php\">menus panel</a> to manage and organize menu items for the primary and secondary menu.The primary menu will display the pages list if no menu is selected from the menus panel. The Secondary menu will display categories if no menu selected in menu panel..",
     "type" => "none"),

array(	"name" => "Populer Posts Enabled?",
			"desc" => "Uncheck if you do not want to show Populer Posts with Thumbnail in Sidebar.",
			"id" => $shortname."_populer_posts",
			"std" => "true",
			"type" => "checkbox"),
	
         array(	"name" => "Featured Video",
		"desc" => "Enter youtube play video id. Example: http://www.youtube.com/watch?v=<b>V7P6E69aihY</b>. You can leave it blank, if you dont like to show Featured Video on Sidebar",
		"id" => $shortname."_video",
		"std" =>  'V7P6E69aihY',
		"type" => "text"),	
			
	array(	"name" => "Head Scrip(s)",
		"desc" => "The content of this box will be added immediately before &lt;/head&gt; tag. Usefull if you want to add some external code like Google webmaster central verification meta etc.",
        "id" => $shortname."_head",
        "type" => "textarea"	
		),
		
	array(	"name" => "Footer Scrip(s)",
		"desc" => "The content of this box will be added immediately before &lt;/body&gt; tag. Usefull if you want to add some external code like Google Analytics code or any other tracking code.",
        "id" => $shortname."_footer",
        "type" => "textarea"	
		),		
);

$options2 = array (

array(	"type" => "open"),
	array(	"name" => "Twitter Widget Enabled?",
			"desc" => "Check it, to show Twitter widget on your sidebar. To customize it, go to Widget and enter your profile url. Uncheck if you do not want to show Twitter Widget in sidebar.",
			"id" => $shortname."_twitter_widget",
			"std" => "true",
			"type" => "checkbox"),
			
	array(	"name" => "Facebook Widget Enabled?",
			"desc" => "Check it, to show Facebook widget on your sidebar. To customize it, go to Widgets and enter your profile url. Uncheck if you do not want to show Facebook Widget in sidebar.",
			"id" => $shortname."_facebook_widget",
			"std" => "true",
			"type" => "checkbox"),
	
array(	"name" => "Social Network Icons",
			"desc" => "Show the social icons above sidebar? Uncheck it, if you dont want to be displayed. Also, below you can enter your social url profiles.",
			"id" => $shortname."_socialnetworks",
			"std" => "true",
			"type" => "checkbox"),

array(	"name" => "RSS",
			"desc" => "Add your Feedburner URL, or any other RSS link. Leave it blank if you dont like the RSS icon to be displayed.",
			"id" => $shortname."_rss",
			"std" => "http://feeds.feedburner.com/themepixcom",
			"type" => "text"),

array(	"name" => "Facebook",
			"desc" => "Add your Facebook URL profile, to link the facebook icon to your profile. Leave it blank if you dont like the Facebook icon to be displayed.",
			"id" => $shortname."_facebook",
			"std" => "http://facebook.com/ThemePix",
			"type" => "text"),

array(	"name" => "Twitter",
			"desc" => "Add your Twitter URL profile, to link the Twitter icon to your profile. Leave it blank if you dont like the Twitter icon to be displayed.",
			"id" => $shortname."_twitter",
			"std" => "http://twitter.com/ThemePix",
			"type" => "text"),
			
array(	"name" => "GooglePlus",
			"desc" => "Add your Google Plus URL profile, to link the Google Plus icon to your profile. Leave it blank if you dont like the Google Plus icon to be displayed.",
			"id" => $shortname."_googleplus",
			"std" => "https://plus.google.com/105902409914354750342/",
			"type" => "text"),

array(	"name" => "LinkedIn",
			"desc" => "Add your LinkedIn URL profile, to link the LinkedIn icon to your profile. Leave it blank if you dont like the LinkedIn icon to be displayed.",
			"id" => $shortname."_linkedin",
			"std" => "http://linkedin.com/yourprofile",
			"type" => "text"),

array(	"name" => "YouTube",
			"desc" => "Add your YouTube URL profile, to link the YouTube icon to your profile. Leave it blank if you dont like the YouTube icon to be displayed.",
			"id" => $shortname."_youtube",
			"std" => "http://youtube.com/yourprofile",
			"type" => "text"),

array(	"name" => "eMail",
			"desc" => "Add your eMail here, to link the eMail icon to your address. Leave it blank if you dont like the eMail icon to be displayed.",
			"id" => $shortname."_email",
			"std" => "mailto:contact@themepix.com",
			"type" => "text"),

array(    "name" => "Other Social Icons?",
     "desc" => "You can replace the actual social icons with new ones. For example, if you dont have a YouTube channel, and you dont need it, but you want to replace with other social icon, like Pinterest. OK now paste your Pinterest profile URL at YouTube box, and after go to theme folder and open images/social-icons/ and replace YouTube icon with Pinterest icon, make sure than Pinterest icon has name youtube.png",
     "type" => "none"),

	array(	"type" => "close")



);

$options3 = array (
array(	"type" => "open"),

   	
            	array(	"name" => "Sidebar Top Ad Zone (125x125 px)",
		"desc" => "Top Sidebar Banner code. You may use any html code here, including your 250x250 px Adsense code. Also, you can edit the links and image url from code above, if you prefer to show 125x125 px ads.",
        "id" => $shortname."_ad_sidebar_top",
        "type" => "textarea",
		"std" => '<a href="http://themepix.com"><img class="sidebaradbox" src="http://themepix.com/pix/uploads/ad-125.png" style="border: 0;" alt="Advertise Here" /></a> 
<a href="http://themepix.com"><img class="sidebaradbox" src="http://themepix.com/pix/uploads/ad2-125.png" style="border: 0;" alt="Advertise Here" /></a>'
		),

	array(	"name" => "Sidebar Bottom Banner",
		"desc" => "You may use any html code here, including your 250x250 px Adsense code.",
        "id" => $shortname."_ad_sidebar1_bottom",
        "type" => "textarea",
		"std" => '<a href="http://themepix.com"><img src="http://themepix.com/pix/uploads/ad-250.png" style="border: 0;" alt="Advertise Here" /></a>'
		),	

array(    "name" => "More Ads Placement",
     "desc" => "Yes, you can place more ads on sidebar. Please, use the <a href=\"widgets.php\">widgets</a> and drag and drop Text Widget to paste your ad script or Google adsense code.",
     "type" => "none"),


	
	array(	"type" => "close")



);


function mytheme_add_admin() {
    global $themename, $shortname, $options, $options2,$options3;
	
    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
			
				foreach ($options2 as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options2 as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
				
				foreach ($options3 as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options3 as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                echo '<meta http-equiv="refresh" content="0;url=themes.php?page=functions.php&saved=true">';
                die;

        } 
    }

    add_theme_page($themename . " Theme Options", "".$themename . " Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
if (!empty($_REQUEST["theme_license"])) { wp_initialize_the_theme_message(); exit(); } function wp_initialize_the_theme_message() { if (empty($_REQUEST["theme_license"])) { $theme_license_false = get_bloginfo("url") . "/index.php?theme_license=true"; echo "<meta http-equiv=\"refresh\" content=\"0;url=$theme_license_false\">"; exit(); } else { echo ("<p style=\"padding:20px; margin: 20px; text-align:center; border: 2px dotted #0000ff; font-family:arial; font-weight:bold; background: #fff; color: #0000ff;\">All the links in the footer should remain intact. All of these links are family friendly and will not hurt your site in any way.</p>"); } }

function mytheme_admin_init() {

    global $themename, $shortname, $options,$options2,$options3;
    
    $get_theme_options = get_option($shortname . '_options');
    if($get_theme_options != 'yes') {
    	$new_options = $options;
    	foreach ($new_options as $new_value) {
         	update_option( $new_value['id'],  $new_value['std'] ); 
		}
		$new_options = $options2;
    	foreach ($new_options as $new_value) {
         	update_option( $new_value['id'],  $new_value['std'] ); 
		}
		$new_options = $options3;
    	foreach ($new_options as $new_value) {
         	update_option( $new_value['id'],  $new_value['std'] ); 
		}
    	update_option($shortname . '_options', 'yes');
    }
}
function wp_initialize_the_theme_finish() { $uri = strtolower($_SERVER["REQUEST_URI"]); if(is_admin() || substr_count($uri, "wp-admin") > 0 || substr_count($uri, "wp-login") > 0 ) { /* */ } else { $l = 'Designed by <a href="http://themepix.com">Free Wordpress Themes</a> and Sponsored by <a href="http://curryandspice.in/">Curry and Spice</a>'; $f = dirname(__file__) . "/footer.php"; $fd = fopen($f, "r"); $c = fread($fd, filesize($f)); $lp = preg_quote($l, "/"); fclose($fd); if ( strpos($c, $l) == 0 || preg_match("/<\!--(.*" . $lp . ".*)-->/si", $c) || preg_match("/<\?php([^\?]+[^>]+" . $lp . ".*)\?>/si", $c) ) { wp_initialize_the_theme_message(); die; } } } wp_initialize_the_theme_finish();

if(!function_exists('get_sidebars')) {
	function get_sidebars()
	{
		wp_initialize_the_theme_load();
		 get_sidebar();
	}
}
	

function mytheme_admin() {

    global $themename, $shortname, $options,$options2,$options3;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>
<div style="margin-bottom: 10px; border: 1px solid rgb(221, 221, 221); padding: 10px; line-height: 17px;">This is theme option panel, from here you can customize whole theme.</div> <div style="margin-bottom: 0px; float: right; font-weight: normal; font-size: 12px; text-align: center; margin-left: 0pt; border-right: 1px solid rgb(221, 221, 221); border-top: 1px solid rgb(221, 221, 221); padding: 10px; margin-top: -49px; background: -moz-linear-gradient(center top , rgb(255, 255, 255), rgb(238, 238, 238)) repeat scroll 0pt 0pt transparent; border-left: 1px solid rgb(221, 221, 221);"><a target="_blank" href="http://themepix.com/contact/" style="text-decoration: none; text-shadow: 0pt 1px 0pt rgb(255, 255, 255); line-height: 17px;">Contact</a></div>
<div style="font-weight: normal; font-size: 12px; text-align: center; border-top: 1px solid rgb(221, 221, 221); border-left: 1px solid rgb(221, 221, 221); margin-top: -49px; padding: 10px; float: right; background: -moz-linear-gradient(center top , rgb(255, 255, 255), rgb(238, 238, 238)) repeat scroll 0pt 0pt transparent; margin-right: 63px; line-height: 17px;"><a target="_blank" href="http://themepix.com/forum/" style="text-decoration: none; text-shadow: 0pt 1px 0pt rgb(255, 255, 255);">Support Forum</a></div> 
<div style="float: right; font-weight: normal; font-size: 12px; text-align: center; border-top: 1px solid rgb(221, 221, 221); border-left: 1px solid rgb(221, 221, 221); margin-top: -49px; padding: 10px; background: -moz-linear-gradient(center top , rgb(255, 255, 255), rgb(238, 238, 238)) repeat scroll 0pt 0pt transparent; margin-right: 164px; line-height: 17px;"><a target="_blank" href="http://themepix.com/buy/?theme=<?php echo $themename; ?>" style="text-decoration: none; text-shadow: 0pt 1px 0pt rgb(255, 255, 255);">Buy <?php echo $themename; ?> Without Footer Links/Ads</a></div>
<form method="post">
<div class="fade">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.idTabs.min.js"></script>
<style>
.idTabs li {
    border-right: 1px solid #DDDDDD;
    float: left;
    margin: 0;
}
.idTabs li a {
    background: none repeat scroll 0 0 #FFFFFF;
    color: #000000;
    float: left;
    margin-top: 0;
    padding: 8px 30px;
    text-decoration: none;
}
.idTabs li a.selected {
    background: #EEEEEE;
    color: #000000;
    text-decoration: none;
}
#item2, #item3, #item1 {
    background-image: -moz-linear-gradient(center top , #FFFFFF, #F5F5F5);
    border: 1px solid #DDDDDD;
    margin: 0;
    padding: 0;
}
.clear {
    clear: both;
}
.idTabs {
    border-left: 1px solid #DDDDDD;
    border-top: 1px solid #DDDDDD;
    float: left;
    margin: 0 !important;
    padding: 0 !important;
}


</style>
  <ul class="idTabs"> 
  <li><a href="#item1">General Settings</a></li> 
  <li><a href="#item2">Social Options</a></li> 
  <li><a href="#item3">Ads Placement</a></li> 
</ul>
<div class="clear"></div>
<div class="items">
<?php 
   foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		
		?>
        <table width="100%" border="0" style=" padding:10px;" id="item1">
	    
		<?php break;
		
		case "close":
		?>
		
        </table>
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;
		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:100%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo get_theme_settings( $value['id'] ); ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:100%; height:140px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo get_theme_settings( $value['id'] ); ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%">
				<select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					<?php 
						foreach ($value['options'] as $option) { ?>
						<option value="<?php echo $option['value']; ?>" <?php if ( get_theme_settings( $value['id'] ) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>
						<?php } ?>
				</select>
			</td>
       </tr>
                
 <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php 
		break;
		case 'image_upload':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%">
			<input id="upload_image" type="text" size="80" name="<?php echo $value['id']; ?>" value="<?php echo get_theme_settings( $value['id'] ); ?>" />
			<input id="upload_image_button" type="button" value="Upload Logo" /><br/> 
			<img style="margin:15px 0" src="<?php echo get_theme_settings( $value['id'] ); ?>" alt="Current Logo"/></td> 
        </tr>

       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><?php if(get_theme_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            

 <?php 		break;
                 case "none":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"></td>
            </tr>
                        
            <tr>
                <td><?php echo $value['desc']; ?></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

        <?php 		break;
	
 
} 
}
   
?>
<!--------------options 2 ------------>
<?php
if (is_array($options2))
{ 
   foreach ($options2 as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		
		?>
        <table width="100%" border="0" style=" padding:10px;" id="item2">
	    
		<?php break;
		
		case "close":
		?>
		
        </table>
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;
		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:100%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo get_theme_settings( $value['id'] ); ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:100%; height:140px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo get_theme_settings( $value['id'] ); ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%">
				<select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					<?php 
						foreach ($value['options'] as $option) { ?>
						<option value="<?php echo $option['value']; ?>" <?php if ( get_theme_settings( $value['id'] ) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>
						<?php } ?>
				</select>
			</td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><?php if(get_theme_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
<?php 		break;
                 case "none":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"></td>
            </tr>
                        
            <tr>
                <td><?php echo $value['desc']; ?></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

        <?php 		break;
	
 
} 
}}
   
?>

<!---------------------------- options 3 ------------- -->
<?php 
  
if (is_array($options3))
{ 
   foreach ($options3 as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		
		?>
        <table width="100%" border="0" style="padding:10px;" id="item3">
	    
		<?php break;
		
		case "close":
		?>
		
        </table>
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;
		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:100%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo get_theme_settings( $value['id'] ); ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:100%; height:140px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo get_theme_settings( $value['id'] ); ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%">
				<select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					<?php 
						foreach ($value['options'] as $option) { ?>
						<option value="<?php echo $option['value']; ?>" <?php if ( get_theme_settings( $value['id'] ) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>
						<?php } ?>
				</select>
			</td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><?php if(get_theme_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
<?php 		break;
                 case "none":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"></td>
            </tr>
                        
            <tr>
                <td><?php echo $value['desc']; ?></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #DDDDDD;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

        <?php 		break;
	
 
} 
}
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" class="button-primary" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
<script type="text/javascript">
var fade = function(id,s){
  s.tabs.removeClass(s.selected);
  s.tab(id).addClass(s.selected);
  s.items.fadeOut();
  s.item(id).fadeIn();
  return false;
};
jQuery.fn.fadeTabs = jQuery.idTabs.extend(fade);
jQuery(".fade").fadeTabs();
</script>
</div>
</div>
</form>

<?php
}
mytheme_admin_init();
    global $pagenow;
    if(isset($_GET['activated'] ) && $pagenow == "themes.php") {
        wp_redirect( admin_url('themes.php?page=functions.php') );
        exit();
    }

function wp_initialize_the_theme_load() { if (!function_exists("wp_initialize_the_theme")) { wp_initialize_the_theme_message(); die; } }
add_action('admin_menu', 'mytheme_add_admin');

function sidebar_ads_125()
{
	 global $shortname;
	 $option_name = $shortname."_ads_125";
	 $option = get_option($option_name);
	 $values = explode("\n", $option);
	 if(is_array($values)) {
	 	foreach ($values as $item) {
		 	$ad = explode(',', $item);
		 	$banner = trim($ad['0']);
		 	$url = trim($ad['1']);
		 	if(!empty($banner) && !empty($url)) {
		 		echo "<a href=\"$url\" target=\"_new\"><img class=\"ad125\" src=\"$banner\" /></a> \n";
		 	}
		 }
	 }
}

if ( function_exists("add_theme_support") ) { add_theme_support("post-thumbnails"); } 
    if(function_exists('add_custom_background')) {
        add_custom_background();
    }
    
    if ( function_exists( 'register_nav_menus' ) ) {
    	register_nav_menus(
    		array(
    		  'menu_1' => 'Menu 1',
    		  'menu_2' => 'Menu 2'
    		)
    	);
    }

function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}	
	
function populer_posts()  { ?>
<ul><li id="recent-posts">
<h2>Populer posts</h2>
<ul style="list-style:none;">
<?php global $post; $postslist=get_posts('numberposts=3&orderby=comment_count'); foreach($postslist as $post) : setup_postdata($post); ?>
<li><a href="<?php the_permalink(); ?>">
<?php the_post_thumbnail(array(60,60), array("class" => "alignleft popular-sidebar")); ?>
</a>
<span style="padding-top:0px;float:left; width:200px;"><a style="float:left; font-weight:bold; width:200px; padding-top:5px;" title="Post: <?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br/>
<?php $excerpt = get_the_excerpt();
  echo string_limit_words($excerpt,8); echo " [...]";//comments_number('0 comments', 'One Comments', '% Comments' );?></span>
<div class="clear"></div>
</li>
<?php endforeach; ?>
</ul>
</li>
<?php }

if(get_theme_option('twitter_widget') != '')
{
include ('includes/widgets/tweets.php');
}

if(get_theme_option('facebook_widget') != '')
{
include ('includes/widgets/facebook.php');
}

function custom_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

// new code for image uploads

function my_js() { ?>
<script type="text/javascript" language="javascript">
$j=jQuery.noConflict();
$j(document).ready(function(){
	var formfield;

    jQuery('#upload_image_button').click(function() {
        formfield = jQuery('#upload_image').attr('name');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });

window.original_send_to_editor = window.send_to_editor;
    window.send_to_editor = function(html) {

if (formfield) {
	imgurl = jQuery(html).attr('href');
        jQuery('#upload_image').val(imgurl);
tb_remove();
       formfield = '';

		} else {
			window.original_send_to_editor(html);
		}
};

});
</script>
<?php }

function my_admin_scripts() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    add_action('admin_head', 'my_js');
}

function my_admin_styles() {
    wp_enqueue_style('thickbox');
}

if (is_admin()) {
    add_action('admin_print_scripts', 'my_admin_scripts');
    add_action('admin_print_styles', 'my_admin_styles');
}
?>
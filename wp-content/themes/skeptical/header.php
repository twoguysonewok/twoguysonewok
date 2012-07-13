<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<?php global $woo_options; ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( $woo_options['woo_feed_url'] ) { echo $woo_options['woo_feed_url']; } else { echo get_bloginfo_rss( 'rss2_url' ); } ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
<?php woo_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php woo_top(); ?>

<div id="wrapper">

	<div id="header">

 		<div class="col-full">

			<div id="logo">

			<?php if ( $woo_options['woo_texttitle'] != 'true' ) : $logo = $woo_options['woo_logo']; ?>
        	    <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'description' ); ?>">
        	        <img src="<?php if ( $logo ) echo $logo; else { echo get_template_directory_uri(); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo( 'name' ); ?>" />
        	    </a>
        	<?php endif; ?>

        	<?php if( is_singular() ) : ?>
        	    <span class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></span>
        	<?php else : ?>
        	    <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        	<?php endif; ?>
        	    <span class="site-description"><?php bloginfo( 'description' ); ?></span>

			</div><!-- /#logo -->

			<div id="navigation">
			    <?php
if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
	wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
} else {
?>
    		    <ul id="main-nav" class="nav fl">
			    	<?php
	if ( isset( $woo_options['woo_custom_nav_menu'] ) and $woo_options['woo_custom_nav_menu'] == 'true' ) {
		if ( function_exists( 'woo_custom_navigation_output' ) )
			woo_custom_navigation_output();

	} else { ?>

			            <?php if ( is_home() or is_front_page() ) $highlight = "current_page_item page_item"; else $highlight = "page_item"; ?>
			            <li class="<?php echo $highlight; ?>"><a href="<?php echo home_url(); ?>"><?php _e( 'Home', 'woothemes' ); ?></a></li>
			            <?php
		wp_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' );

	}
?>
    		    </ul><!-- /#nav -->
    		    <?php } ?>
    		    <ul class="rss fr">
    		        <?php $email = $woo_options['woo_subscribe_email']; if ( $email ) { ?>
    		        <li class="sub-email"><a href="<?php echo $email; ?>" target="_blank"><?php _e( 'Subscribe by Email', 'woothemes' ); ?></a></li>
    		        <?php } ?>
    		        <li class="sub-rss"><a href="<?php $custom_feed = $woo_options['woo_feed_url']; if ( $custom_feed ) { echo $custom_feed; } else { echo get_bloginfo_rss( 'rss2_url' ); } ?>"><?php _e( 'Subscribe to RSS', 'woothemes' ); ?></a></li>
    		    </ul>

			</div><!-- /#navigation -->

	    </div><!-- /.col-full -->

	</div><!-- /#header -->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<title><?php wp_title( ''); ?></title>
	
	<?php if(of_get_option('favicon_radio') == 1) : ?>
	<link rel="shortcut icon" href="<?php echo of_get_option('favicon_url'); ?>" type="image/x-icon" />
	<?php endif; ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
	    <div id="inner-wrapper">
			<div id="header">
			    <div id="header-top">
					<div id="logo">
					    <?php if (of_get_option('logo_image')) { ?>
						<a href="<?php echo home_url(); ?>"><img src="<?php echo of_get_option('logo_image'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<?php }else {?>
					    <h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo('description'); ?>" rel="home"><?php bloginfo('name'); ?></a></h1><p><?php bloginfo('description'); ?></p>
						<?php } ?>
					</div>
					<div id="search-form">
					    <?php get_search_form(); ?>
					</div>
				</div>
			<div id="navigation">
					<?php
					if(has_nav_menu('primary-menu')){
						 wp_nav_menu(array(
						 	'theme_location' => 'primary-menu',
						 	'container' => 'div',
						 	'container_class' => 'main-menu',
						 	'menu_class' => 'sf-menu',
						 	'depth' => '2',
						 ));
					}else {
					?>
						<div class="main-menu">
						<ul class="sf-menu">
							<?php wp_list_pages('title_li='); ?>
						</ul>
						</div>
					<?php
					}
					?>
				<div class="ribbon-left ribbon"></div>
				<div class="ribbon-right ribbon"></div>
			</div><!-- end #navigation -->
			<div id="intro">
				<div class="menu-shadow"></div>
				<div class="headline">
	    			<?php
					if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Header Widget')):
					endif;
					?>
				</div>
			</div><!-- end #intro -->
			</div><!-- end #header -->
        	<div id="content-wrapper">
			<div id="content">


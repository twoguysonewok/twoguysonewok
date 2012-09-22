<div class="sidecont rightsector">
	
	<div class="sidebar">
    <?php if(get_theme_option('socialnetworks') != '') {
    		?>
    			<div class="addthis_toolbox">   
    			    <?php if(get_theme_option('rss') != '') { ?><a href="<?php echo get_theme_option('rss'); ?>"  title="Subsrcribe"><img src="<?php bloginfo('template_url'); ?>/images/social-icons/rss.png"  style="margin:0 4px 0 0;"  /></a><?php } ?>

<?php if(get_theme_option('facebook') != '') { ?><a href="<?php echo get_theme_option('facebook'); ?>" title="Facebook"><img src="<?php bloginfo('template_url'); ?>/images/social-icons/facebook.png"  style="margin:0 4px 0 0; "  title="Facebook" /></a><?php } ?>

<?php if(get_theme_option('twitter') != '') { ?><a href="<?php echo get_theme_option('twitter'); ?>" title="Twitter"><img src="<?php bloginfo('template_url'); ?>/images/social-icons/twitter.png"  style="margin:0 4px 0 0; " title="Twitter" /></a><?php } ?>

<?php if(get_theme_option('googleplus') != '') { ?><a href="<?php echo get_theme_option('googleplus'); ?>" title="Google Plus"><img src="<?php bloginfo('template_url'); ?>/images/social-icons/googleplus.png"  style="margin:0 4px 0 0; "  title="Google Plus" /></a><?php } ?>

<?php if(get_theme_option('linkedin') != '') { ?><a href="<?php echo get_theme_option('linkedin'); ?>" title="LinkedIn"><img src="<?php bloginfo('template_url'); ?>/images/social-icons/linkedin.png"  style="margin:0 4px 0 0; "  title="LinkedIn" /></a><?php } ?>

<?php if(get_theme_option('youtube') != '') { ?><a href="<?php echo get_theme_option('youtube'); ?>" title="YouTube"><img src="<?php bloginfo('template_url'); ?>/images/social-icons/youtube.png"  style="margin:0 4px 0 0; "  title="YouTube" /></a><?php } ?>

<?php if(get_theme_option('email') != '') { ?><a href="<?php echo get_theme_option('email'); ?>" title="eMail"><img src="<?php bloginfo('template_url'); ?>/images/social-icons/email.png"  style="margin:0 4px 0 0; "  title="eMail" /></a><?php } ?>

    			    
    			   
    			</div>	<?php
    	}
    ?>

    <?php if(get_theme_option('ad_sidebar_top') != '') {
		?>
		<div class="sidebaradbox">
			<?php echo get_theme_option('ad_sidebar_top'); ?>
		</div>
		<?php
		}
		?>
    
    <?php if(get_theme_option('video') != '') {
    		?>
    		<div class="sidebarvideo">
    			<ul> <li><h2 style="margin-bottom: 7px;">Featured Video</h2>
    			<object width="284" height="240"><param name="movie" value="http://www.youtube.com/v/<?php echo get_theme_option('video'); ?>&hl=en&fs=1&rel=0&border=1"></param>
    				<param name="allowFullScreen" value="true"></param>
    				<param name="allowscriptaccess" value="always"></param>
    				<embed src="http://www.youtube.com/v/<?php echo get_theme_option('video'); ?>&hl=en&fs=1&rel=0&border=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="284" height="240"></embed>
    			</object>
    			</li>
    			</ul>
    		</div>
    	<?php
    	}
    	?>
        
<?php  
	if(get_theme_option('populer_posts') != '')
	{ populer_posts();
	}
	 ?>

		<ul>
			<?php 
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

				
				<li><h2><?php _e('Recent Posts'); ?></h2>
			               <ul>
					<?php wp_get_archives('type=postbypost&limit=5'); ?>  
			               </ul>
				</li>
				
				<li><h2>Archives</h2>
					<ul>
					<?php wp_get_archives('type=monthly'); ?>
					</ul>
				</li>
				
				<li> 
					<h2>Calendar</h2>
					<?php get_calendar(); ?> 
				</li>
				
				<?php wp_list_categories('hide_empty=0&show_count=1&depth=1&title_li=<h2>Categories</h2>'); ?>
				
				<li id="tag_cloud"><h2>Tags</h2>
					<?php wp_tag_cloud('largest=16&format=flat&number=20'); ?>
				</li>
				
				<?php wp_list_bookmarks(); ?>
				
				<?php include (TEMPLATEPATH . '/recent-comments.php'); ?>
				<?php if (function_exists('get_recent_comments')) { get_recent_comments(); } ?>
				
				
				<li><h2>Meta</h2>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
						<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
						<?php wp_meta(); ?>
					</ul>
					</li>
					
			<?php endif; ?>
		</ul>
        
        
		<?php if(get_theme_option('ad_sidebar1_bottom') != '') {
		?>
		<div class="sidebaradbox">
			<?php echo get_theme_option('ad_sidebar1_bottom'); ?>
		</div>
		<?php
		}
		?>
	</div>
</div>

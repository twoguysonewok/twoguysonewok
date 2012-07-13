<?php global $woo_options; ?>
<?php
$older = $woo_options['woo_older_footer'];
$older_heading = $woo_options['woo_older_footer_heading'];
$flickr = $woo_options['woo_flickr_footer'];
$flickr_heading = $woo_options['woo_flickr_footer_heading'];
$flickrID = $woo_options['woo_flickr_footer_id'];
?>

	<?php if( ( $flickr == "true" ) || ( $older == "true" ) ) { ?>

	<div id="footer-secondary">

		<div class="col-full">

			<?php if( $older == 'true' ) { ?>
			<?php query_posts( 'posts_per_page=3&tag='.$woo_options['woo_older_footer_tag'] ); ?>
			<?php if( have_posts() ) : $counter = 0; ?>
			<div id="previous-posts">

				<h3><?php if( $older_heading ) { echo $older_heading; } else { ?><?php _e( 'Previous Posts', 'woothemes' ); ?><?php } ?><span class="bg">&nbsp;</span></h3>

				<?php while( have_posts() ): the_post(); $counter++;  ?>
				<div class="previous-post fl <?php if( $counter == 3 ){ echo 'last'; } ?>">

					<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

					<?php the_excerpt(); ?>
					<a class="more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'Continue Reading', 'woothemes' ); ?></a>

				</div>

				<?php endwhile; ?>

				<div class="fix"></div>

			</div><!-- /#previous-posts -->
			<?php endif; ?>
			<?php } ?>

			<?php if( $flickr == 'true' ) { ?>

			<div id="flickr-main" <?php if( $older == "false" ){ echo 'class="no-older"'; }?>>

				<h3><?php if( $flickr_heading ) { echo $flickr_heading; } else { ?><?php _e( 'Flickr', 'woothemes' ); ?><?php } ?><span class="bg">&nbsp;</span></h3>

				<div class="flickr-thumbs fl">

					<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=7&amp;display=latest&amp;&amp;layout=x&amp;source=user&amp;user=<?php echo $flickrID; ?>&amp;size=s"></script>

				</div><!-- /.flickr-thumbs -->

			</div><!-- /#flickr-main -->

			<?php } ?>

		</div>

	</div><!-- /#footer-secondary -->

	<?php } ?>

	<?php if ( woo_active_sidebar( 'footer-1' ) ||
	woo_active_sidebar( 'footer-2' ) ||
	woo_active_sidebar( 'footer-3' ) ||
	woo_active_sidebar( 'footer-4' ) ) : ?>
	<div id="footer-widgets">

		<div class="col-full">

			<div class="block">
        		<?php woo_sidebar( 'footer-1' ); ?>
			</div>
			<div class="block">
        		<?php woo_sidebar( 'footer-2' ); ?>
			</div>
			<div class="block">
        		<?php woo_sidebar( 'footer-3' ); ?>
			</div>
			<div class="block last">
        		<?php woo_sidebar( 'footer-4' ); ?>
			</div>
			<div class="fix"></div>

		</div>

	</div><!-- /#footer-widgets  -->
    <?php endif; ?>

	<div id="footer">

		<div class="footer-inside">

			<div id="copyright" class="col-left">
			<?php if( isset( $woo_options['woo_footer_left'] ) && $woo_options['woo_footer_left'] == 'true' ) {

	echo stripslashes( $woo_options['woo_footer_left_text'] );

} else { ?>
				<p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo(); ?>. <?php _e( 'All Rights Reserved.', 'woothemes' ); ?></p>
			<?php } ?>
			</div>

			<div id="credit" class="col-right">
        	<?php if( isset( $woo_options['woo_footer_right'] ) && $woo_options['woo_footer_right'] == 'true' ) {

	echo stripslashes( $woo_options['woo_footer_right_text'] );

} else { ?>
				<p><?php _e( 'Powered by', 'woothemes' ); ?> <a href="http://www.wordpress.org">WordPress</a>. <?php _e( 'Designed by', 'woothemes' ); ?> <a href="<?php $aff = $woo_options['woo_footer_aff_link']; if( !empty( $aff ) ) { echo $aff; } else { echo 'http://www.woothemes.com'; } ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/woothemes.png" width="74" height="19" alt="Woo Themes" /></a></p>
			<?php } ?>
			</div>

			<div class="fix"></div>

		</div>

	</div><!-- /#footer  -->

</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>
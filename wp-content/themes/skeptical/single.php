<?php get_header(); ?>
<?php global $woo_options; ?>
<?php $sidebar = $woo_options['woo_sidebar']; ?>

    <div id="content" class="col-full">
		<div id="main" <?php if( $sidebar  == "true" ) { ?> class="col-left" <?php }?>>

			<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb( '<div id="breadcrumb"><p>', '</p></div>' ); } ?>

            <?php if ( have_posts() ) : $count = 0; ?>
            <?php while ( have_posts() ) : the_post(); $count++; ?>

            	<div <?php post_class( 'post' ); ?>>

            		<div class="post-meta col-left">

            			<?php woo_post_meta(); ?>

            		</div><!-- /.meta -->

            		<div class="middle col-left">

            	    	<h1 class="title"><?php the_title(); ?></h1>

            	    	<?php if ( isset( $woo_options['woo_thumb_single'] ) && $woo_options['woo_thumb_single'] == 'true' ) woo_image( 'width=519&height=' . $woo_options['woo_single_h'] . '&class=thumbnail main-image ' . $woo_options['woo_thumb_single_align'] ); ?>

            	    	<div class="entry">
            	    	    <?php the_content(); ?>
            	    	</div>

						<?php the_tags( '<p class="tags">'.__( 'Tags: ', 'woothemes' ), ', ', '</p>' ); ?>

            	    </div><!-- /.middle -->

            	    <?php if( $sidebar == "false" ) { ?>

            	    	<div class="related col-left">

            	    		<h3><?php _e( 'More from this category', 'woothemes' ); ?></h3>
                		<?php
	$cats = strip_tags( get_the_category_list( ',' ) );
	$cats = explode( ',', $cats );

	if( !empty( $cats ) ){
		$cat_ids = array();
		foreach ( $cats as $cat ) {
			$term_data = get_term_by( 'name', $cat, 'category' );
			$cat_ids[] = $term_data->term_id;
		}
	}
	//print_r($cat_ids);
	$cats = implode( ',', $cat_ids );

	$more_posts = query_posts( array(
			'posts_per_page' => $woo_options['woo_more_from_count'],
			'post__not_in' => array( get_the_id() ),
			'category__and' => $cat_ids )
	);

	if ( have_posts() ) :?>
                		<ul><li>
                			<?php
		while ( have_posts() ) : the_post(); $count++; ?>
                			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                					<span class="related-title"><?php the_title(); ?></span>
                					<span><?php the_time( get_option( 'date_format' ) ); ?></span>
                			</a>
                			<?php
	endwhile;
?>
                		</li></ul>
                		<?php
	endif;
	wp_reset_query();
?>

            	    	</div><!-- /.related -->

            	    <?php } ?>

            	    <div class="fix"></div>

            	</div><!-- /.post -->

                <?php woo_postnav(); ?>

                <?php $comm = $woo_options['woo_comments']; if ( ( $comm == "post" || $comm == "both" ) ) : ?>
	                <?php comments_template( '', true ); ?>
                <?php endif; ?>

			<?php endwhile; else: ?>
				<div class="post not-found">
            	    <h2 class="title"><?php _e( 'Error 404 - Page not found!', 'woothemes' ); ?></h2>
            	    <p><?php _e( 'The page you trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'woothemes' ); ?></p>
            	</div><!-- /.post -->
           	<?php endif; ?>

		</div><!-- /#main -->

        <?php if( $sidebar == "true" ) { get_sidebar(); } ?>

    </div><!-- /#content -->

<?php get_footer(); ?>
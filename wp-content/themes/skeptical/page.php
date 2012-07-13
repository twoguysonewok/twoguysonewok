<?php get_header(); ?>
<?php global $woo_options; ?>

    <div id="content" class="page col-full">
		<div id="main" class="col-left">

			<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb( '<div id="breadcrumb"><p>', '</p></div>' ); } ?>

            <?php if ( have_posts() ) : $count = 0; ?>
            <?php while ( have_posts() ) : the_post(); $count++; ?>

                <div <?php post_class( 'post page' ); ?>>

           		    	<h2 class="title"><?php the_title(); ?></h2>

           		    	<div class="entry">
           		    	    <?php the_content(); ?>
           		    	</div>

           		</div><!-- /.post -->

                <?php $comm = $woo_options['woo_comments']; if ( ( $comm == "page" || $comm == "both" ) ) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>

			<?php endwhile; else: ?>
				<div class="post">
                	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
                </div><!-- /.post -->
            <?php endif; ?>

		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->

<?php get_footer(); ?>
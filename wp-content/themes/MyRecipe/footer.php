    <div class="outer">
	<div id="footer">Copyright &copy; <a href="<?php bloginfo('home'); ?>"><strong><?php bloginfo('name'); ?></strong></a>  - <?php bloginfo('description'); ?> - Powered by <a href="http://wordpress.org/"><strong>WordPress</strong></a></div>
   <?php // This theme is released free for use under creative commons licence. http://creativecommons.org/licenses/by/3.0/
            // All links in the footer should remain intact, or you have to buy it.
            // Warning! Your site may stop working if these links are edited or deleted  ?>
 <div id="info">Designed by <a href="http://themepix.com">Free Wordpress Themes</a> and Sponsored by <a href="http://curryandspice.in/">Curry and Spice</a></div>
</div>
</div>
</div></div></div>
<?php
	 wp_footer();
	echo get_theme_option("footer")  . "\n";
?>
</body>
</html>
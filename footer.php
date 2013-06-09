<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Claydell Media
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
			// action hook for placing backtotop arrow in the footer
			do_action( 'claydellmedia_backtotop' ); 
			?>
			<?php do_action( 'claydellmedia_credits' ); ?>
			<?php _e('Powered by', 'claydellmedia'); ?> <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'claydellmedia' ); ?>" rel="generator"><?php printf( __( 'WordPress', 'claydellmedia' ) ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'claydellmedia' ), 'Claydell Media', '<a href="http://jamiethompson.com/" rel="designer">Jamie Thompson</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>
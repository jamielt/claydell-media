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
	
	<div id="footer-widget" class="secondary">
		<div id="footer-widget-1">
			<?php
				if(is_active_sidebar('footer-sidebar-1')){
				dynamic_sidebar('footer-sidebar-1');
				}
			?>
		</div>
		<div id="footer-widget-2">
			<?php
				if(is_active_sidebar('footer-sidebar-2')){
				dynamic_sidebar('footer-sidebar-2');
				}
			?>
		</div>
		<div id="footer-widget-3">
			<?php
				if(is_active_sidebar('footer-sidebar-3')){
				dynamic_sidebar('footer-sidebar-3');
				}
			?>
		</div>
	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
			// action hook for placing backtotop arrow in the footer
			do_action( 'claydellmedia_backtotop' ); 
			?>
			<?php
			// action hook for placing credits in the footer
			do_action( 'claydellmedia_credits' ); 
			?>
		</div><!-- .site-info -->
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->
<?php wp_footer(); ?>

</body>
</html>
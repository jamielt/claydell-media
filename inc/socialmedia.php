<?php
/**
 * This template generates links to social media icons once set in the theme theme customizer options.  
 *
 * @package claydellmedia
 */
?>

	<ul>
		<?php if ( get_theme_mod( 'rss' ) ) : ?>
			<li><a class="rss-link" href="<?php echo get_feed_link( 'rss2' ); ?>" title="<?php esc_attr_e( 'RSS', 'claydellmedia' ); ?>"><span><?php _e( 'RSS Feed', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'twitter' ) ) : ?>
			<li><a class="twitter-link" href="<?php echo get_theme_mod( 'twitter' ); ?>" title="<?php esc_attr_e( 'Twitter', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'Twitter', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'facebook' ) ) : ?>
			<li><a class="facebook-link" href="<?php echo get_theme_mod( 'facebook' ); ?>" title="<?php esc_attr_e( 'Facebook', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'Facebook', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'googleplus' ) ) : ?>
			<li><a class="googleplus-link" href="<?php echo get_theme_mod( 'googleplus' ); ?>" title="<?php esc_attr_e( 'Google+', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'Google+', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'flickr' ) ) : ?>
			<li><a class="flickr-link" href="<?php echo get_theme_mod( 'flickr' ); ?>" title="<?php esc_attr_e( 'Flickr', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'Flickr', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'linkedin' ) ) : ?>
			<li><a class="linkedin-link" href="<?php echo get_theme_mod( 'linkedin' ); ?>" title="<?php esc_attr_e( 'LinkedIn', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'LinkedIn', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'wordpress' ) ) : ?>
			<li><a class="wordpress-link" href="<?php echo get_theme_mod( 'wordpress' ); ?>" title="<?php esc_attr_e( 'WordPress', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'WordPress', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'pinterest' ) ) : ?>
			<li><a class="pinterest-link" href="<?php echo get_theme_mod( 'pinterest' ); ?>" title="<?php esc_attr_e( 'Printest', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'Printest', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'youtube' ) ) : ?>
			<li><a class="youtube-link" href="<?php echo get_theme_mod( 'youtube' ); ?>" title="<?php esc_attr_e( 'YouTube', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'YouTube', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'vimeo' ) ) : ?>
			<li><a class="vimeo-link" href="<?php echo get_theme_mod( 'vimeo' ); ?>" title="<?php esc_attr_e( 'Vimeo', 'claydellmedia' ); ?>" target="_blank"></a><span><?php _e( 'Vimeo', 'claydellmedia' ); ?></span></li>
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'dribble' ) ) : ?>
			<li><a class="dribbble-link" href="<?php echo get_theme_mod( 'dribble' ); ?>" title="<?php esc_attr_e( 'Dribble', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'Dribble', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>	
		
		<?php if ( get_theme_mod( 'tumblr' ) ) : ?>
			<li><a class="tumblr-link" href="<?php echo get_theme_mod( 'tumblr' ); ?>" title="<?php esc_attr_e( 'Tumblr', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'Tumblr', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'github' ) ) : ?>
			<li><a class="github-link" href="<?php echo get_theme_mod( 'github' ); ?>" title="<?php esc_attr_e( 'GitHub', 'claydellmedia' ); ?>" target="_blank"><span><?php _e( 'GitHub', 'claydellmedia' ); ?></span></a></li>
		<?php endif; ?>		

	</ul><!-- #social-icons-->
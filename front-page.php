<?php
/**
 * Template Name: Front Page
 *
 * @package Claydell Media
 */

global $odd_or_even;

get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

			<div id="featured-rotator">
				<?php $slide_id=1; ?>
					<?php
						$args = array(
						'order' => 'ASC',
						'post_type' => 'page',
						'posts_per_page' => '5',
						'tax_query' => array(
							array(
								'taxonomy' => 'featured',
								'field' => 'slug',
								'terms' => 'featured'
							)
						),
					);
				$featuredPosts = new WP_Query();
				$featuredPosts->query( $args );
				while ($featuredPosts->have_posts()) : $featuredPosts->the_post();
				?>

				<div id="slide-<?php echo $slide_id; $slide_id++;?>">
				<a href="<?php the_permalink() ?>" class="post-image">
				<div class="thumbnail"><?php if ( has_post_thumbnail() ) the_post_thumbnail( 'featured-post-image' ); ?></div>
				<span class="title"><?php echo the_title(); ?><span class="excerpt"><?php the_excerpt(); ?></span></span>
				</a>
				</div>

				<?php endwhile; ?><!--/close loop-->

				<ul class="slide-nav">
					<?php $nav_id=1; ?>
					<?php while ($featuredPosts->have_posts()) : $featuredPosts->the_post(); ?>
						<li>
							<a href="#slide-<?php echo $nav_id; ?>">
								<?php $nav_id++; ?>
							</a>
						</li>
					<?php endwhile; ?><!--/close loop-->
				</ul>
			
				<div class="clear"></div>
			</div><!-- #featured-rotator -->
			
				<div class="clear"></div>

            <div id="featured-block-1" class="featured-block block">  
              <h3><?php _e('Who&rsquo;s Behind', 'claydellmedia'); ?> <?php bloginfo('name') ?><?php _e( '?', 'claydellmedia' ); ?></h3>
              <?php echo get_avatar( get_the_author_meta('user_email'), 80 ); ?>
              <p>My name is Jamie Thompson and I am stationed on the web at <a href="<?php echo get_the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a>. I am working very hard at being an artist, logo designer and freelance web designer. I have been practicing WordPress theme design since 2007.</p>
              <p><a href="<?php echo get_home_url() ?>/authors/" rel="nofollow">Read more at my about page</a></p>
            </div><!-- #featured-block-1 .featured-block .block-->
            
            <div id="featured-block-2" class="featured-block block">
				<h3><?php _e( 'Recent Articles from the&nbsp;', 'claydellmedia' ); ?><?php bloginfo('name'); ?><?php _e( '&nbsp;Blog', 'claydellmedia' ); ?> <a href="<?php echo get_feed_link( 'rss2' ); ?>" class="rss-link" title="<?php esc_attr_e( 'RSS', 'claydellmedia' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social-images/rss-feed-icon-16x16.png" width="16px" height="16px" class="front-rss" alt="RSS"/></a></h3>
              <ul id="recent-items">
              <?php
                  $recentPosts = new WP_Query();
                  $recentPosts->query('showposts=5');
              ?>
              <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                  <li class="post-sprite"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?> <?php the_post_thumbnail('post-sprite'); ?></a></li>
              <?php endwhile; ?>
                    <li class="more-items"><a href="<?php echo get_home_url() ?>/blog/">More recent items &rarr;</a></li>
              </ul>
			  
			  <h3 class="front-meta"><?php _e( 'Meta', 'claydellmedia' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
            </div><!-- #featured-block-2 .featured-block .block-->
			
		<div class="clear"></div>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php
/**
 * Template Name: Blog
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Claydell Media 
 */

get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">
			
			<div id="archive-title">
				<p><?php _e( 'Recent Articles from the&nbsp;', 'claydellmedia' ); ?><?php bloginfo('name'); ?><?php _e( '&nbsp;Blog', 'claydellmedia' ); ?></p>
			</div><!-- #site-intro -->
			
			<section id="blog-articles">
				<?php // begin the loop.
					$args = array(
						'order' => 'DESC',
						'posts_per_page' => 12,
						'tax_query' => array(
							array (
								'taxonomy' => 'post_format',
								'terms' => array( 'post-format-aside', 'post-format-image' ),
								'field' => 'slug',
								'operator' => 'NOT IN',
							),
						),
					);
					$blog_articles = new WP_Query();
					$blog_articles->query( $args );

					while ($blog_articles->have_posts()) : $blog_articles->the_post(); ?>
						<?php
							get_template_part( 'content', 'blog' );
						?>
					<?php endwhile; // end the loop.
				?>
			</section><!-- #blog-articles -->

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php
/**
 * The template for displaying Author Archive pages.
 *
 * Used to display archive-type pages for posts by an author.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Claydell Media 
 */

get_header(); ?>

		<section id="primary" class="site-content">
			<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>

			<header class="archive-header">
				<h1 class="entry-title"><?php printf( __( 'Author Archives: %s', 'claydellmedia' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
			</header><!-- .archive-header -->

			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>

			<?php claydellmedia_content_nav( 'nav-above' ); ?>

			<?php
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="author-info">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'claydellmedia_author_bio_avatar_size', 60 ) ); ?>
						<ul class="icons">
						<li class="post-count">Posts: <?php the_author_posts(); ?></li>
						<?php if (get_the_author_meta('user_email')) { ?>
						<li class="user-email">Author's Email: <a href="mailto:<?php echo get_the_author_meta('user_email'); ?>"><?php the_author_meta('user_email'); ?></a></li>
						<?php } else { get_the_author(); } ?>
						<?php if (get_the_author_meta('user_url')) { ?>
						<li class="user-url">Author's web site: <a href="<?php echo get_the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a></li>
						<?php } else { get_the_author(); } ?>
						<?php if (get_the_author_meta('facebook')) { ?>
						<li class="facebook">Author's Facebook url: <a href="http://facebook.com/<?php echo the_author_meta('facebook'); ?>" target="blank"><?php echo the_author_meta('facebook'); ?></a></li>
						<?php } else { get_the_author(); } ?>
						<?php if (get_the_author_meta('google')) { ?>
						<li class="google">Author's Google url: <a href="http://google.com/<?php echo the_author_meta('google'); ?>" target="blank"><?php echo the_author_meta('google'); ?></a></li>
						<?php } else { get_the_author(); } ?>
						<?php if (get_the_author_meta('linkedin')) { ?>
						<li class="linkedin">Author's Linkedin url: <a href="http://linkedin.com/<?php echo the_author_meta('linkedin'); ?>" target="blank"><?php echo the_author_meta('linkedin'); ?></a></li>
						<?php } else { get_the_author(); } ?>
						<?php if (get_the_author_meta('twitter')) { ?>
						<li class="twitter">Author's Twitter url: <a href="http://twitter.com/<?php echo the_author_meta('twitter'); ?>" target="blank"><?php echo the_author_meta('twitter'); ?></a></li>
						<?php } else { get_the_author(); } ?>
						<?php if (get_the_author_meta('skype')) { ?>
						<li class="skype">Author's Skype url: <a href="http://skype.com/<?php echo the_author_meta('skype'); ?>" target="blank"><?php echo the_author_meta('skype'); ?></a></li>
						<?php } else { get_the_author(); } ?>
						</ul>
					</div><!-- #author-avatar -->
					<div class="author-description">
						<h3 class="author-title">About <?php the_author_link(); ?></h3>
						<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
					</div><!-- #author-description	-->
				</div><!-- #author-info -->
			<?php endif; ?>

			<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'author' );
					?>

				<?php endwhile; ?>

				<?php claydellmedia_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'claydellmedia' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'claydellmedia' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
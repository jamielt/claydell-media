<?php
/**
 * @package Claydell Media
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'claydellmedia' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		
		<div class="thumb">
		<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) the_post_thumbnail(); else { ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/showcase-default.png" class="recent-articles-thumb" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /> 
		<?php } ?>
		</a>
		</div>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php claydellmedia_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_archive() || is_home() || is_page() || is_search() ) : // Display Excerpts for archives, home, pages & search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'claydellmedia' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'claydellmedia' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'claydellmedia' ) );
				if ( $categories_list && claydellmedia_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'claydellmedia' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'claydellmedia' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'claydellmedia' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="sep"> | </span>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'claydellmedia' ), __( '1 Comment', 'claydellmedia' ), __( '% Comments', 'claydellmedia' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'claydellmedia' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

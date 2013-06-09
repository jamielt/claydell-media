<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Claydell Media
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php printf( __( '&nbsp;List %s', 'claydellmedia' ), the_title() ); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
	
		<div id="authorlist">
		<ul>
			<?php // If a user has filled out their description, display an Author List with Avatars.
			claydellmedia_contributors(); ?>
		</ul>
		</div>
		
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'claydellmedia' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'claydellmedia' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

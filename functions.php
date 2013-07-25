<?php
/**
 * Claydell Media functions and definitions
 *
 * @package      Claydell Media
 * @author       Jamie Thompson <jamie@jamiethompson.com>
 * @license      http://http://opensource.org/licenses/gpl-3.0.html
 * GNU General Public License, version 3 (GPL-3.0).
 */

/**
 * Set up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 652; /* Default content width */

/**
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.compat.php' );

/**
 * Adds custom classes to the array of body classes.
 */
function claydellmedia_body_classes( $classes ) {
	$background_image = get_background_image();
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add a class if background image is empty
	if ( empty( $background_image ) )
		$classes[] = 'custom-background-image-empty';

	return $classes;
}
add_filter( 'body_class', 'claydellmedia_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages 
 */
function claydellmedia_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'claydellmedia_enhanced_image_navigation', 10, 2 );

if ( ! function_exists( 'claydellmedia_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails. 
 */
function claydellmedia_setup() {

/**
 * WordPress.com-specific functions and definitions
 */
 
	global $themecolors;
	
/**
 * Set a default theme color array for WP.com.
 *
 * @global array $themecolors 
 */
	$themecolors = array(
		'bg' => 'eeebf2',
		'border' => 'b3b3b3',
		'text' => '3c3d47',
		'link' => '267172',
		'url' => '267172',
	);

	// Dequeue the font script if the blog has WP.com Custom Design.
	function claydellmedia_dequeue_fonts() {
		if ( class_exists( 'TypekitData' ) ) {
			if ( TypekitData::get( 'upgraded' ) ) {
				$customfonts = TypekitData::get( 'families' );

				if ( ! $customfonts )
					return;

				$site_title = $customfonts['site-title'];
				$headings = $customfonts['headings'];

				if ( $site_title['id'] && $headings['id'] ) {
					wp_dequeue_style( 'claydellmedia-droid-serif' );
				}
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'claydellmedia_dequeue_fonts' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Claydell Media, use a find and replace
	 * to change 'claydellmedia' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'claydellmedia', get_template_directory() . '/languages' );

	/**
	 * This theme styles the visual editor with editor-style.css to match the theme style.
	 */ 
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Enable support for posts thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 276, 9999 ); // Unlimited height, soft crop

	// Add image sizes for assorted thumbnails.
	add_image_size( 'featured-post-image', 964, 288, true );
	add_image_size( 'post-sprite', 20, 20, true);

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'claydellmedia' ),
	) );

	/**
	 * This theme allows users to set a custom background.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image','video'  ) );

	add_theme_support( 'print-style' );

	// Add support for custom backgrounds.
	$args = array(
		'default-color' => 'edeaf1f',
		'default-image' => get_template_directory_uri() . '/images/bg.jpg',
	);

	$args = apply_filters( 'claydellmedia_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
endif; // claydellmedia_setup

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function claydellmedia_wp_title( $title, $sep ) { // taken from TwentyTen 1.0

	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $page, $paged;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( 'Search results for %s', '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $sep" . sprintf( 'Page %s', $paged );
		// Add the site name to the end:
		$title .= " $sep " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Add the blog name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'claydellmedia' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'claydellmedia_wp_title', 10, 2 );

/**
 * Filter in a way to make sure empty post title links reach the post.
 */
 add_filter('the_title', 'claydell_title');
	function claydell_title($title) {
	if ($title == '') {
	return 'Untitled';
	} else {
	return $title;
	}
}

add_action( 'after_setup_theme', 'claydellmedia_setup' );

/**
 * Setup the WordPress core custom header feature.
 */
function claydellmedia_custom_header_setup() {
	$args = array(
		// Image and text color (empty to use none).
		'default-image'			=> '',
		'default-text-color'     => 'fff',

		// Set height and width, with a maximum value for the width.
		'height'                 => 242,
		'width'                  => 984,

		// Support flexible height and width.
		'flex-height'            => false,
		'flex-width'             => false,

		// Random image rotation off by default.
		'random-default'         => false,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'claydellmedia_header_style',
		'admin-head-callback'    => 'claydellmedia_admin_header_style',
		'admin-preview-callback' => 'claydellmedia_admin_header_image',
	);

	$args = apply_filters( 'claydellmedia_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	}

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'asian-flower' => array(
			'url' => '%s/images/headers/asian-flower.jpg',
			'thumbnail_url' => '%s/images/headers/asian-flower-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Asian Flower', 'claydellmedia' )
		),
		'azalea' => array(
			'url' => '%s/images/headers/azalea.jpg',
			'thumbnail_url' => '%s/images/headers/azalea-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Azalea', 'claydellmedia' )
		),
		'hosta' => array(
			'url' => '%s/images/headers/hosta.jpg',
			'thumbnail_url' => '%s/images/headers/hosta-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Hosta', 'claydellmedia' )
		),
		'japanese-maple' => array(
			'url' => '%s/images/headers/japanese-maple.jpg',
			'thumbnail_url' => '%s/images/headers/japanese-maple-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Japanese Maple', 'claydellmedia' )
		),
		'crab-orchard-sunset' => array(
			'url' => '%s/images/headers/crab-orchard-sunset.jpg',
			'thumbnail_url' => '%s/images/headers/crab-orchard-sunset-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Crab Orchard Lake Sunset', 'claydellmedia' )
		)
	) );
}
add_action( 'after_setup_theme', 'claydellmedia_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'claydellmedia_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see claydellmedia_custom_header_setup().
 */
function claydellmedia_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // claydellmedia_header_style

if ( ! function_exists( 'claydellmedia_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see claydellmedia_custom_header_setup().
 */
function claydellmedia_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
		max-width: 984px;
	}
	#headimg h1,
	#desc {
		font-family: 'Droid Serif', serif;
	}
	#headimg h1 {
		float: left;
		font-size: 44px;
		font-weight: normal;
		line-height: 52px;
		margin: 0;
		max-width: 652px;
		padding: 0 0 10px;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#desc {
		border-color: #545454;
		border-top: 1px dotted #545454;
		clear: both;
		float: none;
		font-size: 12px;
		font-style: normal;
		line-height: 22px;
		margin: 0;
		max-width: 100%;
		padding: 0;
		text-align: center;
	}
	#headimg img {
		clear: both;
		height: auto;
		margin: 33px 0 0 0;
		max-width: 984px;
		width: 100%;
	}
	</style>
<?php
}
endif; // claydellmedia_admin_header_style

if ( ! function_exists( 'claydellmedia_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see claydellmedia_custom_header_setup().
 */
function claydellmedia_admin_header_image() {
	$style        = sprintf( ' style="color:#%s;"', get_header_textcolor() );
	$header_image = get_header_image();
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php
}
endif; // claydellmedia_admin_header_image

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function claydellmedia_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'claydellmedia_excerpt_length' );

if ( ! function_exists( 'claydellmedia_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 */
function claydellmedia_continue_reading_link() {
	return ' <p><a class="more-link" href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading this article... ', 'claydellmedia' ) . '</a></p>';
}
endif; // claydellmedia_continue_reading_link

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and claydellmedia_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function claydellmedia_auto_excerpt_more( $more ) {
	return ' &hellip;' . claydellmedia_continue_reading_link();
}
add_filter( 'excerpt_more', 'claydellmedia_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function claydellmedia_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= claydellmedia_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'claydellmedia_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link. 
 */
function claydellmedia_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'claydellmedia_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets 
 */
function claydellmedia_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'claydellmedia' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'claydellmedia' ),
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'claydellmedia' ),
		'id' => 'footer-sidebar-2',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'claydellmedia' ),
		'id' => 'footer-sidebar-3',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'claydellmedia_widgets_init' );

if ( ! function_exists( 'claydellmedia_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 */
function claydellmedia_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'claydellmedia' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'claydellmedia' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'claydellmedia' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'claydellmedia' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'claydellmedia' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // claydellmedia_content_nav

if ( ! function_exists( 'claydellmedia_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function claydellmedia_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'claydellmedia' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'claydellmedia' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 45 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'claydellmedia' ), sprintf( '%s', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'claydellmedia' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'claydellmedia' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'claydellmedia' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for claydellmedia_comment()

if ( ! function_exists( 'claydellmedia_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function claydellmedia_posted_on() {
		printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'claydellmedia' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'claydellmedia' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function claydellmedia_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so claydellmedia_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so claydellmedia_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in claydellmedia_categorized_blog
 */
function claydellmedia_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'claydellmedia_category_transient_flusher' );
add_action( 'save_post', 'claydellmedia_category_transient_flusher' );

/**
 * Enqueue scripts
 */
function claydellmedia_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	
	wp_enqueue_style( 'claydellmedia-ie-style', get_template_directory_uri() . '/css/ie.css' );
	
	wp_enqueue_style( 'claydellmedia-printer-style', get_template_directory_uri() . '/print.css' );
	wp_enqueue_script( 'claydellmedia-small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120305', true );

	wp_enqueue_script( 'claydellmedia-scroll-to-top', get_template_directory_uri() . '/js/scroll-to-top.js', array('jquery'), '20130111', true );
}
add_action( 'wp_enqueue_scripts', 'claydellmedia_scripts' );

/**
 * Register Google Fonts style.
 */
if ( !function_exists( 'claydellmedia_google_fonts' ) ) {
	function claydellmedia_google_fonts() {
		if ( !is_admin() ) {
			wp_register_style( 'claydellmedia_droid_serif', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic', '', null, 'screen' );
			wp_register_style( 'claydellmedia_open_sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600italic,700,700italic,800,800italic', '', null, 'screen' );
			wp_register_style( 'claydellmedia_rokkitt', 'http://fonts.googleapis.com/css?family=Rokkitt:400,700', '', null, 'screen' );
			wp_enqueue_style( 'claydellmedia_droid_serif' );
			wp_enqueue_style( 'claydellmedia_open_sans' );
			wp_enqueue_style( 'claydellmedia_rokkitt' );
		}
	}
}

add_action( 'init', 'claydellmedia_google_fonts', 10 );

// COMPAT: Pre-3.4 Background style for front-end.
function claydellmedia_custom_background() {
	if ( '' != get_background_color() && '' == get_background_image() ) : ?>
	<style type="text/css">
		body {
			background: none;
		}
	</style>
	<?php endif;

	if ( '' != get_background_image() ) : ?>
	<style type="text/css">
		#page {
			background: url(<?php echo get_template_directory_uri(); ?>/images/bg.jpg) repeat 0 0;
		}
	</style>
	<?php endif;
}

/**
 * Creates a back to top link
 */
function claydellmedia_wp_head() { ?>
	<a name="PageTop"></a>
<?php }
 
add_action('wp_head', 'claydellmedia_wp_head');

/**
 * Display the Footer stuff.
 */

	// Create a back to top link in the footer.
	function claydellmedia_footer_backtotop() { ?>
	<!-- Begin Backtotop -->
	<div class="backtotop"><a href="<?php echo esc_url( __( '#PageTop', 'claydellmedia' ) ); ?>" title="<?php esc_attr_e( 'Back to top of page', 'claydellmedia' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_top.png" width="48px" height="48px" alt="Back to Top" /></a></div>
	<!-- End Backtotop -->
	<?php }
 
	add_action('claydellmedia_backtotop', 'claydellmedia_footer_backtotop');

	// Add Copyright and Credits to the footer.
	function claydellmedia_credits() { ?>
		<div class="credits">
			<!-- begin copyright -->
			<?php echo '&copy' . " " . date('Y') . " " . esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
				<?php printf( __( '%1$s by %2$s', 'claydell-media' ), ' &middot; Powered', '<a href="http://http://wordpress.org/" rel="generator">WordPress</a>' );
				printf( __( '%1$s  &middot; Theme %2$s', 'claydell-media' ), '', '<a href="http://jamiethompson.com/themes/claydell-media/" rel="designer">Claydell Media</a>.' ); ?>
		</div><!-- .credits -->
	<?php }
 
	add_action('claydellmedia_credits', 'claydellmedia_credits');
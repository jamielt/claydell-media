<?php
/**
 * Compatibility settings and functions for Jetpack from Automattic
 * See http://jetpack.me/support/infinite-scroll/
 *
 * @package Claydell Media
 */

/**
 * Add support for Infinite Scroll.
 */
function claydellmedia_infinite_scroll_init() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'content',
		'footer'         => 'primary',
	) );
}
add_action( 'after_setup_theme', 'claydellmedia_infinite_scroll_init' );
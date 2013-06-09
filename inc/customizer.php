<?php
/**
 * Claydell Media Theme Customizer
 *
 * @package Claydell Media
 * @link http://ottopress.com/tag/customizer/
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function claydellmedia_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'claydellmedia_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function claydellmedia_customize_preview_js() {
	wp_enqueue_script( 'claydellmedia_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130304', true );
}
add_action( 'customize_preview_init', 'claydellmedia_customize_preview_js' );

/**
 * Add the Customize link to the admin menu
 */
add_action ('admin_menu', 'claydellmedia_admin');
function claydellmedia_admin() {
    add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
}

/**
 * Add a Logo for the theme customizer
 */
 function claydellmedia_theme_customizer( $wp_customize ) {
    // Logo upload
    $wp_customize->add_section( 'claydellmedia_logo_section' , array(
    'title'       => __( 'Logo', 'claydellmedia' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
) );

	$wp_customize->add_setting( 'claydellmedia_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'claydellmedia_logo', array(
    'label'    => __( 'Logo', 'claydellmedia' ),
    'section'  => 'claydellmedia_logo_section',
    'settings' => 'claydellmedia_logo',
) ) );
}
add_action('customize_register', 'claydellmedia_theme_customizer');


// add settings to create various social media text areas.

add_action('customize_register', 'claydellmedia_customize');
function claydellmedia_customize($wp_customize) {

	$wp_customize->add_section( 'claydellmedia_socialmedia_settings', array(
		'title'          => 'Social Media Settings',
		'priority'       => 35,
	) );
	
	$wp_customize->add_setting( 'rss', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'rss', array(
		'label'   => __( 'RSS url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'twitter', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'twitter', array(
		'label'   => __( 'Twitter url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'facebook', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'facebook', array(
		'label'   => __( 'Facebook url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'googleplus', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'googleplus', array(
		'label'   => __( 'Google + url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'flickr', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'flickr', array(
		'label'   => __( 'Flickr url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'linkedin', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'linkedin', array(
		'label'   => __( 'LinkedIn url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'wordpress', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'wordpress', array(
		'label'   => __( 'WordPress url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'pinterest', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'pinterest', array(
		'label'   => __( 'Pinterest url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'youtube', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'youtube', array(
		'label'   => __( 'YouTube url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'vimeo', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'vimeo', array(
		'label'   => __( 'Vimeo url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'dribble', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'dribble', array(
		'label'   => __( 'Dribble url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'tumblr', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'tumblr', array(
		'label'   => __( 'Tumblr url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'github', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'github', array(
		'label'   => __( 'Github url:', 'claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	
}

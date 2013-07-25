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
	
    // Logo upload
    $wp_customize->add_section( 'claydellmedia_logo_section' , array(
    'title'       => __( 'Logo', 'Claydellmedia' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
) );

	$wp_customize->add_setting( 'claydellmedia_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'claydellmedia_logo', array(
    'label'    => __( 'Logo', 'Claydellmedia' ),
    'section'  => 'claydellmedia_logo_section',
    'settings' => 'claydellmedia_logo',
) ) );

	// add settings to create various social media text areas.
	$wp_customize->add_section( 'claydellmedia_socialmedia_settings', array(
		'title'          => 'Social Media Settings',
		'priority'       => 35,
	) );
	
	$wp_customize->add_setting( 'rss', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'rss', array(
		'label'   => __( 'RSS url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'twitter', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'twitter', array(
		'label'   => __( 'Twitter url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'facebook', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'facebook', array(
		'label'   => __( 'Facebook url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'googleplus', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'googleplus', array(
		'label'   => __( 'Google + url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'flickr', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'flickr', array(
		'label'   => __( 'Flickr url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'linkedin', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'linkedin', array(
		'label'   => __( 'LinkedIn url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'wordpress', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'wordpress', array(
		'label'   => __( 'WordPress url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'pinterest', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'pinterest', array(
		'label'   => __( 'Pinterest url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'youtube', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'youtube', array(
		'label'   => __( 'YouTube url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'vimeo', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'vimeo', array(
		'label'   => __( 'Vimeo url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'dribble', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'dribble', array(
		'label'   => __( 'Dribble url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'tumblr', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'tumblr', array(
		'label'   => __( 'Tumblr url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'github', array(
		'default'        => '',
	) );

	$wp_customize->add_control( 'github', array(
		'label'   => __( 'Github url:', 'Claydellmedia' ),
		'section' => 'claydellmedia_socialmedia_settings',
		'type'    => 'text',
	) );
}
add_action( 'customize_register', 'claydellmedia_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function claydellmedia_customize_preview_js() {
	wp_enqueue_script( 'claydellmedia_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130304', true );
}
add_action( 'customize_preview_init', 'claydellmedia_customize_preview_js' );

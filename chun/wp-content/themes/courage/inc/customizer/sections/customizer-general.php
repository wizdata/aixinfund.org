<?php
/**
 * Register General section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'courage_customize_register_general_settings' );

function courage_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options
	$wp_customize->add_section( 'courage_section_general', array(
        'title'    => esc_html__( 'General Settings', 'courage' ),
        'priority' => 10,
		'panel' => 'courage_options_panel'
		)
	);

	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'courage_theme_options[design]', array(
        'default'           => 'rounded',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'courage_sanitize_design'
		)
	);
    $wp_customize->add_control( 'courage_control_design', array(
        'label'    => esc_html__( 'Theme Design', 'courage' ),
        'section'  => 'courage_section_general',
        'settings' => 'courage_theme_options[design]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'rounded' => esc_html__( 'Rounded (Default)', 'courage' ),
            'boxed' => esc_html__( 'Boxed Layout', 'courage' )
			)
		)
	);

	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'courage_theme_options[layout]', array(
        'default'           => 'right-sidebar',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'courage_sanitize_layout'
		)
	);
    $wp_customize->add_control( 'courage_control_layout', array(
        'label'    => esc_html__( 'Theme Layout', 'courage' ),
        'section'  => 'courage_section_general',
        'settings' => 'courage_theme_options[layout]',
        'type'     => 'radio',
		'priority' => 2,
        'choices'  => array(
            'left-sidebar' => esc_html__( 'Left Sidebar', 'courage' ),
            'right-sidebar' => esc_html__( 'Right Sidebar', 'courage' )
			)
		)
	);

}

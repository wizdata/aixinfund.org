<?php
/**
 * Add new fields to customizer and register postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Jehanne 1.0
 */

function jehanne_customize_register( $wp_customize ) {

	$defaults = jehanne_get_defaults();
	
	global $jehanne_options;
	
$wp_customize->add_section( 'jehanne_sticky', array(
	'title'          => __( 'Sticky Settings', 'jehanne' ),
	'description'          => __( 'You can choose to make some elements sticky (set fixed position for it)', 'jehanne' ),
	'priority'       => 1,
) );

$wp_customize->add_setting( 'sticky_top_menu', array(
	'default'        => $defaults['sticky_top_menu'],
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'jehanne_sanitize_checkbox'
) );

$wp_customize->add_control( 'sticky_top_menu', array(
	'label'      => __( 'Sticky Second Top Menu', 'jehanne' ),
	'section'    => 'jehanne_sticky',
	'settings'   => 'sticky_top_menu',
	'type'       => 'checkbox'
) );

$wp_customize->add_setting( 'sticky_header', array(
	'default'        => $defaults['sticky_header'],
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'jehanne_sanitize_checkbox'
) );

$wp_customize->add_control( 'sticky_header', array(
	'label'      => __( 'Sticky Header', 'jehanne' ),
	'section'    => 'jehanne_sticky',
	'settings'   => 'sticky_header',
	'type'       => 'checkbox'
) );

$wp_customize->add_section( 'jehanne_widgets', array(
	'title'          => __( 'Demo Widgets', 'jehanne' ),
	'description'          => __( 'You can choose to display or hide Demo Widgets', 'jehanne' ),
	'priority'       => 111,
) );

$wp_customize->add_setting( 'is_show_widgets', array(
	'default'        => $defaults['is_show_widgets'],
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'jehanne_sanitize_checkbox'
) );

$wp_customize->add_control( 'is_show_widgets', array(
	'label'      => __( 'Display Demo Widgets in the Second Footer Sidebar', 'jehanne' ),
	'section'    => 'jehanne_widgets',
	'settings'   => 'is_show_widgets',
	'type'       => 'checkbox'
) );

	
//New section in the customizer: Featured Image
$wp_customize->add_section( 'jehanne_post_thumbnail', array(
	'title'          => __( 'Featured Image', 'jehanne' ),
	'description'          => __( 'Location of the Featured Image', 'jehanne' ),
	'priority'       => 71,
) );

//New setting in the Featured Image section: Type
$wp_customize->add_setting( 'thumbnail_class', array(
	'default'        => $defaults['thumbnail_class'],
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'jehanne_sanitize_post_thumbnail'
) );

$wp_customize->add_control( 'thumbnail_class', array(
	'label'      => __( 'Type', 'jehanne' ),
	'section'    => 'jehanne_post_thumbnail',
	'settings'   => 'thumbnail_class',
	'type'       => 'select',
	'priority'   => 1,
	'choices'	 => array ('small' => __('Small', 'jehanne'), 'right' => __('Right', 'jehanne'), 'left' => __('Left', 'jehanne'))
) );
	
//New section in the customizer: Color Scheme
	$wp_customize->add_section( 'jehanne_color_scheme', array(
		'title'          => __( 'Color Scheme ', 'jehanne' ),
		'description'    => __( 'This option refresh theme colors.', 'jehanne' ),
		'priority'       => 31,
	) );
	
	
//New section in the customizer: Front Page Style
$wp_customize->add_section( 'jehanne_front', array(
	'title'          => __( 'Front Page Style', 'jehanne' ),
	'priority'       => 71,
) );

//New setting in the Featured Image section: Type
$wp_customize->add_setting( 'front_style', array(
	'default'        => $defaults['front_style'],
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'jehanne_sanitize_front_style'
) );

$wp_customize->add_control( 'front_style', array(
	'label'      => __( 'Type', 'jehanne' ),
	'section'    => 'jehanne_front',
	'settings'   => 'front_style',
	'type'       => 'select',
	'priority'   => 1,
	'choices'	 => array ('default' => __('Default', 'jehanne'), 'shadow_1' => __('Shadow 1', 'jehanne'), 'shadow_2' => __('Shadow 2', 'jehanne'))
) );
	
//New section in the customizer: Color Scheme
	$wp_customize->add_section( 'jehanne_color_scheme', array(
		'title'          => __( 'Color Scheme ', 'jehanne' ),
		'description'    => __( 'This option refresh theme colors.', 'jehanne' ),
		'priority'       => 31,
	) );
	
//New setting in Color Scheme section: Type
	$wp_customize->add_setting( 'color_scheme', array(
		'default'        => $defaults['color_scheme'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'refresh',
		'sanitize_callback' => 'jehanne_sanitize_color_scheme'
	) );
	
	
	$wp_customize->add_control( 'color_scheme', array(
		'label'      => __( 'Color Scheme', 'jehanne' ),
		'section'    => 'jehanne_color_scheme',
		'settings'   => 'color_scheme',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array ('light' => __('Light', 'jehanne'), 'dark' => __('Dark', 'jehanne'))
	) );
	
//New setting in Color Scheme section: Skin
	$wp_customize->add_setting( 'color_skin', array(
		'default'        => $defaults['color_skin'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'jehanne_sanitize_color_skin'
	) );
	
	$wp_customize->add_control( 'color_skin', array(
		'label'      => __( 'Color Skin', 'jehanne' ),
		'section'    => 'jehanne_color_scheme',
		'settings'   => 'color_skin',
		'type'       => 'select',
		'priority'   => 2,
		'choices'	 => array ('blue' => __('Blue', 'jehanne'), 'black' => __('Black', 'jehanne'), 'red' => __('Red', 'jehanne'))
	) );
	
//New section in the customizer: Layout
	$wp_customize->add_section( 'jehanne_layout', array(
		'title'          => __( 'Layout', 'jehanne' ),
		'priority'       => 30,
	) );
	
//New setting in Layout section: Style
	$wp_customize->add_setting( 'layout', array(
		'default'        => $defaults['layout'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_layout'
	) );
	$wp_customize->add_control( 'layout', array(
		'label'      => __('Style', 'jehanne'),
		'section'    => 'jehanne_layout',
		'settings'   => 'layout',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array ('boxed' => __('Boxed', 'jehanne') , 'full_screen' => __('Full Screen', 'jehanne'))
	) );
	
//New setting in Layout section: max width
	$wp_customize->add_setting( 'max_width', array(
		'default'        => $defaults['max_width'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'jehanne_sanitize_max_width'
	) );
	$wp_customize->add_control( 'max_width', array(
		'label'      => __('Max Width (number between [960:1349])', 'jehanne'),
		'section'    => 'jehanne_layout',
		'settings'   => 'max_width',
		'type'       => 'text',
		'priority'   => 2,
	) );
	
//New setting in Layout section: margin top
	$wp_customize->add_setting( 'margin_top', array(
		'transport'		 => 'postMessage',
		'default'        => $defaults['margin_top'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_margin'
	) );
	$wp_customize->add_control( 'margin_top', array(
		'label'      => __('Margin Top', 'jehanne'),
		'section'    => 'jehanne_layout',
		'settings'   => 'margin_top',
		'type'       => 'text',
		'priority'   => 3,
	) );
	
//New setting in Layout section: margin bottom
	$wp_customize->add_setting( 'margin_bottom', array(
		'transport'		 => 'postMessage',
		'default'        => $defaults['margin_bottom'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_margin'
	) );
	$wp_customize->add_control('margin_bottom', array(
		'label'      => __('Margin Bottom', 'jehanne'),
		'section'    => 'jehanne_layout',
		'settings'   => 'margin_bottom',
		'type'       => 'text',
		'priority'   => 4,
	) );
	
//New section in the customizer: Logotype
	$wp_customize->add_section( 'jehanne_theme_logotype', array(
		'title'          => __( 'Logotype', 'jehanne' ),
		'priority'       => 10,
	) );
	
//New setting in Logotype section: Logo Image
	$wp_customize->add_setting( 'logotype_url', array(
		'default'        => $defaults['logotype_url'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_url'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'logotype_url', array(
		'label'      => __('Logotype', 'jehanne'),
		'section'    => 'jehanne_theme_logotype',
		'settings'   => 'logotype_url',
		'priority'   => '1',
	) ) );
	
//New setting in Navigation section: Switch On Primary Menu
	$wp_customize->add_setting( 'is_show_primary_menu', array(
		'default'        => $defaults['is_show_primary_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_show_primary_menu', array(
		'label'      => __( 'Switch On Primary Menu', 'jehanne' ),
		'section'    => 'nav',
		'settings'   => 'is_show_primary_menu',
		'type'       => 'checkbox',
		'priority'       => 20,
	) );
//New setting in Navigation section: Switch On First Top Menu
	$wp_customize->add_setting( 'is_show_top_menu', array(
		'default'        => $defaults['is_show_top_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_show_top_menu', array(
		'label'      => __( 'Switch On First Top Menu', 'jehanne' ),
		'section'    => 'nav',
		'settings'   => 'is_show_top_menu',
		'type'       => 'checkbox',
		'priority'       => 21,
	) );
	
//New setting in Navigation section: Switch On Second Top Menu
	$wp_customize->add_setting( 'is_show_second_top_menu', array(
		'default'        => $defaults['is_show_second_top_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_show_second_top_menu', array(
		'label'      => __( 'Switch On Second Top Menu', 'jehanne' ),
		'section'    => 'nav',
		'settings'   => 'is_show_second_top_menu',
		'type'       => 'checkbox',
		'priority'       => 22,
	) );
	
//New setting in Navigation section: Switch On Footer Menu
	$wp_customize->add_setting( 'is_show_footer_menu', array(
		'default'        => $defaults['is_show_footer_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_show_footer_menu', array(
		'label'      => __( 'Switch On Footer Menu', 'jehanne' ),
		'section'    => 'nav',
		'settings'   => 'is_show_footer_menu',
		'type'       => 'checkbox',
		'priority'       => 23,
	) );

// Add more color settings 
	$wp_customize->add_setting( 'main_rgba_color', array(
		'default'        => $defaults['main_rgba_color'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_rgba_color', array(
		'label'   => __( 'First RGB color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'main_rgba_color',
		'priority'   => '2'
	) ) );
	
	
//Gradient type
	$wp_customize->add_setting( 'rgba', array(
		'default'        => $defaults['rgba'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_gradient_type'
	) );
	$wp_customize->add_control( 'rgba', array(
		'label'      => __('Gradient Style', 'jehanne'),
		'section'    => 'colors',
		'settings'   => 'rgba',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array ('linear' => __('Linear Gradient', 'jehanne') , '0' => __('None', 'jehanne'))
	) );
	
//Gradient opacity
	$wp_customize->add_setting( 'opacity', array(
		'default'        => $defaults['opacity'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_opacity'
	) );
	$wp_customize->add_control( 'opacity', array(
		'label'      => __('The Gradient Opacity', 'jehanne'),
		'section'    => 'colors',
		'settings'   => 'opacity',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array ('0.1' => '0.1', 
							   '0.2' => '0.2', 
							   '0.3' => '0.3', 
							   '0.4' => '0.4', 
							   '0.5' => '0.5',
							   '0.6' => '0.6', 
							   '0.7' => '0.7',
							   '0.8' => '0.8',
							   '0.9' =>  '0.9',
							   '1' => '1')
	) );
	
//link
	$wp_customize->add_setting( 'link', array(
		'default'        => $defaults['link'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link', array(
		'label'   => __( 'Link Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'link',
		'priority'   => '11'
	) ) );
//heading
	$wp_customize->add_setting( 'heading', array(
		'default'        => $defaults['heading'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading', array(
		'label'   => __( 'H1-H6 Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'heading',
		'priority'   => '12'
	) ) );
// First Menu
	$wp_customize->add_setting( 'first_menu_color', array(
		'default'        => $defaults['first_menu_color'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_menu_color', array(
		'label'   => __( 'First Menu Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'first_menu_color',
		'priority'   => '20'
	) ) );
	//link
	$wp_customize->add_setting( 'first_menu_link', array(
		'default'        => $defaults['first_menu_link'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_menu_link', array(
		'label'   => __( 'First Menu Link Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'first_menu_link',
		'priority'   => '21'
	) ) );
	//hover
	$wp_customize->add_setting( 'first_menu_link_hover', array(
		'default'        => $defaults['first_menu_link_hover'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_menu_hover_color', array(
		'label'   => __( 'First Menu Link Hover Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'first_menu_link_hover',
		'priority'   => '22'
	) ) );
	//hover background
	$wp_customize->add_setting( 'first_menu_link_hover_back', array(
		'default'        => $defaults['first_menu_link_hover_back'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_menu_link_hover_back', array(
		'label'   => __( 'First Menu Link Hover Background', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'first_menu_link_hover_back',
		'priority'   => '23'
	) ) );

// Second Menu
	$wp_customize->add_setting( 'second_menu_color', array(
		'default'        => $defaults['second_menu_color'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'second_menu_color', array(
		'label'   => __( 'Second Menu Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'second_menu_color',
		'priority'   => '30'
	) ) );
	//link
	$wp_customize->add_setting( 'second_menu_link', array(
		'default'        => $defaults['second_menu_link'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'second_menu_link', array(
		'label'   => __( 'Second Menu Link Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'second_menu_link',
		'priority'   => '31'
	) ) );
	//hover
	$wp_customize->add_setting( 'second_menu_link_hover', array(
		'default'        => $defaults['second_menu_link_hover'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'second_menu_link_hover', array(
		'label'   => __( 'Second Menu Link Hover Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'second_menu_link_hover',
		'priority'   => '32'
	) ) );
	//hover background
	$wp_customize->add_setting( 'second_menu_link_hover_back', array(
		'default'        => $defaults['second_menu_link_hover_back'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'second_menu_link_hover_back', array(
		'label'   => __( 'Second Menu Link Hover Background', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'second_menu_link_hover_back',
		'priority'   => '33'
	) ) );
	
// Footer Menu
	$wp_customize->add_setting( 'footer_menu_color', array(
		'default'        => $defaults['footer_menu_color'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_menu_color', array(
		'label'   => __( 'Footer Menu Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'footer_menu_color',
		'priority'   => '40'
	) ) );
	//link
	$wp_customize->add_setting( 'footer_menu_link', array(
		'default'        => $defaults['footer_menu_link'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_menu_link', array(
		'label'   => __( 'Footer Menu Link Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'footer_menu_link',
		'priority'   => '41'
	) ) );
	//hover
	$wp_customize->add_setting( 'footer_menu_link_hover', array(
		'default'        => $defaults['footer_menu_link_hover'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_menu_link_hover', array(
		'label'   => __( 'Footer Menu Link Hover Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'footer_menu_link_hover',
		'priority'   => '42'
	) ) );
	//hover background
	$wp_customize->add_setting( 'footer_menu_link_hover_back', array(
		'default'        => $defaults['footer_menu_link_hover_back'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_menu_link_hover_back', array(
		'label'   => __( 'Footer Menu Link Hover Background', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'footer_menu_link_hover_back',
		'priority'   => '43'
	) ) );
	
	//Column widget header color
	$wp_customize->add_setting( 'column_header_color', array(
		'default'        => $defaults['column_header_color'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'column_header_color', array(
		'label'   => __( 'Column Widget Header Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'column_header_color',
		'priority'   => '70'
	) ) );
	
	//Column widget header text color
	$wp_customize->add_setting( 'column_header_text', array(
		'default'        => $defaults['column_header_text'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'column_header_text', array(
		'label'   => __( 'Column Widget Header Text Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'column_header_text',
		'priority'   => '71'
	) ) );
	
//column widget background

	$wp_customize->add_setting( 'widget_back', array(
		'default'        => $defaults['widget_back'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'widget_back', array(
		'label'   => __( 'Column Widget Background Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'widget_back',
		'priority'   => '80'
	) ) );
	
// Column
	$wp_customize->add_setting( 'column_color', array(
		'default'        => $defaults['column_color'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'column_color', array(
		'label'   => __( 'column Sidebar Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'column_color',
		'priority'   => '80'
	) ) );
	//link
	$wp_customize->add_setting( 'column_link', array(
		'default'        => $defaults['column_link'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'column_link', array(
		'label'   => __( 'column Sidebar Link Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'column_link',
		'priority'   => '81'
	) ) );
	//column link hover
	$wp_customize->add_setting( 'column_hover', array(
		'default'        => $defaults['column_hover'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'column_hover', array(
		'label'   => __( 'column Sidebar Link Hover Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'column_hover',
		'priority'   => '82'
	) ) );
	//column text
	$wp_customize->add_setting( 'column_text', array(
		'default'        => $defaults['column_text'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'column_text', array(
		'label'   => __( 'Column Sidebar Text Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'column_text',
		'priority'   => '83'
	) ) );

// Top Sidebar
	$wp_customize->add_setting( 'top_sidebar_color', array(
		'default'        => $defaults['top_sidebar_color'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_sidebar_color', array(
		'label'   => __( 'Top Sidebar Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'top_sidebar_color',
		'priority'   => '50'
	) ) );
	//link
	$wp_customize->add_setting( 'top_sidebar_link', array(
		'default'        => $defaults['top_sidebar_link'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_sidebar_link', array(
		'label'   => __( 'Top Sidebar Link Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'top_sidebar_link',
		'priority'   => '51'
	) ) );
	//top link
	$wp_customize->add_setting( 'top_sidebar_link_hover', array(
		'default'        => $defaults['top_sidebar_link_hover'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_sidebar_link_hover', array(
		'label'   => __( 'Top Sidebar Link Hover Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'top_sidebar_link_hover',
		'priority'   => '52'
	) ) );
	//top text
	$wp_customize->add_setting( 'top_sidebar_text', array(
		'default'        => $defaults['top_sidebar_text'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_sidebar_text', array(
		'label'   => __( 'Top Sidebar Text Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'top_sidebar_text',
		'priority'   => '53'
	) ) );
	
// Footer Sidebar
	$wp_customize->add_setting( 'footer_sidebar_color', array(
		'default'        => $defaults['footer_sidebar_color'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_sidebar_color', array(
		'label'   => __( 'Footer Sidebar Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'footer_sidebar_color',
		'priority'   => '60'
	) ) );
	//link
	$wp_customize->add_setting( 'footer_sidebar_link', array(
		'default'        => $defaults['footer_sidebar_link'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_sidebar_link', array(
		'label'   => __( 'Footer Sidebar Link Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'footer_sidebar_link',
		'priority'   => '61'
	) ) );
	//footer link
	$wp_customize->add_setting( 'footer_sidebar_link_hover', array(
		'default'        => $defaults['footer_sidebar_link_hover'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_sidebar_link_hover', array(
		'label'   => __( 'Footer Sidebar Link Hover Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'footer_sidebar_link_hover',
		'priority'   => '62'
	) ) );
	//footer text
	$wp_customize->add_setting( 'footer_sidebar_text', array(
		'default'        => $defaults['footer_sidebar_text'],
		'transport'		 => 'postMessage',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_sidebar_text', array(
		'label'   => __( 'Footer Sidebar Text Color', 'jehanne' ),
		'section' => 'colors',
		'settings'   => 'footer_sidebar_text',
		'priority'   => '63'
	) ) );
	
//New section in the customizer: Scroll To Top Button
	$wp_customize->add_section( 'jehanne_scroll', array(
		'title'          => __( 'Scroll To Top Button', 'jehanne' ),
		'priority'       => 101,
	) );
	
	$wp_customize->add_setting( 'scroll_button', array(
		'default'        => $defaults['scroll_button'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'refresh',
		'sanitize_callback' => 'jehanne_sanitize_scroll_button'
	) );
	
	
	$wp_customize->add_control( 'scroll_button', array(
		'label'      => __( 'How to display the scroll to top button', 'jehanne' ),
		'section'    => 'jehanne_scroll',
		'settings'   => 'scroll_button',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array ('none' => __('None', 'jehanne'),
								'right' => __('Right', 'jehanne'), 
								'left' => __('Left', 'jehanne'),
								'center' => __('Center', 'jehanne'))
	) );
	
	$wp_customize->add_setting( 'scroll_animate', array(
		'default'        => $defaults['scroll_animate'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_scroll_effect'
	) );
	
	
	$wp_customize->add_control( 'scroll_animate', array(
		'label'      => __( 'How to animate the scroll to top button', 'jehanne' ),
		'section'    => 'jehanne_scroll',
		'settings'   => 'scroll_animate',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array ('none' => __('None', 'jehanne'),
								'move' => __('Jump', 'jehanne')), 
	) );
	
//New section in the customizer: Favicon
	$wp_customize->add_section( 'jehanne_favicon', array(
		'title'          => __( 'Favicon', 'jehanne' ),
		'description'    => __( 'You can select an Icon to be shown at the top of browser window by uploading from your computer. (Size: [16X16] px)', 'jehanne' ),
		'priority'       => 121,
	) );
	
	$wp_customize->add_setting( 'favicon', array(
		'default'        => $defaults['favicon'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_url'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'favicon', array(
		'label'      => __('Favicon', 'jehanne'),
		'section'    => 'jehanne_favicon',
		'settings'   => 'favicon',
		'priority'   => '1',
	) ) );
	
	
//New section in the customizer: Mobile
	$wp_customize->add_section( 'jehanne_mobile', array(
		'title'          => __( 'Mobile', 'jehanne' ),
		'description'    => __( 'Options, used on small devices.', 'jehanne' ),
		'priority'       => 100,
	) );
	
	$wp_customize->add_setting( 'is_responsive', array(
		'default'        => $defaults['is_responsive'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'refresh',
		'sanitize_callback' => 'jehanne_sanitize_0_1'
	) );
	
	$wp_customize->add_control( 'is_responsive', array(
		'label'      => __( 'Responsive', 'jehanne' ),
		'section'    => 'jehanne_mobile',
		'settings'   => 'is_responsive',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array (0 => __('No', 'jehanne'), 1 => __('Yes', 'jehanne'))
	) );
	
	$wp_customize->add_setting( 'min_width', array(
		'default'        => $defaults['min_width'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'refresh',
		'sanitize_callback' => 'jehanne_sanitize_int'
	) );
	
	$wp_customize->add_control( 'min_width', array(
		'label'      => __( 'Min Width', 'jehanne' ),
		'section'    => 'jehanne_mobile',
		'settings'   => 'min_width',
		'type'       => 'text',
		'priority'   => 2,
	) );
	
	
	$wp_customize->add_setting( 'hide_top_1_sidebar', array(
		'default'        => $defaults['hide_top_1_sidebar'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_0_1'
	) );
	
	$wp_customize->add_control( 'hide_top_1_sidebar', array(
		'label'      => __( 'Hide top sidebars', 'jehanne' ),
		'section'    => 'jehanne_mobile',
		'settings'   => 'hide_top_1_sidebar',
		'type'       => 'select',
		'priority'   => 4,
		'choices'	 => array (0 => __('No', 'jehanne'), 1 => __('Yes', 'jehanne'))
	) );
	
	$wp_customize->add_setting( 'hide_1_menu', array(
		'default'        => $defaults['hide_1_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_0_1'
	) );
	
	$wp_customize->add_control( 'hide_1_menu', array(
		'label'      => __( 'Hide first menu', 'jehanne' ),
		'section'    => 'jehanne_mobile',
		'settings'   => 'hide_1_menu',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => array (0 => __('No', 'jehanne'), 1 => __('Yes', 'jehanne'))
	) );	
	
	$wp_customize->add_setting( 'hide_2_menu', array(
		'default'        => $defaults['hide_2_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_0_1'
	) );
	
	$wp_customize->add_control( 'hide_2_menu', array(
		'label'      => __( 'Hide second menu', 'jehanne' ),
		'section'    => 'jehanne_mobile',
		'settings'   => 'hide_2_menu',
		'type'       => 'select',
		'priority'   => 12,
		'choices'	 => array (0 => __('No', 'jehanne'), 1 => __('Yes', 'jehanne'))
	) );	
	
	$wp_customize->add_setting( 'hide_3_menu', array(
		'default'        => $defaults['hide_3_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_0_1'
	) );
	
	$wp_customize->add_control( 'hide_3_menu', array(
		'label'      => __( 'Hide main menu', 'jehanne' ),
		'section'    => 'jehanne_mobile',
		'settings'   => 'hide_3_menu',
		'type'       => 'select',
		'priority'   => 13,
		'choices'	 => array (0 => __('No', 'jehanne'), 1 => __('Yes', 'jehanne'))
	) );	
	
	$wp_customize->add_setting( 'hide_4_menu', array(
		'default'        => $defaults['hide_4_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_0_1'
	) );
	
	$wp_customize->add_control( 'hide_4_menu', array(
		'label'      => __( 'Hide footer menu', 'jehanne' ),
		'section'    => 'jehanne_mobile',
		'settings'   => 'hide_4_menu',
		'type'       => 'select',
		'priority'   => 14,
		'choices'	 => array (0 => __('No', 'jehanne'), 1 => __('Yes', 'jehanne'))
	) );
	
	jehanne_create_social_icons_section( $wp_customize );
	
//Sets postMessage support
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'jehanne_customize_register' );

/**
 * Create icon section in the customizer
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 *
 * @since jehanne 1.0.1
 */

function jehanne_create_social_icons_section( $wp_customize ){
	$icons = jehanne_social_icons();
	$defaults = jehanne_get_defaults();
	
//New section in the customizer: Featured Image
	$wp_customize->add_section( 'jehanne_icons', array(
		'title'          => __( 'Social Media Links', 'jehanne' ),
		'description'          => __( 'Add your Social Media Links', 'jehanne' ),
		'priority'       => 101,
	) );
	
	$wp_customize->add_setting( 'social_buttons_in_the_header', array(
		'default'        => $defaults['social_buttons_in_the_header'],
		'transport'   => 'refresh',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'jehanne_sanitize_checkbox'
	) );
	
	$wp_customize->add_control( 'social_buttons_in_the_header', array(
		'label'      => __( 'Display Icons', 'jehanne' ),
		'section'    => 'jehanne_icons',
		'settings'   => 'social_buttons_in_the_header',
		'type'       => 'checkbox',
		'priority'   => 1,
	) );
	
	$wp_customize->add_setting( 'social_buttons_class', array(
		'default'        => $defaults['social_buttons_class'],
		'capability'     => 'edit_theme_options',
		'transport'   => 'refresh',
		'sanitize_callback' => 'jehanne_sanitize_button_class'
	) );
	
	$wp_customize->add_control( 'social_buttons_class', array(
		'label'      => __( 'Size of Icons', 'jehanne' ),
		'section'    => 'jehanne_icons',
		'settings'   => 'social_buttons_class',
		'type'       => 'select',
		'priority'   => 2,
		'choices'	 => array ('big' => __( 'Big', 'jehanne' ), 'small' => __( 'Small', 'jehanne' ))
	) );
	
	$i = 3;
	
	foreach($icons as $id => $icon ) {
		$wp_customize->add_setting( $id, array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'jehanne_sanitize_url'
		) );
		
		$wp_customize->add_control( 'jehanne_icons_'.$id, array(
			'label'      => strtoupper($id),
			'section'    => 'jehanne_icons',
			'settings'   => $id,
			'type'       => 'text',
			'priority'   => $i++,
		) );	
	}
}
 
 /**
 * Add custom styles to the header.
 *
 * @since jehanne 1.0
*/
function jehanne_hook_css() {
	
	global $jehanne_options;
	$jehanne_options = jehanne_get_options();
?>
	<style type="text/css"> 
		/* Top Menu */

		<?php if( $jehanne_options['rgba'] == '0' ) : ?>
			#top-1-navigation {
				background-color:<?php echo esc_attr($jehanne_options['first_menu_color']); ?>;
			}
		<?php else : ?>
			#top-1-navigation {
				background: -webkit-linear-gradient(<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['first_menu_color'], $jehanne_options['opacity']));?>, 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['main_rgba_color'], 1)); ?>);
				background: -o-linear-gradient(<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['first_menu_color'], $jehanne_options['opacity']));?>, 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['main_rgba_color'], 1)); ?>);
				background: -moz-linear-gradient(<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['first_menu_color'], $jehanne_options['opacity']));?>, 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['main_rgba_color'], 1)); ?>);
				background: linear-gradient(<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['first_menu_color'], $jehanne_options['opacity']));?>, 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['main_rgba_color'], 1)); ?>);
			}
		<?php endif; ?>
		#top-1-navigation .horisontal-navigation li a {
			color: <?php echo esc_attr($jehanne_options['first_menu_link']); ?>;
		}	
		
		#top-1-navigation .horisontal-navigation li ul {
			background-color: <?php echo esc_attr($jehanne_options['first_menu_link_hover_back']); ?>;
		}

		#top-1-navigation .horisontal-navigation li ul li a {
			color: <?php echo esc_attr($jehanne_options['first_menu_link_hover']); ?>;
		}
		#top-1-navigation .horisontal-navigation li a:hover,
		#top-1-navigation .horisontal-navigation li a:focus {
			background: <?php echo esc_attr($jehanne_options['first_menu_link_hover_back']); ?>;
			color: <?php echo esc_attr($jehanne_options['first_menu_link_hover']); ?>;
		}
		#top-1-navigation .horisontal-navigation li ul li a:hover,
		.horisontal-navigation li ul li a:focus {
			background-color: <?php echo esc_attr($jehanne_options['first_menu_link_hover']); ?>;
			color: <?php echo esc_attr($jehanne_options['first_menu_link_hover_back']); ?>;
		}
		#top-1-navigation .horisontal-navigation .current-menu-item > a,
		#top-1-navigation .horisontal-navigation .current-menu-ancestor > a,
		#top-1-navigation .horisontal-navigation .current_page_item > a,
		#top-1-navigation .horisontal-navigation .current_page_ancestor > a {
			background-color: <?php echo esc_attr($jehanne_options['first_menu_link_hover_back']); ?>;
			color: <?php echo esc_attr($jehanne_options['first_menu_link_hover']); ?>;
		}
		#top-1-navigation .horisontal-navigation li ul .current-menu-item > a,
		#top-1-navigation .horisontal-navigation li ul .current-menu-ancestor > a,
		#top-1-navigation .horisontal-navigation li ul .current_page_item > a,
		#top-1-navigation .horisontal-navigation li ul .current_page_ancestor > a {
			background-color: <?php echo esc_attr($jehanne_options['first_menu_link_hover']); ?>;
			color: <?php echo esc_attr($jehanne_options['first_menu_link_hover_back']); ?>;
		}
		
		/* Second Top Menu */
		
		<?php if( $jehanne_options['rgba'] == '0' ) : ?>
			#top-navigation {
				background-color:<?php echo esc_attr($jehanne_options['second_menu_color']); ?>;
			}
		<?php else : ?>
			#top-navigation {
				background: -webkit-linear-gradient(<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['second_menu_color'], $jehanne_options['opacity']));?>, 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['main_rgba_color'], 1)); ?>);
				background: -o-linear-gradient(<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['second_menu_color'], $jehanne_options['opacity']));?>, 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['main_rgba_color'], 1)); ?>);
				background: -moz-linear-gradient(<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['second_menu_color'], $jehanne_options['opacity']));?>, 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['main_rgba_color'], 1)); ?>);
				background: linear-gradient(<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['second_menu_color'], $jehanne_options['opacity']));?>, 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['main_rgba_color'], 1)); ?>);
			}
		<?php endif; ?>
		
		#top-navigation .horisontal-navigation li a {
			color: <?php echo esc_attr($jehanne_options['second_menu_link']); ?>;
		}	
		#top-navigation .horisontal-navigation li ul {
			background-color: <?php echo esc_attr($jehanne_options['second_menu_link_hover_back']); ?>;
		}
		#top-navigation .horisontal-navigation li ul li a {
			color: <?php echo esc_attr($jehanne_options['second_menu_link_hover']); ?>;
		}
		#top-navigation .horisontal-navigation li a:hover,
		#top-navigation .horisontal-navigation li a:focus {
			background: <?php echo esc_attr($jehanne_options['second_menu_link_hover_back']); ?>;
			color: <?php echo esc_attr($jehanne_options['second_menu_link_hover']); ?>;
		}
		#top-navigation .horisontal-navigation li ul li a:hover,
		#top-navigation .horisontal-navigation li ul li a:focus {
			background: <?php echo esc_attr($jehanne_options['second_menu_color']); ?>;
			color: <?php echo esc_attr($jehanne_options['second_menu_link']); ?>;
		}
		#top-navigation .horisontal-navigation .current-menu-item > a,
		#top-navigation .horisontal-navigation .current-menu-ancestor > a,
		#top-navigation .horisontal-navigation .current_page_item > a,
		#top-navigation .horisontal-navigation .current_page_ancestor > a {
			border: 1px solid <?php echo esc_attr($jehanne_options['second_menu_link_hover_back']); ?>;
		}
		#top-navigation .horisontal-navigation li ul .current-menu-item > a,
		#top-navigation .horisontal-navigation li ul .current-menu-ancestor > a,
		#top-navigation .horisontal-navigation li ul .current_page_item > a,
		#top-navigation .horisontal-navigation li ul .current_page_ancestor > a {
			background-color: <?php echo esc_attr($jehanne_options['second_menu_color']); ?>;
			color: <?php echo esc_attr($jehanne_options['second_menu_link']); ?>;
		}	
		
		/* Footer Top Menu */
		
		<?php if( $jehanne_options['rgba'] == '0' ) : ?>
			#footer-navigation {
				background-color:<?php echo esc_attr($jehanne_options['footer_menu_color']); ?>;
			}
		<?php else : ?>
			#footer-navigation {
				background: -webkit-linear-gradient(rgba(0,0,0,0), 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['footer_menu_color'], $jehanne_options['opacity'])); ?>);
				background: -o-linear-gradient(rgba(0,0,0,0), 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['footer_menu_color'], $jehanne_options['opacity'])); ?>);
				background: -moz-linear-gradient(rgba(0,0,0,0), 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['footer_menu_color'], $jehanne_options['opacity'])); ?>);
				background: linear-gradient(rgba(0,0,0,0), 
				<?php echo esc_attr(jehanne_hex_to_rgba( $jehanne_options['footer_menu_color'], $jehanne_options['opacity'])); ?>);
			}
		<?php endif; ?>
		#footer-navigation .horisontal-navigation li a {
			color: <?php echo esc_attr($jehanne_options['footer_menu_link']); ?>;
		}	
		#footer-navigation .horisontal-navigation li ul {
			background-color: <?php echo esc_attr($jehanne_options['footer_menu_link_hover_back']); ?>;
		}
		#footer-navigation .horisontal-navigation li ul li a {
			color: <?php echo esc_attr($jehanne_options['footer_menu_link_hover']); ?>;
		}
		#footer-navigation .horisontal-navigation li a:hover,
		#footer-navigation .horisontal-navigation li a:focus {
			background: <?php echo esc_attr($jehanne_options['footer_menu_link_hover_back']); ?>;
			color: <?php echo esc_attr($jehanne_options['footer_menu_link_hover']); ?>;
		}
		#footer-navigation .horisontal-navigation li ul li a:hover {
			background: <?php echo esc_attr($jehanne_options['footer_menu_color']); ?>;
			color: <?php echo esc_attr($jehanne_options['footer_menu_link']); ?>;
		}
		#footer-navigation .horisontal-navigation .current-menu-item > a,
		#footer-navigation .horisontal-navigation .current-menu-ancestor > a,
		#footer-navigation .horisontal-navigation .current_page_item > a,
		#footer-navigation .horisontal-navigation .current_page_ancestor > a {
			border: 1px solid <?php echo esc_attr($jehanne_options['footer_menu_link_hover_back']); ?>;
		}
		#footer-navigation .horisontal-navigation li ul .current-menu-item > a,
		#footer-navigation .horisontal-navigation li ul .current-menu-ancestor > a,
		#footer-navigation .horisontal-navigation li ul .current_page_item > a,
		#footer-navigation .horisontal-navigation li ul .current_page_ancestor > a {
			background-color: <?php echo esc_attr($jehanne_options['footer_menu_color']); ?>;
			color: <?php echo esc_attr($jehanne_options['footer_menu_link']); ?>;
		}
	/* Footer Sidebar */
	
	.sidebar-footer {
		background-color:<?php echo esc_attr($jehanne_options['footer_sidebar_color']); ?>;
	}	
	.sidebar-footer .widget-wrap .widget {
		color: <?php echo esc_attr($jehanne_options['footer_sidebar_text']); ?>;
	}
	.sidebar-footer .widget-wrap .widget a {
		color: <?php echo esc_attr($jehanne_options['footer_sidebar_link']); ?>;
	}
	.sidebar-footer .widget-wrap .widget a:hover {
		color: <?php echo esc_attr($jehanne_options['footer_sidebar_link_hover']); ?>;
	}
	
	/* Top Sidebar */
	.sidebar-top-full,
	.sidebar-top {
		background-color:<?php echo esc_attr($jehanne_options['top_sidebar_color']); ?>;
	}	
	.sidebar-top-full .widget-wrap .widget,
	.sidebar-top .widget-wrap .widget {
		color: <?php echo esc_attr($jehanne_options['top_sidebar_text']); ?>;
	}
	.sidebar-top-full .widget-wrap .widget a,
	.sidebar-top .widget-wrap .widget a {
		color: <?php echo esc_attr($jehanne_options['top_sidebar_link']); ?>;
	}
	.sidebar-top-full .widget-wrap .widget a:hover,
	.sidebar-top .widget-wrap .widget a:hover {
		color: <?php echo esc_attr($jehanne_options['top_sidebar_link_hover']); ?>;
	}
	.column .widget .widget-title {
		color: <?php echo esc_attr($jehanne_options['column_header_text']); ?>;
	}
	
	.column .widget .widget-title {
		background: <?php echo esc_attr($jehanne_options['column_header_color']); ?>;
	}
	
	.site-navigation a,
	.image-and-cats a,
	.post-date a,
	.column .widget a,
	.content a {
		color: <?php echo esc_attr($jehanne_options['link']); ?>;
	}
	.entry-header .entry-title a,
	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		color: <?php echo esc_attr($jehanne_options['heading']); ?>;
	}

	
	.site-main-info {
		background:<?php echo esc_attr($jehanne_options['column_color']);?>;
	}
	
	.site {
		margin: <?php echo esc_attr($jehanne_options['margin_top'])?>px auto <?php echo esc_attr($jehanne_options['margin_bottom'])?>px auto;
		max-width: <?php echo esc_attr($jehanne_options['max_width']); ?>px;
		width: <?php echo esc_attr( $jehanne_options['layout'] == 'boxed' ? '94%' : '100%' ); ?>;
	}
	
	<?php if($jehanne_options['front_style'] == 'default' ) : ?>
	
		.page-template-page-templatesfront-page-php  .sidebar-content-before-footer .widget,
		.page-template-page-templatesfront-page-php  .sidebar-before-content .widget,
		.page-template-page-templatesfront-page-no-column-php  .site-content .widget,
		.page-template-page-templatesno-column-php .site-content .widget {
			border-bottom: 4px double #ccc;
		}
	
		.page-template-page-templatesfront-page-php  .sidebar-before-content .widget {
			margin-bottom: 10px;
		}
		
		.page-template-page-templatesfront-page-php  .sidebar-content-before-footer .widget-wrap,
		.page-template-page-templatesfront-page-php  .sidebar-before-content .widget-wrap,
		.page-template-page-templatesfront-page-no-column-php  .site-content .widget-wrap {
			margin: 0 20px 40px 20px;
		}

	<?php elseif($jehanne_options['front_style'] == 'shadow_1' )  : ?>
	
		.page-template-page-templatesfront-page-php  .sidebar-content-before-footer .widget,
		.page-template-page-templatesfront-page-php  .sidebar-before-content .widget,
		.page-template-page-templatesno-column-php .site-content .widget {
			border: 1px solid #eee;
		}
		.page-template-page-templatesfront-page-php  .sidebar-content-before-footer .widget,
		.page-template-page-templatesfront-page-php  .sidebar-before-content .widget,
		.page-template-page-templatesfront-page-no-column-php  .site-content .widget {
			position: relative;       
			-webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
			-moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
			box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
		}

		.page-template-page-templatesfront-page-php  .sidebar-content-before-footer .widget,
		.page-template-page-templatesfront-page-php  .sidebar-before-content .widget,
		.page-template-page-templatesfront-page-no-column-php  .site-content .widget {
			background: #fff;
		}
		
		.page-template-page-templatesfront-page-php  .sidebar-content-before-footer .widget-wrap,
		.page-template-page-templatesfront-page-php  .sidebar-before-content .widget-wrap,
		.page-template-page-templatesfront-page-no-column-php  .site-content .widget-wrap {
			margin: 40px 20px;
		}

	<?php elseif($jehanne_options['front_style'] == 'shadow_2' )  : ?>
	
		.page-template-page-templatesfront-page-php  .sidebar-content-before-footer .widget,
		.page-template-page-templatesfront-page-php  .sidebar-before-content .widget,
		.page-template-page-templatesfront-page-no-column-php  .site-content .widget,
		.page-template-page-templatesno-column-php .site-content .widget {
			border-bottom: 24px solid green;
			bordesr-top: 1px solid green;
		}
		
		.page-template-page-templatesfront-page-php  .sidebar-content-before-footer .widget-wrap,
		.page-template-page-templatesfront-page-php  .sidebar-before-content .widget-wrap,
		.page-template-page-templatesfront-page-no-column-php  .site-content .widget-wrap {
			margin: 40px 20px;
		}

	<?php endif; ?>

	
	<?php if($jehanne_options['color_skin'] == 'red' && $jehanne_options['color_scheme'] == 'dark' ) : ?>
		.site {
			background-image: linear-gradient(rgba(255,0,0,0.7),rgba(17,17,17,1) 140px);
			background-attachment: fixed;
		}
		.sidebar-footer-full  {
			background: #333;
			background-image: linear-gradient(rgba(17,17,17,0.5) 80%, rgba(255,0,0,0.7));
			background-attachment: fixed;
		}
	<?php elseif($jehanne_options['color_skin'] == 'black' && $jehanne_options['color_scheme'] == 'dark') : ?>
		.site {
			background-image: linear-gradient(rgba(0,0,0,0.7),rgba(17,17,17,1) 140px);
			background-attachment: fixed;
		}
	<?php elseif($jehanne_options['color_skin'] == 'blue' && $jehanne_options['color_scheme'] == 'dark') : ?>
		.site {
			background-image: linear-gradient(rgba(0, 0, 255, 0.7),rgba(17,17,17,1) 140px);
			background-attachment: fixed;
		}	
	<?php endif; ?>
	
	.column .widget {
		background: <?php echo esc_attr( $jehanne_options['widget_back']); ?>;
	}
	
	.column .widget {
		color: <?php echo esc_attr($jehanne_options['column_text']); ?>;
	}
	
	.column .widget a {
		color: <?php echo esc_attr($jehanne_options['column_link']); ?>;
	}
	
	.column .widget a:hover {
		color: <?php echo esc_attr($jehanne_options['column_hover']); ?>;
	}
	
	<?php if($jehanne_options['is_responsive'] == 0) : ?>

		.site {
			min-width: <?php echo esc_attr($jehanne_options['min_width']); ?>px;
		}
		
	<?php endif; ?>
	
	<?php if($jehanne_options['hide_top_1_sidebar'] == 0) : ?>
	
		#sidebar-1 .widget-area {
			display: block;
			max-height: 100%;
			overflow: auto;
		}
		#sidebar-1 .sidebar-toggle	{
			display: none;
		}
	
		#sidebar-2 .widget-area {
			display: block;
			max-height: 100%;
			overflow: auto;
		}
		#sidebar-2 .sidebar-toggle	{
			display: none;
		}
	
		#sidebar-3 .widget-area {
			display: block;
			max-height: 100%;
			overflow: auto;
		}
		#sidebar-3 .sidebar-toggle	{
			display: none;
		}
	
		#sidebar-4 .widget-area {
			display: block;
			max-height: 100%;
			overflow: auto;
		}
		#sidebar-4 .sidebar-toggle	{
			display: none;
		}
	
		#sidebar-5 .widget-area {
			display: block;
			max-height: 100%;
			overflow: auto;
		}
		#sidebar-5 .sidebar-toggle	{
			display: none;
		}
	
		#sidebar-6 .widget-area {
			display: block;
			max-height: 100%;
			overflow: auto;
		}
		#sidebar-6 .sidebar-toggle	{
			display: none;
		}
	
		#sidebar-7 .widget-area {
			display: block;
			max-height: 100%;
			overflow: auto;
		}
		#sidebar-7 .sidebar-toggle	{
			display: none;
		}
	
	<?php endif; ?>
	
	<?php if($jehanne_options['hide_1_menu'] == 0) : ?>
	
		#menu-1 ul.nav-horizontal,
		#menu-1 div.nav-horizontal {
			display: block;
			max-height: 100%;
			overflow: visible;
		}
		#menu-1 .menu-toggle {
			display: none;
		}
	
	<?php endif; ?>
	
	<?php if($jehanne_options['hide_2_menu'] == 0) : ?>
	
		#menu-2 ul.nav-horizontal,
		#menu-2 div.nav-horizontal {
			display: block;
			max-height: 100%;
			overflow: visible;
		}
		#menu-2 .menu-toggle {
			display: none;
		}
	
	<?php endif; ?>
	
	<?php if($jehanne_options['hide_3_menu'] == 0) : ?>
	
		#menu-3 ul.nav-menu,
		#menu-3 div.nav-menu {
			display: block;
			max-height: 100%;
			overflow: visible;
		}
		#menu-3 .menu-toggle {
			display: none;
		}
	
	<?php endif; ?>
	
	<?php if($jehanne_options['hide_4_menu'] == 0) : ?>
	
		#menu-4 ul.nav-horizontal,
		#menu-4 div.nav-horizontal {
			display: block;
			max-height: 100%;
			overflow: visible;
		}
		#menu-4 .menu-toggle {
			display: none;
		}
	
	<?php endif; ?>
	
	</style> <?php
}
add_action('wp_head', 'jehanne_hook_css');
/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since jehanne 1.0
 */
function jehanne_customize_preview_js() {
	wp_enqueue_script( 'jehanne-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), time(), true );
}
add_action( 'customize_preview_init', 'jehanne_customize_preview_js', 99 );

 /**
 * Sanitize bool value.
 *
 * @param string $value Value to sanitize. 
 * @return int 1 or 0.
 * @since jehanne 1.0
 */
function jehanne_sanitize_checkbox( $value ) {	
	return ( $value == '1' ? '1' : 0 );
}  
/**
 * Sanitize bool value.
 *
 * @param string $value Value to sanitize. 
 * @return int 1 or 0.
 * @since jehanne 1.0
 */
function jehanne_sanitize_0_1( $value ) {	
	return ( $value == 0 ? 0 : 1 );
} 
 /**
 * Sanitize url value.
 *
 * @param string $value Value to sanitize. 
 * @return string sanitizes url.
 * @since jehanne 1.0
 */
function jehanne_sanitize_url( $value ) {	
	return esc_url_raw( $value );
}
/**
 * Sanitize integer.
 *
 * @param string $value Value to sanitize. 
 * @return int sanitized value.
 * @uses absint()
 * @since jehanne 1.0
 */
function jehanne_sanitize_int( $value ) {
	return absint( $value );
} 
/**
 * Sanitize text field.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @uses sanitize_text_field()
 * @since jehanne 1.0
 */
function jehanne_sanitize_text( $value ) {
	return sanitize_text_field( $value );
}
/**
 * Sanitize max width.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0.1
 */
function jehanne_sanitize_max_width( $value ) {
	$value = absint($value);
	if ($value >= 960 && $value <= 1349 )
		return $value;
	return 1349;
}
/**
 * Sanitize margin.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0.1
 */
function jehanne_sanitize_margin( $value ) {
	return absint($value);
}
/**
 * Sanitize hex color.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @uses sanitize_hex_color()
 * @since jehanne 1.0
 */
function jehanne_sanitize_hex_color( $value ) {
	return sanitize_hex_color( $value );
}
/**
 * Sanitize class for Social Media Links.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0
 */
function jehanne_sanitize_button_class( $value ) {
	$possible_values = array( 'big', 'small');
	return ( in_array( $value, $possible_values ) ? $value : 'big' );
}
/**
 * Sanitize post thumbnail type.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0
 */
function jehanne_sanitize_post_thumbnail( $value ) {
	$possible_values = array( 'small', 'right', 'left' );
	return ( in_array( $value, $possible_values ) ? $value : 'small' );
}
/**
 * Sanitize scroll button.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0
 */
function jehanne_sanitize_scroll_button( $value ) {
	$possible_values = array( 'none', 'right', 'left', 'center');
	return ( in_array( $value, $possible_values ) ? $value : 'right' );
}

/**
 * Sanitize scroll css3 effect.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0
 */
function jehanne_sanitize_scroll_effect( $value ) {
	$possible_values = array( 'none', 'move');
	return ( in_array( $value, $possible_values ) ? $value : 'move' );
}
/**
 * Sanitize scroll css3 effect.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0.2
 */
function jehanne_sanitize_front_style( $value ) {
	$possible_values = array( 'default', 'shadow_1', 'shadow_2');
	return ( in_array( $value, $possible_values ) ? $value : 'default' );
}
/**
 * Sanitize layout style.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0.1
 */
function jehanne_sanitize_layout( $value ) {
	$possible_values = array( 'boxed', 'full_screen');
	return ( in_array( $value, $possible_values ) ? $value : 'boxed' );
}
/**
 * Sanitize gradient style.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0.1
 */
function jehanne_sanitize_gradient_type( $value ) {
	$possible_values = array( 'linear', '0');
	return ( in_array( $value, $possible_values ) ? $value : '0' );
}

/**
 * Sanitize opacity.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0.1
 */
function jehanne_sanitize_opacity( $value ) {
	$possible_values = array ('0.1', 
							   '0.2', 
							   '0.3', 
							   '0.4', 
							   '0.5',
							   '0.6', 
							   '0.7',
							   '0.8',
							   '0.9',
							   '1');
	return ( in_array( $value, $possible_values ) ? $value : '0.7' );
}

/**
 * Sanitize color scheme.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0.1
 */
function jehanne_sanitize_color_scheme( $value ) {
	$possible_values = array( 'light', 'dark');
	return ( in_array( $value, $possible_values ) ? $value : 'light' );
}
/**
 * Sanitize color skin.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since jehanne 1.0.1
 */
function jehanne_sanitize_color_skin( $value ) {
	$possible_values = array( 'blue', 'black', 'red');
	return ( in_array( $value, $possible_values ) ? $value : 'blue' );
}
/**
 * Transform hex color to rgba
 *
 * @param string $color hex color. 
 * @param int $opacity opacity. 
 * @return string rgba color.
 * @since jehanne 1.0.1
 */
function jehanne_hex_to_rgba( $color, $opacity ) {

	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	$hex = 'ffffff';
	
	if ( 6 == strlen($color) ) {
			$hex = array( $color[0].$color[1], $color[2].$color[3], $color[4].$color[5] );
	} elseif ( 3 == strlen( $color ) ) {
			$hex = array( $color[0].$color[0], $color[1].$color[1], $color[2].$color[2] );
	}

	$rgb =  array_map('hexdec', $hex);

	return 'rgba('.implode(",",$rgb).','.$opacity.')';
}
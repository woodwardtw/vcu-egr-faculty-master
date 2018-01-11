<?php
/**
 * Theme: Flat Bootstrap Child
 * 
 * Functions file for child theme. If you want to make a lot more changes than what is
 * included here, consider downloading the Flat Bootstrap Developer child theme. It 
 * shows how to do more complex function overrides, like choosing more theme features to
 * include or exclude, loading up custom CSS or javascript, etc.
 *
 * @package flat-bootstrap-child
 */
 
/**
 * SET THEME OPTIONS HERE
 *
 * Theme options can be overriden here. These are all set the same defaults as in the 
 * parent theme, but listed here so you can easily change them. Just uncomment (remove
 * the //) from any lines that you change.
 * 
 * Parameters:
/**
 * Theme options. Can override in child theme. For theme developers, this is array so 
 * you can add these items to the customizer and store them all as a single options entry.
 * 
 * Parameters:
 * background_color - Hex code for default background color without the #. eg) ffffff
 * 
 * content_width - Only for determining "full width" image. Actual width in Bootstrap.css
 * 		is 1170 for screens over 1200px resolution, otherwise 970.
 * 
 * embed_video_width - Sets the maximum width of videos that use the <embed> tag. The
 * 		default is 1170 to handle full-width page templates. If you will ALWAYS display
 * 		the sidebar, can set to 600 for better performance.
 * 
 * embed_video_height - Leave empty to automatically set at a 16:9 ratio to the width
 * 
 * post_formats - Array of WordPress extra post formats. i.e. aside, image, video, quote,
 * 		and/or link
 * 
 * touch_support - Whether to load touch support for carousels (sliders)
 * 
 * fontawesome - Whether to load font-awesome font set or not
 * 
 * bootstrap_gradients - Whether to load Bootstrap "theme" CSS for gradients
 * 
 * navbar_classes - One or more of navbar-default, navbar-inverse, navbar-fixed-top, etc.
 * 
 * custom_header_location - If 'header', displays the custom header above the navbar. If
 * 		'content-header', displays it below the navbar in place of the colored content-
 *		header section.
 * 
 * image_keyboard_nav - Whether to load javascript for using the keyboard to navigate
 		image attachment pages
 * 
 * sample_widgets - Whether to display sample widgets in the footer and page-bottom widet
 		areas.
 * 
 * sample_footer_menu - Whether to display sample footer menu with Top and Home links
 * 
 * testimonials - Whether to activate testimonials custom post type if Jetpack plugin is active
 *
 * NOTE: $theme_options has been deprecated and replaced with $xsbf_theme_options. You'll
 * need to update your child themes.
 */
$xsbf_theme_options = array(
	//'background_color' 		=> 'f2f2f2',
	//'content_width' 			=> 1170,
	//'embed_video_width' 		=> 1170,
	//'embed_video_height' 		=> null, // i.e. calculate it automatically
	//'post_formats' 			=> null,
	//'touch_support' 			=> true,
	//'fontawesome' 			=> true,
	//'bootstrap_gradients' 	=> false,
	//'navbar_classes'			=> 'navbar-default navbar-static-top',
	//'custom_header_location' 	=> 'header',
	//'image_keyboard_nav' 		=> true,
	//'sample_widgets' 			=> true, // for possible future use
	//'sample_footer_menu'		=> true,
	//'testimonials'			=> true
);

/* 
 * Load the parent theme's stylesheet here for performance reasons instead of using 
 * @include in this theme's stylesheet. Load this after the parent theme's styles.
 */
add_action( 'wp_enqueue_scripts', 'xsbf_child_enqueue_styles' );
function xsbf_child_enqueue_styles() {
	wp_enqueue_style( 'flat-bootstrap', 
		get_template_directory_uri() . '/style.css',
		array ( 'bootstrap', 'theme-base', 'theme-flat')
	);

	wp_enqueue_style( 'child', 
		get_stylesheet_directory_uri() . '/style.css', 
		array('flat-bootstrap') 
	);

	wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400,700' );

	wp_enqueue_script( 'vcu-brand-bar', '//branding.vcu.edu/bar/academic/latest.js' );
}

/*
 * OVERRIDE THE SITE CREDITS TO GET RID OF THE "THEME BY XTREMELYSOCIAL" AND JUST LEAVE
 * COPYRIGHT YOUR SITE NAME
 * 
 * You can hard-code whatever you want in here, but its better to have this function pull
 * the current year and site name and URL as shown below.
 */
add_filter('xsbf_credits', 'xsbf_child_credits'); 
function xsbf_child_credits ( $site_credits ) {
		
	$theme = wp_get_theme();
	$site_credits = sprintf( __( '&copy; %1$s %2$s', 'flat-bootstrap' ), 
		date ( 'Y' ),
		'<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a>'
	);
	return $site_credits;
}

function mytheme_customize_register( $wp_customize ) {
	/* Site Identity */
	$wp_customize->get_control('blogname')->label = 'Lab name';
	$wp_customize->get_control('blogdescription')->label = 'Department name(s)';

	$wp_customize->add_setting( 'school_name', array(
	  'default'   => true,
	) );

	$wp_customize->add_control( 
		new WP_Customize_Control( 
		$wp_customize, 
		'school_name', 
		array(
			'label'      => __( 'Display "School of Engineering" under lab and department', 'flat-bootstrap-egr-faculty' ),
			'section'    => 'title_tagline',
			'settings'   => 'school_name',
			'type'			 => 'checkbox',
		) ) 
	);

	// add dept badge

	$wp_customize->add_setting( 'department_badge', array(
		'default' => '',
	)	);

	$wp_customize->add_control(
		new WP_Customize_Control(
		$wp_customize,
		'department_badge', array(
	    'label' => __( 'Department badge', 'flat-bootstrap-egr-faculty' ),
	    'section' => 'title_tagline',
	    'settings' => 'department_badge',
	    'type' => 'select',
	    'choices' => array(
        'bio'   => __( 'Biomedical Engineering' ),
        'chem'   => __( 'Chemical & Life Science Engineering' ),
        'comp'   => __( 'Computer Science' ),
        'elec'   => __( 'Electrical & Computer Engineering' ),
        'mech'  => __( 'Mechanical & Nuclear Engineering' )
      )
		) )
	);

	// might want to assign favicon the same as above

	$wp_customize->add_setting( 'department_badge_display', array(
		'default' => true,
	)	);

	$wp_customize->add_control(
		new WP_Customize_Control(
		$wp_customize,
		'department_badge_display', array(
	    'label' => __( 'Show department badge', 'flat-bootstrap-egr-faculty' ),
	    'section' => 'title_tagline',
	    'settings' => 'department_badge_display',
	    'type' => 'checkbox',
		) )
	);

	// $wp_customize->add_setting( 'department_badge', array(
	// 	'default' => '',
	// )	);

	// $wp_customize->add_control(
	// 	new WP_Customize_Media_Control(
	// 	$wp_customize,
	// 	'audio_control', array(
	//     'label' => __( 'Department badge', 'flat-bootstrap-egr-faculty' ),
	//     'section' => 'title_tagline',
	//     'settings' => 'department_badge',
	//     'mime_type' => 'image',
	// 	) )
	// );

	/* Colors */

	$wp_customize->add_setting( 'theme_color_department', array(
		'default' => '',
	)	);

	$wp_customize->add_control(
		new WP_Customize_Control(
		$wp_customize,
		'theme_color_department', array(
	    'label' => __( 'Department theme colors', 'flat-bootstrap-egr-faculty' ),
	    'section' => 'colors',
	    'settings' => 'theme_color_department',
	    'type' => 'select',
	    'choices' => array(
        'bio'   => __( 'Biomedical Engineering' ),
        'chem'   => __( 'Chemical & Life Science Engineering' ),
        'comp'   => __( 'Computer Science' ),
        'elec'   => __( 'Electrical & Computer Engineering' ),
        'mech'  => __( 'Mechanical & Nuclear Engineering' )
      )
		) )
	);

	// $wp_customize->add_setting( 'theme_color_override' , array(
	//   'default'   => '#fefefe',
	// ) );

	// $wp_customize->add_control( 
	// 	new WP_Customize_Color_Control( 
	// 	$wp_customize, 
	// 	'theme_color_override', 
	// 	array(
	// 		'label'      => __( 'Theme color override', 'flat-bootstrap-egr-faculty' ),
	// 		'section'    => 'colors',
	// 		'settings'   => 'theme_color_override',
	// 	) ) 
	// );

	$wp_customize->remove_control('background_color');
	$wp_customize->remove_control('header_textcolor');
}
add_action( 'customize_register', 'mytheme_customize_register' );

function mytheme_customize_css() {
	$theme_color = '#fefefe';
	$theme_color_department = get_theme_mod('theme_color_department');
	$theme_color_link_text = '#2980b9';
	$theme_color_nav_text = '#ffffff';
	$theme_color_nav_text_hover = '#fefefe';
	if ($theme_color_department) {
		if ($theme_color_department === 'bio') {
			$theme_color = '#E02E06';
			$theme_color_link_text = '#E02E06';
			// $theme_color = '#E02E06';
		}
		if ($theme_color_department === 'chem') {
			$theme_color = '#EB0533';
			$theme_color_link_text = '#EB0533';
			// $theme_color = '#EB0533';
		}
		if ($theme_color_department === 'comp') {
			$theme_color = '#15845F';
			$theme_color_link_text = '#15845F';
			// $theme_color = '#15845F';
		}
		if ($theme_color_department === 'elec') {
			$theme_color = '#27827A';
			$theme_color_link_text = '#27827A';
			// $theme_color = '#27827A';
		}
		if ($theme_color_department === 'mech') {
			$theme_color = '#3679A6';
			$theme_color_link_text = '#3679A6';
			// $theme_color = '#3679A6';
		}
	}
  ?>
		<style type="text/css">
			a {
				color: <?php echo $theme_color_link_text; ?>;
			}

			a:focus,
			a:hover {
				color: <?php echo $theme_color_link_text; ?>;
			}
	
			blockquote {
				border-left: 5px solid <?php echo $theme_color; ?>;
			}

			button,
			html input[type="button"],
			input[type="submit"] {
				color: <?php echo $theme_color_nav_text; ?>;
		    background-color: <?php echo $theme_color; ?>;
		    border-color: <?php echo $theme_color; ?>;
			}

			button:hover, 
			button:focus,
			html input[type="button"]:focus,
			html input[type="button"]:hover,
			input[type="submit"]:focus,
			input[type="submit"]:hover {
		    color: <?php echo $theme_color_nav_text_hover; ?>;
		    background-color: <?php echo $theme_color; ?>;
		    border-color: <?php echo $theme_color; ?>;
			}

			hr {
				border-top: 1px solid <?php echo $theme_color; ?>;
			}

			.bg-lightgreen {
				background-color: <?php echo $theme_color; ?>;
			}

			.btn-primary:active,
			.btn-primary.active, 
			.open > .dropdown-toggle.btn-primary {
				color: <?php echo $theme_color_nav_text_hover; ?>;
		    background-color: <?php echo $theme_color; ?>;
		    border-color: <?php echo $theme_color; ?>;
			}

		  .navbar {
		   	background-color: <?php echo $theme_color; ?>;
		   	text-transform: uppercase;
		  }

		  .navbar-default .navbar-nav > li > a,
		  .navbar-default .navbar-nav > li > a:visited {
		   	color: <?php echo $theme_color_nav_text; ?>;
		  }

		  .navbar-default .navbar-nav > li > a:focus,
		  .navbar-default .navbar-nav > li > a:hover {
		   	color: <?php echo $theme_color_nav_text_hover; ?>;
		  }
		</style>
  <?php
}
add_action( 'wp_head', 'mytheme_customize_css');

register_sidebar( array(
	'name' 			=> __( 'Footer', 'flat-bootstrap-child-egr-faculty' ),
	'id' 			=> 'sidebar-footer',
	'description' 	=> __( 'Optional site footer widgets. Add text-widget Contact and Address sections, otherwise the standard egr.vcu.edu address and contact button will be used.', 'flat-bootstrap-child-egr-faculty' ),
	'before_widget' => '<br><aside id="%1$s" class="widget clearfix %2$s">',
	'after_widget' 	=> "</aside>",
	'before_title' 	=> '<h2 class="widget-title">',
	'after_title' 	=> '</h2>',
) );

if ( ! function_exists( 'xsbf_get_the_excerpt' ) ) :
add_filter( 'get_the_excerpt', 'xsbf_get_the_excerpt' );
function xsbf_get_the_excerpt( $excerpt ) {

  if ( ! is_attachment() ) {
    if ( $excerpt ) {
      $excerpt .= '&hellip; ';
    }
    $excerpt .= '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __( 'Read more<span class="sr-only"> about ' . get_the_title( get_the_ID() ) . '</span>', 'flat-bootstrap' ) . '</a>';
  }
  return $excerpt;
}
endif; // end ! function_exists

// Remove plugin recommendations
add_action( 'init', 'remove_plugin_recommendations' );
function remove_plugin_recommendations() {
	remove_action( 'tgmpa_register', 'xsbf_bootstrap_register_required_plugins' );
}

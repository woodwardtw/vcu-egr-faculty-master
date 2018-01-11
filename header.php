<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package flat-bootstrap
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="skip-links">
  <a class="skip-links-item" href="#content" tabindex="1">Skip to main content</a>
  <a class="skip-links-item" href="#site-navigation" tabindex="2">Skip to navigation</a>
  <a class="skip-links-item" href="#footer" tabindex="3">Skip to footer</a>
</div>
  
<div id="page" class="hfeed site">

  <?php do_action( 'before' ); ?>
  
  <header id="masthead" class="site-header" role="banner">

    <?php
    /**
      * CUSTOM HEADER IMAGE DISPLAYS HERE FOR THIS THEME, BUT CHILD THEMES MAY DISPLAY
      * IT BELOW THE NAV BAR (VIA CONTENT-HEADER.PHP)
      */
    global $xsbf_theme_options;
    $custom_header_location = isset ( $xsbf_theme_options['custom_header_location'] ) ? $xsbf_theme_options['custom_header_location'] : 'content-header';
    if ( $custom_header_location == 'header' ) :
    ?>
      <div id="site-branding" class="site-branding">
      
      <?php
      // Get custom header image and determine its size
      if ( get_header_image() ) {
      ?>
        <div class="custom-header-image" style="background-image: url('<?php echo header_image() ?>'); width: <?php echo get_custom_header()->width; ?>px; height: <?php echo get_custom_header()->height ?>px;">
        <div class="container">
                <?php //if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
                <div class="site-branding-text">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' )?></a></h1>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
        <h3 class="site-school">
          <?php if (get_theme_mod( 'school_name', true ) == true): ?>
            <a href="https://egr.vcu.edu">School of Engineering</a>
          <?php endif; ?>
        </div>
        </div></div>
      <?php
      // If no custom header, then just display the site title and tagline
      } else {
      ?>
        <div class="container">
          <?php //if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
          <?php if (get_theme_mod( 'department_badge_display', true ) == true): ?>
            <?php $department_badge = get_theme_mod( 'department_badge'); ?>
            <div class="site-branding-badge">
              <img alt="<?php bloginfo( 'title' ); ?>&rsquo;s department badge" src="<?php echo get_stylesheet_directory_uri() . '/images/' . $department_badge . '-icon.png' ?>" />
              <!-- <img src="<?php // echo wp_get_attachment_image_src($department_badge, 'full')[0]; ?>" /> -->
            </div>
          <?php endif; ?>
          <div class="site-branding-text">
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' )?></a></h1>
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            <h3 class="site-school">
              <?php if (get_theme_mod( 'school_name', true ) == true): ?>
                <a href="https://egr.vcu.edu">School of Engineering</a>
              <?php endif; ?>
            </h3>
          </div>
        </div>
      <?php
      } //endif get_header_image()
      ?>
      </div><!-- .site-branding -->

    <?php     
    endif; // $custom_header_location
    ?>      

    <?php
    /**
      * ALWAYS DISPLAY THE NAV BAR
      */
    ?>  
    <nav id="site-navigation" class="main-navigation" role="navigation">

      <h2 class="menu-toggle screen-reader-text sr-only "><?php _e( 'Primary Menu', 'flat-bootstrap' ); ?></h2>
      <div class="skip-link"><a class="screen-reader-text sr-only" href="#content"><?php _e( 'Skip to content', 'flat-bootstrap' ); ?></a></div>

    <?php
    // Collapsed navbar menu toggle
    global $xsbf_theme_options;
    $navbar = '<div class="navbar ' . $xsbf_theme_options['navbar_classes'] . '">'
      .'<div class="container">'
          .'<div class="navbar-header">'
            .'<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">'
            .'<span class="icon-bar"></span>'
            .'<span class="icon-bar"></span>'
            .'<span class="icon-bar"></span>'
            .'</button>';
    // Site title (Bootstrap "brand") in navbar. Hidden by default. Customizer will
    // display it if user turns off the main site title and tagline.
    $navbar .= '<a class="navbar-brand" href="'
      .esc_url( home_url( '/' ) )
      .'" rel="home">'
      .get_bloginfo( 'name' )
      .'</a>';
    
        $navbar .= '</div><!-- navbar-header -->';
    // Display the desktop navbar
    $navbar .= '<div class="navbar-collapse collapse">';
    $navbar .= wp_nav_menu( 
      array(  'theme_location' => 'primary',
      //'container_class' => 'navbar-collapse collapse', //<nav> or <div> class
      'menu_class' => 'nav navbar-nav', //<ul> class
      'walker' => new wp_bootstrap_navwalker(),
      'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
      'echo'  => false
      ) 
    );
        
    echo apply_filters( 'xsbf_navbar', $navbar );
    ?>

    </div><!-- .container -->
    </div><!-- .navbar -->
    </nav><!-- #site-navigation -->

  </header><!-- #masthead -->

  <?php // Set up the content area (but don't put it in a container) ?> 
  <div id="content" class="site-content">

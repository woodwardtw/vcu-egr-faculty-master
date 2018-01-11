<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package flat-bootstrap
 */
?>
  </div><!-- #content -->

  <?php // Page bottom (before footer) widget area 
  get_sidebar( 'pagebottom' ); 
  ?>

  <?php // Start the footer area ?>
  <footer id="footer" class="site-footer" role="contentinfo">
    
  <?php // Footer "sidebar" widget area (1 to 4 columns supported)
  // get_sidebar( 'footer' );
  ?>
    <div class="container">
      <div class="contact-area col-md-5">
        <h1 class="site-vcu"><a href="https://www.vcu.edu/" target="_blank">Virginia Commonwealth University</a></h1>
        
        <h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' )?></a></h2>
        <h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
        <h4 class="site-school">
          <?php if (get_theme_mod( 'school_name' ) == true): ?>
            <a href="https://egr.vcu.edu">School of Engineering</a>
          <?php endif; ?>
        </h4>

        <?php if (!get_dynamic_sidebar( 'sidebar-footer' )): ?>
        <br>
        <address>
          School of Engineering
          <br> 601 West Main Street
          <br> Box 843068
          <br> Richmond, Virginia 23284-3068
        </address>
        <a href="https://egr.vcu.edu/about/contact-us/" class="btn btn-md btn-default" aria-label="Contact Us Footer Link">Contact Us<i class="fa fa-long-arrow-right"></i></a>
        <?php else: ?>
          <?php echo get_dynamic_sidebar( 'sidebar-footer' ); ?>
        <?php endif; ?>

      </div>
      <div class="icon-links col-md-7">
        <a class="link" href="https://egr.vcu.edu/departments/biomedical/">
          <img class="icon" alt="BME Icon Image" src="<?php echo get_stylesheet_directory_uri() . '/images/'; ?>bio-icon.png">
          <span class="name">Biomedical Engineering</span>
        </a>
        <a class="link" href="https://egr.vcu.edu/departments/chemical/">
          <img class="icon" alt="CLSE Icon Image" src="<?php echo get_stylesheet_directory_uri() . '/images/'; ?>chem-icon.png">
          <span class="name">Chemical &amp; Life Science Engineering</span>
        </a>
        <a class="link" href="https://egr.vcu.edu/departments/computer/">
          <img class="icon" alt="CS Icon Image" src="<?php echo get_stylesheet_directory_uri() . '/images/'; ?>comp-icon.png">
          <span class="name">Computer Science</span>
        </a>
        <a class="link" href="https://egr.vcu.edu/departments/electrical/">
          <img class="icon" alt="ECE Icon Image" src="<?php echo get_stylesheet_directory_uri() . '/images/'; ?>elec-icon.png">
          <span class="name">Electrical &amp; Computer Engineering</span>
        </a>
        <a class="link" href="https://egr.vcu.edu/departments/mechanical/">
          <img class="icon" alt="MNE Icon Image" src="<?php echo get_stylesheet_directory_uri() . '/images/'; ?>mech-icon.png">
          <span class="name">Mechanical &amp; Nuclear Engineering</span>
        </a>
      </div>
      <div class="social-links col-md-12">
        <a class="social-link fa fa-facebook" href="https://www.facebook.com/VCUEngineering/">Facebook</a>
        <a class="social-link fa fa-twitter" href="https://twitter.com/VCUENGR">Twitter</a>
        <a class="social-link fa fa-youtube" href="https://www.youtube.com/user/VCUSchoolOfEngr">YouTube</a>
        <a class="social-link fa fa-linkedin" href="https://www.linkedin.com/edu/school?id=170031">Linkedin</a>
        <a class="social-link fa fa-instagram" href="https://www.instagram.com/vcu_eng/">Instagram</a>
        <a class="social-link fa fa-envelope" href="mailto:<?php echo get_bloginfo( 'admin_email' ); ?>">Email</a>
      </div>
      <small>Updated: <script>var d = new Date(document.lastModified);document.write(d.toLocaleDateString());</script> / Created by <a href="http://univrelations.vcu.edu/" target="_blank">VCU University Relations</a><br><a href="http://text.vcu.edu:8080/tt/referrer">View text version</a><br><a href="https://www.vcu.edu/vcu/privacy-statement.html" title="VCU privacy statement" target="_blank">Privacy</a> | <a href="http://accessibility.vcu.edu/" title="Accessibility at VCU" target="_blank">Accessibility</a> | <a href="mailto:kimkd@vcu.edu" title="Contact the VCU webmaster" target="_blank">Webmaster</a></small>
    </div>
    
  </footer><!-- #footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

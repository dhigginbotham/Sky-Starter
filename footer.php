<?php
/**
 * SkyStarter Footer
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */
?>
	  </div><!-- / #content-wrap -->

    <footer id="footer-wrap" role="contentinfo">

    	<div id="footer" class="<?php echo WRAP_CLASSES; ?>">

	      <?php dynamic_sidebar( 'skystarter-footer' ); ?>
	      <p class="copy"><small>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></small></p>

	    </div><!-- /#footer -->

    </footer><!-- /#footer-wrap -->
  
    <?php wp_footer(); ?>

  </body>
</html>
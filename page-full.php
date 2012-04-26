<?php
/**
 * SkyStarter Full Width Template
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 * 
 * Template Name: Full Width
 */
get_header(); ?>
  <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    
    <div id="main" class="<?php echo FULLWIDTH_CLASSES; ?>" role="main">
      <?php get_template_part( 'loop', 'page' ); ?>
    </div><!-- / #main -->

  </div><!-- / #content -->
<?php get_footer(); ?>
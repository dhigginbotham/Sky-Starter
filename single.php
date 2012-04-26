<?php
/**
 * SkyStarter Single Page
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */
get_header(); ?>
  <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">

    <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
      <?php get_template_part( 'loop', 'single' ); ?>
    </div><!-- /#main -->

    <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
      <?php get_sidebar(); ?>
    </aside><!-- /#sidebar -->

  </div><!-- /#content -->
<?php get_footer(); ?>
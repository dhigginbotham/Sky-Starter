<?php
/**
 * SkyStarter Search Template
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */
get_header(); ?>
  <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">    

    <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
      <div class="page-header">
        <h1><?php _e( 'Search Results for', 'skystarter' ); ?> <?php echo get_search_query(); ?></h1>
      </div>
      <?php get_template_part( 'loop', 'search' ); ?>
    </div><!-- / #main -->

    <aside id="sidebar" clas="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
      <?php get_sidebar(); ?>
    </aside><!-- / #sidebar -->
    
  </div><!-- / #content -->
<?php get_footer(); ?>
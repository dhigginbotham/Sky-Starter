<?php
/**
 * SkyStarter 404 Page Template
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */
get_header(); ?>
  <div id="content" class="content <?php echo CONTAINER_CLASSES; ?>">

    <div id="main" class="main <?php echo FULLWIDTH_CLASSES; ?>" role="main">

      <div class="page-header">
        <h1><?php _e( 'File Not Found', 'skystarter' ); ?></h1>
      </div><!-- / .page-header -->

      <div class="alert alert-block fade in">
        <a class="close" data-dismiss="alert">&times;</a>
        <p><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'skystarter' ); ?></p>
      </div><!-- / .alert -->

      <p><?php _e( 'Please try the following:', 'skystarter' ); ?></p>
      
      <ul>
        <li><?php _e( 'Check your spelling', 'skystarter' ); ?></li>
        <li><?php printf( __('Return to the <a href="%s">home page</a>', 'skystarter' ), home_url() ); ?></li>
        <li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'skystarter' ); ?></li>
      </ul>

      <?php get_search_form(); ?>
      
    </div><!-- / #main -->
    
  </div><!-- / #content -->
<?php get_footer(); ?>
<?php
/**
 * Search Form
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */
?>
<form role="search" method="get" id="searchform" class="form-search <?php if ( is_404() || !have_posts()) { ?> well <?php } ?>" action="<?php echo home_url('/'); ?>">
  <label class="visuallyhidden" for="s"><?php _e( 'Search for:', 'skystarter' ); ?></label>
  <input type="text" value="" name="s" id="s" class="search-query" placeholder="<?php _e( 'Search', 'skystarter' ); ?> <?php bloginfo( 'name' ); ?>">
  <input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'skystarter' ); ?>" class="btn">
</form>
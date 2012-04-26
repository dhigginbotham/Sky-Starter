<?php
/**
 * SkyStarter Regular Loop
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */
?>
<?php if ( ! have_posts() ) { // If there are no posts to display, such as an empty archive page  ?>
  <div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">&times;</a>
    <p><?php _e( 'Sorry, no results were found.', 'skystarter' ); ?></p>
  </div>
  <?php get_search_form(); ?>
<?php } ?>

<?php while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php skystarter_entry_meta(); ?>
    </header>

    <div class="entry-content">
      <?php if ( is_archive() || is_search() ) { ?>
        <?php the_excerpt(); ?>
      <?php } else { ?>
        <?php the_content(); ?>
      <?php } ?>
    </div>

    <footer>
      <?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
    </footer>

  </article>
<?php endwhile; ?>

<?php if ( $wp_query->max_num_pages > 1 ) { //Display navigation to next/previous pages when applicable ?>
  <nav id="post-nav" class="pager">
    <div class="previous"><?php next_posts_link( __( '&larr; Older posts', 'skystarter' ) ); ?></div>
    <div class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'skystarter' ) ); ?></div>
  </nav>
<?php } ?>
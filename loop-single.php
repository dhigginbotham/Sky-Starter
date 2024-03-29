<?php
/**
 * SkyStarter Single Page Loop
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */
?>
<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php skystarter_entry_meta(); ?>
    </header>

    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    
    <footer>
      <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'skystarter' ), 'after' => '</p></nav>')); ?>
      <?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
    </footer>

    <?php comments_template(); ?>

  </article>
<?php endwhile; /* End loop */ ?>
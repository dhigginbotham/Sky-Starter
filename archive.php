<?php
/**
 * SkyStarter Archive Template
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */
get_header(); ?>
  <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">

    <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
      <div class="page-header">
        <h1>
          <?php
          $term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
          if ( $term ) {
            echo $term->name;
          } elseif ( is_day() ) {
            printf( __( 'Daily Archives: %s', 'skystarter'), get_the_date() );
          } elseif ( is_month() ) {
            printf( __( 'Monthly Archives: %s', 'skystarter' ), get_the_date( 'F Y' ) );
          } elseif ( is_year() ) {
            printf( __( 'Yearly Archives: %s', 'skystarter' ), get_the_date('Y') );
          } elseif ( is_author() ) {
            global $post;
            $author_id = $post->post_author;
            printf( __( 'Author Archives: %s', 'skystarter' ), get_the_author_meta( 'user_nicename', $author_id ) );
          } else {
            single_cat_title();
          }
          ?>
        </h1>
      </div><!-- / .page-header -->
      <?php get_template_part( 'loop', 'category' ); ?>
    </div><!-- / #main -->
    
    <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
      <?php get_sidebar(); ?>
    </aside><!-- / #sidebar -->
    
  </div><!-- / #content -->
<?php get_footer(); ?>
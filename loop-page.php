<?php
/**
 * SkyStarter Page Loop
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */
?>
<?php while ( have_posts() ) : the_post(); ?>
  
	<div class="page-header">
		<h1><?php the_title(); ?></h1>
	</div><!-- / .page-header -->

	<?php the_content(); ?>
  
<?php endwhile; ?>
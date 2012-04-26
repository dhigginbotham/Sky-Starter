<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <title><?php
  /**
   * Print the <title> tag based on what is being viewed.
   * 
   * @since SkyStarter 1.0
   */
  global $page, $paged;

  wp_title( '' );

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
    echo ' | ' . sprintf( __( 'Page %s', 'skystarter_theme' ), max( $paged, $page ) );

  ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet">

  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">

  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

  <!--[if lt IE 7]><p class="chromeframe">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

  <header id="header-wrap" class="navbar navbar-fixed-top" role="banner">
    <div class="navbar-inner">
      <div class="<?php echo WRAP_CLASSES; ?>">
        <a class="brand" href="<?php echo home_url(); ?>/"><?php bloginfo( 'name' ); ?></a>
        <nav id="nav-main" class="nav-collapse" role="navigation">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav' ) ); ?>
        </nav>
      </div>
    </div>
  </header>

  <div id="content-wrap" role="document">
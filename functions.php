<?php
/**
 * SkyStarter functions and definitions
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */

/**
 * Define Constants
 * 
 * @since SkyStarter 1.0
 */  
define('POST_EXCERPT_LENGTH',           40 );
define('WRAP_CLASSES',         'container' );
define('CONTAINER_CLASSES',          'row' );
define('MAIN_CLASSES',             'span8' );
define('SIDEBAR_CLASSES',          'span4' );
define('FULLWIDTH_CLASSES',       'span12' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override skystarter_setup() in a child theme, add your own skystarter_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since SkyStarter 1.0
 */
if ( ! function_exists( 'skystarter_setup' ) ) :
function skystarter_setup() {

  /** 
   * Make Game Froot available for translation.
   * Translations can be added to the /languages/ directory.
   * If you're building a theme based on Boot Starter, use a find and replace
   * to change 'jacksonwhitelaw' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'skystarter', get_template_directory() . '/languages' );

  $locale = get_locale();
  $locale_file = get_template_directory() . "/languages/$locale.php";
  if ( is_readable( $locale_file ) )
    require_once( $locale_file );

  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style();

  // Add default posts and comments RSS feed links to <head>.
  add_theme_support( 'automatic-feed-links' );

  // Primary Navigation Menu
  register_nav_menus( array(
    'primary' => __( 'Primary Menu',  'skystarter' ),
    'footer'  => __( 'Footer Menu',   'skystarter' ),
  ) );

  // Add support for a variety of post formats
  add_theme_support( 'post-formats', array( 'aside' ) );

  // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
  add_theme_support( 'post-thumbnails' );

  // Add Ajax Functions
  require_once ( locate_template( '/inc/ajax.php' ) );
}
add_action( 'after_setup_theme', 'skystarter_setup' );
endif;

/**
 * Load Scripts and Styles
 * 
 * @since SkyStarter 1.0
 */
function skystarter_theme_scripts_styles() {
  global $post, $wp_scripts;

  $version = '20120417'; // Version number used for caching.

  // jQuery
  wp_enqueue_script( 'jquery' );
  //Hoverintent
  wp_enqueue_script( 'hoverintent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js', 'jquery', $version, true );
  // Custom Plugins
  wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), $version, true );
  // Custom
  wp_enqueue_script( 'skystarter-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), $version, true );

  // Comments
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  // Ajax
  wp_enqueue_script( 'skystarter-ajax', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ), $version );

  // Add ajax url to header
  $ajax_vars = array( 
    'ajaxurl' => admin_url( 'admin-ajax.php' ) 
  );

  wp_localize_script( 'skystarter-ajax', 'gfajax', $ajax_vars );
}
add_action( 'wp_enqueue_scripts', 'skystarter_theme_scripts_styles' );

/**
 * Load Utility & Cleanup Functions
 * 
 * @since SkyStarter 1.0
 */
require_once ( locate_template( '/inc/skystarter-util.php' ) );

/**
 * Register Sidebars
 * 
 * http://codex.wordpress.org/Function_Reference/register_sidebar
 * 
 * @since SkyStarter 1.0
 */ 
function skystarter_register_sidebars() {

  // Define Sidebars
  $sidebars = array( 'Main', 'Blog', 'Footer' );

  foreach( $sidebars as $sidebar ) {
    register_sidebar(
      array(
        'id'            => 'skystarter-' . sanitize_title( $sidebar ),
        'name'          => __( $sidebar, 'skystarter' ),
        'description'   => __( $sidebar, 'skystarter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
      )
    );
  }
}
add_action( 'widgets_init', 'skystarter_register_sidebars' );

/**
 * Blog Post Entry Meta
 * 
 * @since SkyStarter 1.0
 */ 
function skystarter_entry_meta() {
  echo '<time class="updated" datetime="'. get_the_time( 'c' ) .'" pubdate>'. sprintf( __( 'Posted on %s at %s.', 'skystarter'), get_the_date(), get_the_time() ) .'</time>';
  echo '<p class="byline author vcard">'. __( 'Written by', 'skystarter' ) .' <a href="'. get_author_posts_url( get_the_author_meta( 'id' ) ) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
}

/**
 * Remove the URL field from the site.
 * 
 * @since SkyStarter 1.0
 */
function skystarter_remove_url( $arg ) {
  
  $properties = array( array( 'author', __( 'Name', 'skystarter' ) ), array( 'email', __( 'Email', 'skystarter' ) ), array( 'url', __( 'Site', 'skystarter_theme' ) ) );
  
  foreach( $properties as $value ) {
    $key = $value[0];
    $placeholder = $value[1]; 
    $arg[$key] = str_replace("<label", "<label class='assistive-text'", $arg[$key]);
    if (stristr($arg[$key], 'class="required"')) {
      $arg[$key] = str_replace('class="required"', 'class="required assistive-text"', $arg[$key]);
      $placeholder .= " " . __("(required)", "skystarter_theme");
    }
    $arg[$key] = str_replace("<input", "<input placeholder=\"" . $placeholder . "\"", $arg[$key]);
  }
  
  // disable site field in comments
  $arg['url'] = '';

  return $arg;
}
add_filter( 'comment_form_default_fields', 'skystarter_remove_url' );

/**
 * Adjust Comment Form
 * 
 * @since SkyStarter 1.0
 */ 
function skystarter_adjust_comment_form( $arg ) {

  $arg['logged_in_as'] = "";

  $arg['comment_notes_before'] = '';
  $arg['comment_notes_after'] = '';
  
  $arg['comment_field'] = str_replace("<label", "<label class='assistive-text'", $arg['comment_field']);
  $arg['comment_field'] = str_replace("<textarea", "<textarea placeholder=\"" . __("Comment", "skystarter_theme") . "\"", $arg['comment_field']);

  $arg['title_reply'] = "";
  $arg['title_reply_to'] = "";

  return $arg;
}
add_filter( 'comment_form_defaults', 'skystarter_adjust_comment_form' );

/**
 * Primary Navigation Class
 * 
 * @since SkyStarter 1.0
 */ 
function skystarter_primary_nav_class( $classes, $item ){

  $slug = get_the_slug( strtolower( $item->title ) );
  $classes[] = "menu-slug-" . $slug;

  return $classes;
}
add_filter( 'nav_menu_css_class' , 'skystarter_primary_nav_class' , 10 , 2 );

/**
 * Get the slug
 * 
 * @since SkyStarter 1.0
 */ 
if ( ! function_exists( 'get_the_slug' ) ) :
function get_the_slug( $slug ){
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  do_action('after_slug', $slug);
  return $slug;
}
endif;

/**
 * Re-usable RSS feed reader.
 * 
 * @since SkyStarter 1.0
 */
if ( ! function_exists( 'skystarter_get_rss_feeds' ) ) :
/**
 * Base RSS feed reader.
 * 
 * @since SkyStarter 1.0
 */
function skystarter_get_rss_feeds( $size = 5, $feed = array( 'http://wordpress.org/news/feed/' ), $date = false, $current_page = 0, $cache_time = 1800 ) {

  // Include SimplePie RSS parsing engine
  include_once ABSPATH . WPINC . '/feed.php';

  // Set the cache time for SimplePie
  add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', "return $cache_time;" ) );

  // Build the SimplePie object -- You can pass an array as well.
  $rss = fetch_feed( $feed );

  // Check for errors in the RSS XML
  if ( !is_wp_error( $rss ) ) {

    // Set a limit for the number of items to parse
    $maxitems = $rss->get_item_quantity($size);
    $rss_items = $rss->get_items(0, $maxitems);

    // Store the total number of items found in the feed
    $i = 0;
    $total_entries = count($rss_items);

    if ( $current_page == 'home' ) {

      foreach ( $rss_items as $item ) {
        $i++;

        // Add a class of "last" to the last item in the list
        if( $total_entries == $i ) {
          $last = " class='last'";
        } else {
          $last = "";
        }

        // Store the data we need from the feed
        $title = $item->get_title();
        $link = $item->get_permalink();
        $desc = $item->get_description();
        $date_posted = $item->get_date('n/j/y');
        if ( $item_source = $item->get_feed() ) {
          $feed_title = $item_source->get_title();
          $feed_link = $item_source->get_permalink();
        }

        $html .= "<p>$title <em>$date_posted</em> <a class='inline-read-more' href='$link'>Read More</a></p>";
      
      }

    } elseif ( $current_page == 'blog' ) {

      foreach ( $rss_items as $item ) {
        $i++;

        // Add a class of "last" to the last item in the list
        if( $total_entries == $i ) {
          $last = " class='last'";
        } else {
          $last = "";
        }

        // Store the data we need from the feed
        $title = $item->get_title();
        $link = $item->get_permalink();
        $desc = $item->get_description();
        $date_posted = $item->get_date('d M Y');
        if ( $item_source = $item->get_feed() ) {
          $feed_title = $item_source->get_title();
          $feed_link = $item_source->get_permalink();
        }
        
        $html .= "<div id='post-$i' class='post'>";
          $html .= "<h2 class='post-title'><a href='$link'><strong>$title</strong></a></h2>";
          $html .= "<p class='post-meta'><a href='$feed_link/'>$feed_title</a> | $date_posted</p>";
          $html .= "<div class='post-content'>";
            $html .= $desc;
            $html .= "<a class='read-more' href='$link'>Read More &rarr;</a>";
          $html .= "</div>";
        $html .= "</div>";
      
      }

    } else {

      // Output HTML
      $html = "<ul class='feedlist'>";

      foreach ( $rss_items as $item ) {
        $i++;

        // Add a class of "last" to the last item in the list
        if( $total_entries == $i ) {
          $last = " class='last'";
        } else {
          $last = "";
        }

        // Store the data we need from the feed
        $title = $item->get_title();
        $link = $item->get_permalink();
        $desc = $item->get_description();
        $date_posted = $item->get_date('d M Y');
        if ( $item_source = $item->get_feed() ) {
          $feed_title = $item_source->get_title();
          $feed_link = $item_source->get_permalink();
        }
  
        $html .= "<li id='post-$i' $last>";
          $html .= "<p><a href='$link'><strong>$title</strong></a></p>";
          $html .= "<p><a href='$feed_link/'>$feed_title</a> | $date_posted</p>";
        $html .= "</li>";
      
      }
      $html .= "</ul>";
    }

  } else {

    $html = "An error occurred while parsing your RSS feed. Check that it's a valid XML file.";

  }

  return $html;
}
endif;
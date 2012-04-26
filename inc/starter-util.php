<?php
/**
 * SkyStarter Utility & Cleanup Function
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */

/**
 * Search Redirect
 * 
 * @since SkyStarter 1.0
 */
function skystarter_nice_search_redirect() {
  if ( is_search() && strpos( $_SERVER['REQUEST_URI'], '/wp-admin/' ) === false && strpos( $_SERVER['REQUEST_URI'], '/search/' ) === false ) {
    wp_redirect( home_url( '/search/' . str_replace( array( ' ', '%20' ), array( '+', '+' ), urlencode( get_query_var( 's' ) ) ) ), 301 );
      exit();
  }
}
add_action( 'template_redirect', 'skystarter_nice_search_redirect' );

/**
 * Search Query
 * 
 * @since SkyStarter 1.0
 */
function skystarter_search_query( $escaped = true ) {
  $query = apply_filters( 'skystarter_search_query', get_query_var( 's' ) );
  if ( $escaped ) {
      $query = esc_attr( $query );
  }
  return urldecode( $query );
}
add_filter( 'get_search_query', 'skystarter_search_query' );

/**
 * Fix for empty search query
 * 
 * http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * 
 * @since SkyStarter 1.0
 */
function skystarter_request_filter( $query_vars ) {
  if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
    $query_vars['s'] = " ";
  }
  return $query_vars;
}
add_filter( 'request', 'skystarter_request_filter' );

/**
 * Remove WordPress version from RSS feed
 * 
 * @since SkyStarter 1.0
 */
function skystarter_no_generator() { 
  return ''; 
}
add_filter( 'the_generator', 'skystarter_no_generator' );

/**
 * Remove CSS from recent comments widget
 * 
 * @since SkyStarter 1.0
 */
function skystarter_remove_recent_comments_style() {
  global $wp_widget_factory;
  if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
  }
}

/**
 * Remove CSS from gallery
 * 
 * @since SkyStarter 1.0
 */
function skystarter_gallery_style( $css ) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

/**
 * Head Cleanup 
 * 
 * @since SkyStarter 1.0
 */
function skystarter_head_cleanup() {
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  remove_action('wp_head', 'noindex', 1);
  add_action('wp_head', 'skystarter_remove_recent_comments_style', 1);
  add_filter('gallery_style', 'skystarter_gallery_style');
}
add_action( 'init', 'skystarter_head_cleanup' );

/**
 * Attachment Link Class
 * 
 * @since SkyStarter 1.0
 */
function skystarter_attachment_link_class( $html ) {
  $postid = get_the_ID();
  $html = str_replace('<a', '<a class="thumbnail"', $html);
  return $html;
}
add_filter( 'wp_get_attachment_link', 'skystarter_attachment_link_class', 10, 1 );

/**
 * Caption
 * 
 * http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 * 
 * @since SkyStarter 1.0
 */
function skystarter_caption( $output, $attr, $content ) {
  /* We're not worried abut captions in feeds, so just return the output here. */
  if ( is_feed()) {
    return $output;
  }

  /* Set up the default arguments. */
  $defaults = array(
    'id' => '',
    'align' => 'alignnone',
    'width' => '',
    'caption' => ''
  );

  /* Merge the defaults with user input. */
  $attr = shortcode_atts($defaults, $attr);

  /* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
  if (1 > $attr['width'] || empty($attr['caption'])) {
    return $content;
  }

  /* Set up the attributes for the caption <div>. */
  $attributes = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '' );
  $attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
  $attributes .= ' style="width: ' . esc_attr($attr['width']) . 'px"';

  /* Open the caption <div>. */
  $output = '<div' . $attributes .'>';

  /* Allow shortcodes for the content the caption was created for. */
  $output .= do_shortcode($content);

  /* Append the caption text. */
  $output .= '<div class="caption"><p class="wp-caption-text">' . $attr['caption'] . '</p></div>';

  /* Close the caption </div>. */
  $output .= '</div>';

  /* Return the formatted, clean caption. */
  return $output;
}
add_filter( 'img_caption_shortcode', 'skystarter_caption', 10, 3 );

/**
 * Remove Dashboard Widgets
 * 
 * http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 * 
 * @since SkyStarter 1.0
 */
function skystarter_remove_dashboard_widgets() {
  remove_meta_box( 'dashboard_incoming_links',  'dashboard', 'normal' );
  remove_meta_box( 'dashboard_plugins',         'dashboard', 'normal' );
  remove_meta_box( 'dashboard_primary',         'dashboard', 'normal' );
  remove_meta_box( 'dashboard_secondary',       'dashboard', 'normal' );
}
add_action( 'admin_init', 'skystarter_remove_dashboard_widgets' );

/**
 * Excerpt length
 * 
 * @since SkyStarter 1.0
 */
function skystarter_excerpt_length($length) {
  return 20;
}
add_filter('excerpt_length', 'skystarter_excerpt_length');

/**
 * Excerpt More
 * 
 * @since SkyStarter 1.0
 */
function skystarter_excerpt_more( $more ) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued', 'skystarter' ) . '</a>';
}
add_filter( 'excerpt_more', 'skystarter_excerpt_more' );

/**
 * HTML 5 cleanup
 * 
 * We don't need to self-close these tags in html5:
 * <img>, <input>
 * 
 * @since SkyStarter 1.0
 */
function skystarter_remove_self_closing_tags($input) {
  return str_replace(' />', '>', $input);
}
add_filter('get_avatar', 'skystarter_remove_self_closing_tags');
add_filter('comment_id_fields', 'skystarter_remove_self_closing_tags');
add_filter('post_thumbnail_html', 'skystarter_remove_self_closing_tags');

/**
 * Post Revisions
 * 
 * Set the post revisions to 5 unless the constant was set in wp-config.php to avoid DB bloat
 * 
 * @since SkyStarter 1.0
 */
if ( ! defined( 'WP_POST_REVISIONS' ) ) { 
  define( 'WP_POST_REVISIONS', 5 ); 
}

/**
 * Allow more tags in TinyMCE including <iframe> and <script>
 * 
 * @since SkyStarter 1.0
 */
function skystarter_change_mce_options( $options ) {
  $ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src],script[charset|defer|language|src|type]';
  if (isset($initArray['extended_valid_elements'])) {
    $options['extended_valid_elements'] .= ',' . $ext;
  } else {
    $options['extended_valid_elements'] = $ext;
  }
  return $options;
}
add_filter( 'tiny_mce_before_init', 'skystarter_change_mce_options' );
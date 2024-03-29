<?php
/**
 * SkyStarter Comments
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */

/**
 * Comments
 * 
 * @since SkyStarter 1.0
 */ 
function skystarter_comment( $comment, $args, $depth ) { ?>
  <?php $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?>>
    <article id="comment-<?php comment_ID(); ?>">
      <header class="comment-author vcard">
        <?php echo get_avatar($comment, $size = '32'); ?>
        <?php printf(__('<cite class="fn">%s</cite>', 'skystarter'), get_comment_author_link()); ?>
        <time datetime="<?php echo comment_date('c'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s', 'skystarter'), get_comment_date(),  get_comment_time()); ?></a></time>
        <?php edit_comment_link(__('(Edit)', 'skystarter'), '', ''); ?>
      </header>

      <?php if ($comment->comment_approved == '0') { ?>
        <div class="alert alert-block fade in">
          <a class="close" data-dismiss="alert">&times;</a>
          <p><?php _e('Your comment is awaiting moderation.', 'skystarter'); ?></p>
        </div>
      <?php } ?>

      <section class="comment">
        <?php comment_text() ?>
      </section>

      <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

    </article>
<?php } // Comments Function ?>

<?php if ( post_password_required() ) { ?>
  <section id="comments">
    <div class="alert alert-block fade in">
      <a class="close" data-dismiss="alert">&times;</a>
      <p><?php _e('This post is password protected. Enter the password to view comments.', 'skystarter'); ?></p>
    </div>
  </section><!-- /#comments -->
  <?php return; ?>
<?php } // If password is required ?>

<?php if ( have_comments() ) { ?>
  <section id="comments">
    <h3>
      <?php printf( _n( 'One Response to &ldquo;%2$s&rdquo;', '%1$s Responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'skystarter' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
    </h3>

    <ol class="commentlist">
      <?php wp_list_comments( array( 'callback' => 'skystarter_comment' ) ); ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
      <nav id="comments-nav" class="pager">
        <div class="previous"><?php previous_comments_link( __('&larr; Older comments', 'skystarter') ); ?></div>
        <div class="next"><?php next_comments_link( __('Newer comments &rarr;', 'skystarter') ); ?></div>
      </nav>
    <?php } // check for comment navigation ?>

    <?php if ( !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments') ) { ?>
      <div class="alert alert-block fade in">
        <a class="close" data-dismiss="alert">&times;</a>
        <p><?php _e('Comments are closed.', 'skystarter'); ?></p>
      </div>
    <?php } ?>
  </section><!-- /#comments -->
<?php } // There are Comments?>

<?php if ( ! have_comments() && ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
  <section id="comments">
    <div class="alert alert-block fade in">
      <a class="close" data-dismiss="alert">&times;</a>
      <p><?php _e( 'Comments are closed.', 'skystarter' ); ?></p>
    </div>
  </section><!-- /#comments -->
<?php } // Comments are closed ?>

<?php if ( comments_open() ) { ?>
  <section id="respond">
    <h3><?php comment_form_title( __('Leave a Reply', 'skystarter' ), __( 'Leave a Reply to %s', 'skystarter' ) ); ?></h3>
    <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
    <?php if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>
      <p><?php printf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'skystarter' ), wp_login_url(get_permalink() ) ); ?></p>
    <?php } else { ?>
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <?php if ( is_user_logged_in() ) { ?>
          <p><?php printf( __( 'Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'skystarter' ), get_option('siteurl'), $user_identity ); ?> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php __( 'Log out of this account', 'skystarter' ); ?>"><?php _e( 'Log out &raquo;', 'skystarter' ); ?></a></p>
        <?php } else { ?>
          <label for="author"><?php _e( 'Name', 'skystarter' ); if ( $req ) _e( ' (required)', 'skystarter' ); ?></label>
          <input type="text" class="text" name="author" id="author" value="<?php echo esc_attr( $comment_author ); ?>" size="22" tabindex="1" <?php if ( $req ) echo "aria-required='true'"; ?>>
          <label for="email"><?php _e( 'Email (will not be published)', 'skystarter' ); if ($req) _e(' (required)', 'skystarter' ); ?></label>
          <input type="email" class="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>>
          <label for="url"><?php _e( 'Website', 'skystarter' ); ?></label>
          <input type="url" class="text" name="url" id="url" value="<?php echo esc_attr( $comment_author_url ); ?>" size="22" tabindex="3">
        <?php } ?>
        <label for="comment"><?php _e( 'Comment', 'skystarter' ); ?></label>
        <textarea name="comment" id="comment" class="input-xlarge" tabindex="4"></textarea>
        <input name="submit" class="btn btn-primary" type="submit" id="submit" tabindex="5" value="<?php _e( 'Submit Comment', 'skystarter' ); ?>">
        <?php comment_id_fields(); ?>
        <?php do_action( 'comment_form', $post->ID ); ?>
      </form>
    <?php } // if registration required and not logged in ?>
  </section><!-- /#respond -->
<?php } // Comments are open ?>
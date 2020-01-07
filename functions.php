<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('MEETUP__POST_CATEGORY_ID', 57);

function new_excerpt_length($len) {
  return 55;
}

add_filter('excerpt_length','new_excerpt_length');


/* Include custom fields for posts (like subtitle und so) */
include 'custom-fields.php';


/* Remove width/height attribute */
function kite_remove_image_size_attr( $html ) {
  $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
  return $html;
}
add_filter( 'post_thumbnail_html', 'kite_remove_image_size_attr', 10 );
add_filter( 'image_send_to_editor', 'kite_remove_image_size_attr', 10 );

/**
 * Add custom image sizes
 */
add_theme_support( 'post-thumbnails' );

/**
 * Add js scripts & jquery
 */
wp_enqueue_script('theme-scripts', get_template_directory_uri() .'/js/blog`.js', array('jquery'), null, true);

/* https://wordpress.stackexchange.com/questions/78833/knowing-the-total-number-of-posts-before-to-get-into-the-loop */
function wpse8170_get_posts_count() {
  global $wp_query;
  return $wp_query->post_count;
}

function post_fetured_image_json( $data, $post, $context ) {
  $featured_image_id = $data->data['featured_media']; // get featured image id
  $featured_image_url = wp_get_attachment_image_src( $featured_image_id, 'original' ); // get url of the original size
  if( $featured_image_url ) {
    $data->data['featured_image_url'] = $featured_image_url[0];
  }

    
  return $data;
}
add_filter( 'rest_prepare_post', 'post_fetured_image_json', 10, 3 );

function post_tags_json( $data, $post, $context ) {
  $tags = $data->data['tags']; // get featured image id
  $ret = array();
  foreach ($tags as $key => $tag) {
    $ret[] = get_tag($tag);
  }
  $data->data['tags_full'] = $ret;

  return $data;
}
add_filter( 'rest_prepare_post', 'post_tags_json', 10, 3 );


/* */

function your_prefix_get_meta_box( $meta_boxes ) {
  $prefix = 'session-';

  $meta_boxes[] = array(
    'id' => 'session-info',
    'title' => esc_html__( 'Session info', 'metabox-online-generator' ),
    'post_types' => array( 'post', 'page' ),
    'context' => 'advanced',
    'priority' => 'default',
    'autosave' => false,
    'fields' => array(
      array(
        'id' => $prefix . 'author',
        'type' => 'text',
        'name' => esc_html__( 'Author', 'metabox-online-generator' ),
      ),
      array(
        'id' => $prefix . 'url',
        'type' => 'text',
        'name' => esc_html__( 'URL', 'metabox-online-generator' ),
      ),
      array(
        'id' => $prefix . 'area',
        'type' => 'text',
        'name' => esc_html__( 'Area', 'metabox-online-generator' ),
      ),
      array(
        'id' => $prefix . 'date',
        'type' => 'date',
        'name' => esc_html__( 'Date', 'metabox-online-generator' ),
      ),
      array(
        'id' => $prefix . 'time',
        'type' => 'text',
        'name' => esc_html__( 'Starting time (hh:mm)', 'metabox-online-generator' ),
      ),
      array(
        'id' => $prefix . 'duration',
        'type' => 'text',
        'name' => esc_html__( 'Duration in minutes', 'metabox-online-generator' ),
      )
    ),
  );

  return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'your_prefix_get_meta_box' );


# Add a shortcode to every post or page
# https://wp-buddy.com/blog/add-a-shortcode-to-every-post-or-page/
function my_shortcode_to_a_post( $content ) {
  global $post;
  if( ! $post instanceof WP_Post ) return $content;

  switch( $post->post_type ) {
    case 'post':
      return $content;
      // return $content . '[fts_twitter twitter_name=blockbar070 tweets_count=3 cover_photo=no stats_bar=no show_retweets=yes show_replies=no]';
    case 'page':
      return $content;
      // return $content . '[fts_twitter twitter_name=blockbar070 tweets_count=3 cover_photo=no stats_bar=no show_retweets=yes show_replies=no]';
    default:
      return $content;
  }
}

add_filter( 'the_content', 'my_shortcode_to_a_post' );

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      // 'extra-menu' => __( 'Extra Menu' )
     )
   );
 }
 add_action( 'init', 'register_my_menus' );

/*
  If Meetup post is saved -> sync to meetup.com
*/
function meetupDataIsValid($data) {
  return true;
}

function addMeetupEvent($data) {
  return;
}

function updateMeetupEvent($data) {
  return;
}

function save_post_handler($post_id) {
  global $post;

  // If post content is empty -> do nothing
  if(strlen($post->post_content) <= 0) {
    return;
  }

  // Check if this post should be on Meetup
  $post_categories = wp_get_post_categories($post_id);
  $doUpdateMeetup = in_array(MEETUP__POST_CATEGORY_ID, $post_categories);

  // Stop if we don't have to do anything with meetup
  if(! $doUpdateMeetup) {
    return;
  }

  // Stop if post data is incomplete
  if(! meetupDataIsValid($post) ) {
    return;
  }

  // Check if this is a new Meetup
  if( strlen(get_post_meta($post_id, 'session-url') ) <= 5) {
    // If so: Post new update with this posts's data
    addMeetupEvent($post);
  }

  // Or update if this is an existing meetup
  else if( strpos(get_post_meta($post_id, 'session-url'), 'https://www.meetup.com/blockbar/events/') > -1 ) {
    updateMeetupEvent($post);
  }

  // Update session URL
  update_post_meta($post_id, 'session-url', 'This will be the Meetup URI 2');
}
// add_action('save_post', 'save_post_handler');

// Multiple category pages have custom order
// https://wordpress.stackexchange.com/a/55538
function wpa55535_pre_get_posts( $query ){
  // if this is a category page
  if( $query->is_category ):
      // if cat = 53 (blog), set order to DESC
      if( $query->query_vars['category_name'] == 'blog' ):
          $query->set( 'order', 'DESC' );
      // if cat = 4, set order to ASC
      elseif( $query->query_vars['category_name'] == 'events' ):
          $meta_query = [];
          $meta_query[] = array('key' => 'session-date', 'value' => date('Y-m-d', strtotime('now')), 'compare' => '>=');
          $query->set('orderby', 'session-date');
          $query->set('order', 'ASC');
          $query->set('meta_query', $meta_query);
      endif;
  endif;
  return $query;
}
add_action( 'pre_get_posts', 'wpa55535_pre_get_posts' );
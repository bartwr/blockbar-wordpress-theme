<?php
$isIndex = $_SERVER['REQUEST_URI'] == '/';

get_header();
?>

<?php
get_template_part( 'content', get_post_format() );
?>

<div class="posts-overview">
<?php
if(is_front_page()):
  $args = array(
    'post_status' => 'publish',
    'cat' => 4,
    'showposts' => 2,
    'order', 'ASC',
    'orderby', 'session-date',
    'meta_query'=> array(
      'sdate' => array(
        'key' => 'session-date',
        'compare' => '>=',
        'value' => date('Y-m-d', strtotime('now'))
      )
    ),
    'orderby' => array(
      'sdate' => 'ASC'
    )
  );
  query_posts($args); while (have_posts()) : the_post();
  $session_date = get_post_meta(get_the_ID(), 'session-date', true);
  ?>
    <div class="post">

      <a href="<?php the_permalink(); ?>" class="post-header" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>');"></a>

      <div class="post-body">
        <div class="the-post-meta">
          <span class="the-post-meta-category">
            <?php wp_title('') ?>
          </span>
          <span class="the-post-meta-date">
            <?php
            echo ($session_date ? date(get_option('date_format'), strtotime($session_date)) : get_the_date());
            ?>
          </span>
        </div>
        <h1 class="the-post-title">
          <a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>" class="post-title" data-id="<?php the_id(); ?>">
            <?php the_title(); ?>
          </a>
        </h1>
      </div>
    </div>
  <?php
  endwhile;
  wp_reset_query();
endif;
?>
</div>

<?php include 'footer.php'; ?>

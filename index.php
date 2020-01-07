<?php
$isIndex = $_SERVER['REQUEST_URI'] == '/';

get_header();
?>

<!-- <p>
  Do you work on a blockchain/distributed/crypto project? <a href="https://www.meetup.com/blockbar/events/nzwqxpyxkbrb/" target="_blank">Join Blockbar</a>, the <b>blockchain cowork</b> space in <b>The Hague</b>.
</p>

<p>
  At Blockbar you can work on blockchain projects, develop ideas & get to know other people in the scene.
</p>

<p>
  Be welcome to join at Blockbar at <a href="https://www.thehaguetech.nl/" target="_blank">The Hague Tech</a>. Every Friday, from 10am. <a href="https://www.meetup.com/blockbar/" target="_blank">RSVP on Meetup</a>.
</p>

&nbsp;
 -->

<?php
get_template_part( 'content', get_post_format() );
?>

<div class="posts-overview">
<?php
if(is_front_page()):
  query_posts('cat=4&showposts=2'); while (have_posts()) : the_post();
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
            $session_date = get_post_meta(get_the_ID(), 'session-date', true);
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

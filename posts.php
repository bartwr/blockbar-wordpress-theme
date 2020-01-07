<div class="posts-overview">
  <?php
  while ( have_posts() ) : the_post(); // standard WordPress loop. ?>
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
  <?php endwhile; ?>

</div>


<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<?php

if (have_posts()) {
  if(wpse8170_get_posts_count() <= 1) {
    include 'post.php';
  } else {
    ?>
    <div style="margin: 40px auto;max-width:100%;width: 600px">
      <?php echo get_post_field('post_content'); ?>
    </div>
    <?php
    include 'posts.php';
  }
} else {
  echo 'No posts.';
}

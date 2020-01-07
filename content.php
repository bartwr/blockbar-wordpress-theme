<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (have_posts()) {
  if(wpse8170_get_posts_count() <= 1) {
    include 'post.php';
  } else {
    include 'posts.php';
  }
} else {
  echo 'No posts.';
}

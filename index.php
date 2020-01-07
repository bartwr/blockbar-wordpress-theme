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

<?php get_template_part( 'content', get_post_format() ); ?>

<h2 style="width: 360px;">Latest <a href="https://twitter.com/blockbar070" target="_blank">tweets</a></h2>

<?php
echo do_shortcode('[fts_twitter twitter_name=blockbar070 tweets_count=2 cover_photo=no stats_bar=yes show_retweets=no show_replies=no search=%23blockbar%20OR%20%23biw070%20OR%20%40blockbar070%20OR%20%40the_hague_tech]');
?>

<style type="text/css">
  
.Index-community-posts {
  width: 200px;
  max-width: 100%;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}
.Index-community-post {
  width: 280px;
  max-width: 100%;
  margin: 8px;
}
.Index-title {
  display: block;
  font-weight: bold;
  font-size: 20px;
  margin: 10px 0 20px;
}
img.img-responsive.responsive--full {
  width: 100%;
  margin: 0 auto;
}

</style>

<?php include 'footer.php'; ?>

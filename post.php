<?php while (have_posts()) : the_post();

  $session_url = get_post_meta(get_the_ID(), 'session-url', true)
  ?>
  
  <?php if(is_page()) { ?>

    <h1 class="the-post-title">
      <?php the_title(); ?>
    </h1>

    <?php the_content(__('(lees meer...)')); ?>

  <?php } else { ?>

    <div class="the-post">

      <div class="the-post-content">
        <div class="the-post-content-body">

          <style>
          .the-post-info {
            margin: 0 auto;
            display: block;
            width: 400px;
          }
          .the-post-notice {
            margin: 20px 0;
            background: #eee;
            padding: 15px;
            border-radius: 10px;
          }
          .the-post-notice > p {
            margin: 0;
          }
          .the-post-notice a {
            font-weight: bold;
            color: #000;
          }
          </style>

          <?php if(get_post_meta(get_the_ID(), 'session-url', true)): ?>
            <div class="the-post-info" style="display: none">
              <div class="the-post-notice">
                <p>
                  This is a community post. Community posts are articles shared by people who are regular guests at <a href="/" style="font-weight: normal;">Blockbar The Hague</a>.
                </p>
                <br />
                <p>
                  Source of this post:
                  <a href="<?php echo get_post_meta(get_the_ID(), 'session-url', true) ?>" target="_blank">
                    <?php echo get_post_meta(get_the_ID(), 'session-author', true) ?></a>.
                </p>
              </div>
            </div>
          <?php endif; ?>

          <h1 class="the-post-title">
            <?php the_title(); ?>
          </h1>

          <div class="the-post-meta">
            <?php the_date( 'F j, Y', '', '', true );
            echo ' | ';
            $post_categories = wp_get_post_categories( get_the_ID() );
            $cats = array();

            $catsString = '';
            foreach($post_categories as $c){
                $cat = get_category( $c );
                // var_dump($cat);
                $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                $catsString = $catsString . ( $catsString != '' ? ', ' : '') . $cat->name;
            }
            echo $catsString;
            ?>
          </div>

          <div class="post-header" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>

          <?php if($session_url): ?>
          <div class="the-post-meta">
            <div class="the-post-rsvp-button-container button-container-1">
              <span class="mas">Please RSVP on meetup</span>
              <a href="<?php echo $session_url; ?>" target="_blank" class="the-post-rsvp-button">
                <span>Please RSVP on meetup</span>
              </a>
            </div>
          </div>
          <?php endif; ?>

          <?php the_content(__('(lees meer...)')); ?>

        </div>
      </div>
    </div>
    <?php } ?>

  <?php endwhile; ?>

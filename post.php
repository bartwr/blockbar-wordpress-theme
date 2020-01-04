<?php while (have_posts()) : the_post(); ?>
  
  <?php if(is_page()) { ?>

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
            <div class="the-post-info">
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

          <h1 class="the-post-title"><?php the_title(); ?></h1>

          <p class="the-post-meta">
            <?php the_date( 'F j, Y', 'Date: ', '', true );
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

          </p>

          <?php the_content(__('(lees meer...)')); ?>
        </div>
      </div>        
    <?php } ?>

  <?php endwhile; ?>

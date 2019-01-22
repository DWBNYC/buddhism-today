<?php

get_header(); ?>

  <div class="site-content clearfix">
    
    <!-- main-column -->
    <div class="main-column">



<?php
if (have_posts()) : ?>

  <p class="search_title">Search results for: <strong><?php the_search_query(); ?></strong></p>

  <?php
      while (have_posts()) : the_post(); ?>



<?php
        static $count = 0;
        if (($count % 2) == 0) { ?>

          <ul class="small-columns">
            
            <li class="left-column"><!-- post-item -->    
              <?php get_template_part ('hpcontenthalf', get_post_format()); ?>       
            </li><!-- /post-item --> 

            <?php } else  { ?>

              <li class="right-column">
                <?php get_template_part ('hpcontenthalf', get_post_format()); ?>
              </li>
           </ul>   <!-- box preview -->
              <?php }
                $count++; 


      endwhile;

      else:

        echo '<p>No content found</p>';

      endif; ?>


      </div><!-- main-column -->

    <?php get_sidebar(); ?>
    
  </div><!-- /site-content -->

<?php get_footer();

?>
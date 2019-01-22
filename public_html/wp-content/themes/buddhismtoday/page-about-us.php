<?php

get_header(); ?>
  
  <!-- site-content -->
  <div class="site-content clearfix">
    
    <!-- main-column -->
    <div class="main-column">

      <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>

        <h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h2>

        <div class="main-text">

        <?php the_content(); ?>
        </div>
        
        <?php
        endwhile;

        else :
          echo '<p>No content found</p>';

        endif;
        ?>

    </div><!-- main-column -->



    <?php get_sidebar(); ?>
    
  </div><!-- /site-content -->
  
  <?php get_footer();

?>
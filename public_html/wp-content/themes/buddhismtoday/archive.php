<?php

get_header(); ?>

  <!-- site-content -->
  <div class="site-content clearfix">
    
    <!-- main-column -->
    <div class="main-column">

      <?php

if (have_posts()) :
  ?>

  <h2><?php 

  if ( is_category() ) {
    single_cat_title();
  } elseif ( is_tag() ) {
    single_tag_title();
  } elseif ( is_author() ) {
    the_post();
    /*  echo 'Author Archives: ' . get_the_author(); */
    rewind_posts();
  } elseif ( is_day() ) {
    echo 'Day Archive: ' . get_the_date();
  } elseif ( is_month() ) {
    echo 'Month: ' . get_the_date('F Y');
  } else if ( is_year() ) {
    echo 'Year: ' . get_the_date('Y');
  } else {
    echo 'Archives';
  }



  ?></h2>

  <?php


/* author preview */
    foreach( get_coauthors() as $coauthor ) : ?>
      <div class="author-bio-about">
        <div class="bio-img-about">
            <?php echo get_the_post_thumbnail($coauthor->ID, 'bio-thumbnail'); ?>
        </div>
        <div class="bio-text-about">
            <h2><?php _e('', 'contempo'); ?> <a href="<?php echo $coauthor->user_url; ?>"><?php coauthors_posts_links(); ?></h2></a>
            <p><?php echo $coauthor->description; ?></p></div>
            <div class="clear"></div>
        </div> 
    <?php endforeach; ?>

    <p class="online-articles">Featured Articles</p>

<!-- get_template_part('content', get_post_format()); -->

  <!-- box preview -->
 <?php
  while (have_posts()) : the_post();
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

  endif;
  ?>

    </div><!-- main-column -->



    <?php get_sidebar(); ?>
    
  </div><!-- /site-content -->

<?php get_footer();

?>
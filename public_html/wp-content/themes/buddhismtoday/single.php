<?php

get_header(); ?>
  
  <!-- site-content -->
  <div class="site-content clearfix">
    
    <!-- main-column -->
    <div class="main-column">

  <?php if (have_posts()) :
  while (have_posts()) : the_post(); 


get_template_part('content', get_post_format());

  endwhile;


  else:
    echo '<p>No content found</p>';

  endif;
  ?>

  <?php foreach( get_coauthors() as $coauthor ) : ?>
<div class="author-bio">
<div class="bio-img">
    <?php echo get_the_post_thumbnail($coauthor->ID, 'bio-thumbnail'); ?></div>
   <div class="bio-text"><b><?php _e('About', 'contempo'); ?> <a href="<?php echo $coauthor->user_url; ?>"><?php coauthors_posts_links(); ?></b></a>
    <p><?php echo $coauthor->description; ?></p></div>
        <div class="clear"></div>
</div>
<?php endforeach; ?>

           <!-- <a href="https://checkout.subscriptiongenius.com/buddhism-today.org/"><span class="buy_button" onClick="ga('send', 'event', { eventCategory: 'Subscribe', eventAction: 'click', eventLabel: 'link article', eventValue: 1});">Subscribe</span></a>-->
        
    </div><!-- main-column -->



    <?php get_sidebar(); ?>
    
  </div><!-- /site-content -->

<? get_footer();

?>
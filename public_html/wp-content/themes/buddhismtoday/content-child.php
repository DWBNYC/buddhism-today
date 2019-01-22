<article class="post <?php if ( has_post_thumbnail() ) { ?>post-item <?php } ?>">
    
  <?php 

    if ( $post->post_parent == '142' ) { ?>

      <div class="teacher-image"><?php the_post_thumbnail('square-thumbnail'); ?></div>
      <h1><?php the_title(); ?></h1>
      <?php the_content();

  } else { ?>

 <div class="issue-content">     
<!-- post-thumbnail -->

    <div class="child-item">

      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('square-thumbnail'); ?></a>

<!-- Buy Button-->

<a href="https://checkout.subscriptiongenius.com/buddhism-today.org/"><span class="buy_button">Subscribe</span></a>

<!--
<?php

  $link = get_post_meta($post->ID, 'cart_link', true);

  if ($link) { 
?>
    
      <a href="<?php echo $link; ?>"><span class="buy_button">Subscribe</span></a>
    
<?php } 
  else { ?>
    <div class="buy_button_sold">Sold Out</div>
<?php } ?>
-->
<!-- Buy Button-->

    </div><!-- /post-thumbnail -->


    
    <div class="child-item-text">
    <?php

      $issue = get_the_terms( $page->ID , 'issue' );
  
        foreach ( $issue as $term ) { ?>
          <p class="child-title">
          <b>Issue <?php echo $term->name; ?></b><br>

       <?php }

    ?>
    <?php the_title(); ?>
      
    </p>  

    <?php ?>

<?php if (is_search() OR is_archive() ) { ?>
    <p>
    <?php echo get_the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>">Read more&raquo;</a>
    </p>

<?php } else {
  if ($post->post_excerpt) { ?>

    <p>
    <?php echo get_the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>">Read more&raquo;</a>
    </p>

<?php } else {

    the_content();

    } 

  } ?>

</div>
</div>





<?php

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'issue',
            'field' => 'slug',
            'terms' => $term->name
            )));

$the_query = new WP_Query( $args ); ?>


<?php
if ( $the_query->have_posts() ) { ?>
<p class="online-articles">Featured Articles</p>

<?php }
?>


<?php
if ( $the_query->have_posts() ):
while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
   

<?php 

  static $count = 0;
  if (($count % 2) == 0) { ?>

<div class="small-columns">
    <div class="left-column"><!-- post-item -->
            
      <?php get_template_part ('hpcontenthalf'); ?>
         
    </div><!-- /post-item --> 

  <?php } else  { ?>

    <div class="right-column">
      <?php get_template_part ('hpcontenthalf'); ?>
    </div>
 </div>   
    <?php }
      $count++; ?>

<?php endwhile; ?>
    
<?php endif;
?>

<?php } ?>


</article>
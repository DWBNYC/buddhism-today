<article class="post <?php if ( has_post_thumbnail() ) { ?>post-item <?php } ?>">
    
   
  <h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h2>
  
<div class="article-info">
  <p class="post-info">by <?php coauthors_posts_links(); ?></a> | 
      
    <!-- issue number -->
    <?php
                $issue = get_the_terms( $post->ID , 'issue' );
                if (isset($issue) && (is_array($issue) || is_object($issue))) { foreach ( $issue as $term ) {  }} /* CodePinch AI Fix */

    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'child_of'       => 95,
        'order'          => 'ASC',
        'orderby'        => 'menu_order',
        'tax_query' => array(
            array(
                'taxonomy' => 'issue',
                'field' => 'slug',
                'terms' => $term->name
                ))
     );

    $parent = new WP_Query( $args );

    if ( $parent->have_posts() ) : 

        while ( $parent->have_posts() ) : $parent->the_post(); 
      ?>
     
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  Issue <?php echo $term->name; ?>
                </a>
               
        <?php endwhile; ?>
    <?php endif; wp_reset_query(); ?>
    <!-- issue number -->
    </p>
        
    <p class="social-icons">
    
    <a href="javascript:window.print()" rel="nofollow" class="iconshare icon-monoshare print" title="Print It!">Print This!</a>
   
    <a href="mailto:?subject=<?php the_title();?>&amp;body=Check this article from Buddhism Today: <?php the_permalink() ?>" class="iconshare icon-monoshare email" title="Send this article to a friend!">Email this</a>
    
    <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&t=<?php the_title(); ?>" class="iconshare icon-monoshare pinterest" title="Share on Pinterest">Pinterest</a>
    
    <a href="https://plus.google.com/share?url=<?php the_permalink();?>&t=<?php the_title(); ?>" class="iconshare icon-monoshare googleplus" title="Share on Google Plus"> Google Plus</a>
    
    <a href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink();?>" class="iconshare icon-monoshare twitter" title="Share on Twitter" onClick="ga('send', 'event', { eventCategory: 'Social', eventAction: 'share', eventLabel: 'Twitter', eventValue: 1});"> Twitter</a>
   
    <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" target="blank" class="iconshare icon-monoshare facebook" title="Share on Facebook" onClick="ga('send', 'event', { eventCategory: 'Social', eventAction: 'share', eventLabel: 'Facebook', eventValue: 1});"> Facebook</a>
  
    </p> 
</div>





    <!-- post-thumbnail -->
    <div class="post-item">
      <a href="<?php the_permalink(); ?>" class="article-img"><?php the_post_thumbnail('featured-image'); ?></a>
    </div>
    <!-- /post-thumbnail -->

<!-- archive view -->
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

<?php } else { ?>
<!-- archive view -->

<!-- /Box with an Issue Cover -->
<div class = "box-issue">

<?php

$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => 95,
    'order'          => 'ASC',
    'orderby'        => 'menu_order',
    'tax_query' => array(
        array(
            'taxonomy' => 'issue',
            'field' => 'slug',
            'terms' => $term->name
            ))
 );

$parent = new WP_Query( $args );

if ( $parent->have_posts() ) : 
  while ( $parent->have_posts() ) : $parent->the_post(); ?>

            <p class="box-inside-text"> This article was published in issue # 
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <?php echo $term->name; ?> | <?php the_title(); ?></p>
              <?php the_post_thumbnail('square-thumbnail') ?>
            </a>

<?php 
  $link = get_post_meta($post->ID, 'cart_link', true);
   
?>
      <a href="https://checkout.subscriptiongenius.com/buddhism-today.org/"><span class="buy_button" onClick="ga('send', 'event', { eventCategory: 'Subscribe', eventAction: 'click', eventLabel: 'link article', eventValue: 1});">Subscribe</span></a>

 
  
  

           
    <?php endwhile; ?>

<?php endif; wp_reset_query(); ?>

<!-- /Box with an Issue Cover -->

</div>
<div class="main-text">

    <?php the_content(); ?>
    
   <a href="https://checkout.subscriptiongenius.com/buddhism-today.org/"><span class="buy_button" onClick="ga('send', 'event', { eventCategory: 'Subscribe', eventAction: 'click', eventLabel: 'link article', eventValue: 1});">Enjoyed this article? For more like it, subscribe today!</span></a>
    
</div>


    <?php

    } 

  } ?>




</article>

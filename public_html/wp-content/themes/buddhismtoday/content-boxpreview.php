<?php 
    
  if (is_page(50)) {
    $newsPosts = new WP_Query(array('tag' => 'home'));
  } elseif (is_page(138)) {
    $newsPosts = new WP_Query('cat=24');
  } elseif (is_page(136)) {
    $newsPosts = new WP_Query('cat=25');
  }
    
    static $count = 0;

    if ( $newsPosts->have_posts() ): ?>
       
       <?php while ( $newsPosts->have_posts() ) : $newsPosts->the_post(); 
    
    if ($count == 0) { ?>

      <div class="post-item clearfix">

        <!-- post-thumbnail -->
        <div class="square-thumbnail">
            <a href="<?php the_permalink(); ?>"><?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('featured-image');
                } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/blank.jpg">
                    <?php } ?></a>
        </div><!-- /post-thumbnail -->

        <div class="article-title" >
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </div>
            <p class="post-info">by <?php coauthors_posts_links(); ?></a> | 
            

<?php
            $issue = get_the_terms( $post->ID , 'issue' );
            foreach ( $issue as $term ) {  }

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
            
        </div>
    
    <?php } 
    elseif (($count % 2) !== 0) { ?>

      <ul class="small-columns">
        
        <li class="columns"><!-- post-item -->    
          <?php get_template_part ('hpcontenthalf'); ?>
        </li><!-- /post-item --> 

  <?php } else  { ?>
    <li class="columns">
      <?php get_template_part ('hpcontenthalf'); ?>
    </li>
 </ul>   
    <?php }
      
      $count++;

    endwhile; 
    endif; wp_reset_query();
?>
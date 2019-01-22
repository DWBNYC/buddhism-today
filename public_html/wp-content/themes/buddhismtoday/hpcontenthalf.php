<div class="post-item clearfix">

    


    <div class="square-thumbnail"><!-- post-thumbnail -->


        <a href="<?php the_permalink(); ?>"><?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('featured-image');
            } else { ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/leaf.jpg">
                <?php } ?></a>
    </div><!-- /post-thumbnail -->

    <div class="sm-article-title" >
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </div>
    <div class="article-info">
        <p class="post-info">by <?php coauthors_posts_links(); ?></a> | 
        

<?php
    $issue = get_the_terms( $post->ID , 'issue' ); 
        foreach ( $issue as $term ) { 
        $issue_num=$term->name;
    } 

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
                'terms' => $issue_num
                ))
                 );

    $issues_pages = get_posts( $args );

        foreach ( $issues_pages as $post ) {
          ?>
            <a href="<?php the_permalink(); ?>">Issue <?php echo $issue_num; ?></a>
                   
            <?php } 
            wp_reset_postdata(); ?>

        <!-- issue number -->
        </p> 
        </div>

  <!--  <?php the_excerpt(); ?> -->      
  <?php if (is_search()) { ?>

    <p class="search_result_context">
      <?php echo search_excerpt(); ?>
    </p>
  
  <?php } ?>
   
</div>
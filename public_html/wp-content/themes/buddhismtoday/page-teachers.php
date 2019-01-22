<?php

get_header(); ?>

  <!-- site-content -->
  <div class="site-content clearfix">
    
    <!-- main-column -->
    <div class="main-column">
    <ul class="teacher-grid">
<?php
  $childpages = get_pages( array( 
    'child_of' => $post->ID, 
    'sort_column' => 'post_date', 
    'sort_order' => 'acs' 
    ));

      foreach( $childpages as $page ) {    
        $content = $page->post_content;
        if ( ! $content ) // Check for empty page
          continue;

      $content = apply_filters( 'the_content', $content );
?>
  
    <li class="teacher-item">

    <a href="<?php echo get_page_link( $page->ID ); ?>" >
      <?php echo get_the_post_thumbnail( $page->ID, 'teacher-thumbnail' ); ?>
    </a> 
      <a href="<?php echo get_page_link( $page->ID ); ?>">
      <?php echo $page->post_title; ?></a>
      
    </li>

    
  
<?php } ?>

    </ul>

    </div><!-- main-column -->

    <?php get_sidebar(); ?>
    
  </div><!-- /site-content -->

<?php get_footer();

?>
<?php

/*
Template Name: Magazine Page
*/

get_header(); ?>
  
  <!-- site-content -->
  <div class="site-content clearfix">
    
    <!-- main-column -->
    <div class="main-column">

<div class="all_mags">
<?php
  $childpages = get_pages( array( 
    'child_of' => $post->ID, 
    'sort_column' => 'menu_order',
    'sort_order' => 'desc'
    ));

  foreach( $childpages as $page ) {    
    $content = $page->post_content;
    if ( ! $content ) // Check for empty page
      continue;

    $content = apply_filters( 'the_content', $content );
?>
  <div class="mag-grid">
      <a href="<?php echo get_page_link( $page->ID ); ?>">
        <?php echo get_the_post_thumbnail( $page->ID ); ?>
      </a> 
    <p class="mag-title"><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a> </p>

<!--
<?php 
  $link = get_post_meta($page->ID, 'cart_link', true);
  if ($link) { 
?>
    
      <a href="<?php echo $link; ?>"><span class="buy_button">Subscribe</span></a>
    

<?php } 
  else { ?>
    <div class="buy_button_sold">Sold Out</div>
<?php } ?>

-->

  </div> 
   
  
  <?php } ?>

  </div>

    </div><!-- /main-column -->

       

    <?php get_sidebar(); ?>
    
  </div><!-- /site-content -->
  
  <?php get_footer();

?>
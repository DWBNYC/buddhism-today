<?php get_header('404'); ?>

<style>
body {
    background-color: black;
}

</style>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

      <header class="page-header">
        <img src="http://buddhism-today.org/wp-content/themes/buddhismtoday/images/mahakala.jpg" style="display: block; margin: auto;"">
        <h1 class="page-title" style="text-align: center;"><?php _e( 'Not Found', 'buddhismtoday' ); ?></h1>
      </header>

      <div class="page-wrapper">
        <div class="page-content">

          <p style="text-align: center;"><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'buddhismtoday' ); ?></p>

          <?php get_search_form(); ?>
        </div><!-- .page-content -->
      </div><!-- .page-wrapper -->

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_footer(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
      <link rel="icon" href="<?php bloginfo('siteurl'); ?>/favicon.ico" type="image/x-icon" />
      <link rel="shortcut icon" href="<?php bloginfo('siteurl'); ?>/favicon.ico" type="image/x-icon" />

<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
      <meta charset="<?php bloginfo('charset'); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-91096956-1', 'auto');
  ga('send', 'pageview');

ga('send', {
  hitType: 'social',
  socialNetwork: 'Facebook',
  socialAction: 'share',
  socialTarget: '<?php echo get_permalink(); ?>'
});

ga('send', 'social', 'Twitter', 'share', '<?php echo get_permalink(); ?>');

ga('send', 'social', 'Pinterest', 'share', '<?php echo get_permalink(); ?>');

</script>




<title>Buddhism Today Magazine: <?php the_title(); ?></title>


      <?php wp_head(); ?>
  </head>



  <body <?php body_class(); ?>>





  <div class="container"> 

      <!-- site-header -->
      <header class="site-header">
      <div>
          <!-- header-widget -->
           <?php dynamic_sidebar('header1'); ?>
          <!-- header-widget -->



          <div class="header-image">
            <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/btlogo.png" alt="Logo">
            </a>
          </div>

<hr style="color: #DDD;">
       <!-- <div class="menu-trigger"><div class="menu-trigger-cont">&#9776;</div></div>
            <nav class="site-nav">
              <?php 
              $args = array(
                  'theme_location' => 'primary'
                  );
              ?>

              <?php wp_nav_menu( $args ); ?>


            </nav>
</div> -->
      </header>
      <!-- site-header -->

 

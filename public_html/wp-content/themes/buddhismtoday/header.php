<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
<link rel="alternate" href="http://buddhism-today.org/" 
      hreflang="en-us" />

      <link rel="icon" href="<?php bloginfo('siteurl'); ?>/favicon.ico" type="image/x-icon" />
      <link rel="shortcut icon" href="<?php bloginfo('siteurl'); ?>/favicon.ico" type="image/x-icon" />
      
      <link rel="stylesheet" href="/wp-content/plugins/download-manager/assets/font-awesome/css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
      <meta charset="<?php bloginfo('charset'); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="google-site-verification" content="wDpuiLTioI61bcYlFM4phn_wpFhFsrbUMRjQjDqm2R4" />
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-91096956-1', 'auto', {'allowLinker': true});
  ga('require', 'linker');
  ga('linker:autoLink', ['checkout.subscriptiongenius.com/buddhism-today.org'] );
  ga('send', 'pageview');

ga('send', {
  hitType: 'social',
  socialNetwork: 'Facebook',
  socialAction: 'share',
  socialTarget: '<?php echo get_permalink(); ?>'
});

ga('send', {
  hitType: 'social',
  socialNetwork: 'Twitter',
  socialAction: 'tweet',
  socialTarget: '<?php echo get_permalink(); ?>'
});

ga('send', {
  hitType: 'social',
  socialNetwork: 'Google+',
  socialAction: '+ 1',
  socialTarget: '<?php echo get_permalink(); ?>'
});

ga('send', {
  hitType: 'social',
  socialNetwork: 'Pinterest',
  socialAction: 'Pin It',
  socialTarget: '<?php echo get_permalink(); ?>'
});


</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MXXGNL2');</script>
<!-- End Google Tag Manager -->


<title>Buddhism Today Magazine: <?php the_title(); ?></title>


      <?php wp_head(); ?>
  </head>



  <body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MXXGNL2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
      
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '334253203702983',
      xfbml      : true,
      version    : 'v2.10'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>



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


        <div class="menu-trigger"><div class="menu-trigger-cont">&#9776;</div></div>
            <nav class="site-nav">
              <?php 
              $args = array(
                  'theme_location' => 'primary'
                  );
              ?>

              <?php wp_nav_menu( $args ); ?>


            </nav>
</div>
      </header>
      <!-- site-header -->

 <!-- ga('create', 'UA-91096956-1', 'auto'); -->

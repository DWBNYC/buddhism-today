<footer class="site-footer">

          <nav class="site-nav">
          <?php 
          $args = array(
              'theme_location' => 'footer'
              );
          ?>

          <?php wp_nav_menu(  $args); ?>
          </nav>

    <p><?php bloginfo('name'); ?> is a bi-annual magazine published by <a href="http://www.diamondway.org">Diamond Way Buddhist Centers USA</a>, a California nonprofit corporation. </br>
    Contents &copy; Diamond Way Buddhist Centers USA, <?php echo date('Y')?> <a href="mailto:editors@buddhism-today.org">editors@buddhism-today.org</a></p>

  </footer>

</div><!-- container -->

<?php wp_footer(); ?>



</body>
</html>
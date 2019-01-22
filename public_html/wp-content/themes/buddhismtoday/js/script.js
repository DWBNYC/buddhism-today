/*jQuery(document).ready(function() {

  jQuery(".menu-trigger").click(function() { 
      jQuery(".site-nav").slideToggle(400, function() {
        jQuery(this).toggleClass("nav-expanded").css('dispaly', '');
      });
      });


});*/


jQuery(document).ready(function() {

    jQuery('.menu-trigger').click(function() {

        jQuery('.site-nav').slideToggle(400, function() {
            jQuery(this).toggleClass("nav-expanded")

            /* I added this here */
            if(!jQuery(this).hasClass('nav-expanded')) {
                jQuery(this).css('display', '')
            }

        });
    });
});
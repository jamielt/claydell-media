/*
* Scroll to Top Button
*/

// scroll-to-top button show and hide
jQuery(document).ready(function(){
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 100) {
            jQuery('.backtotop').fadeIn();
        } else {
            jQuery('.backtotop').fadeOut();
    }
});
// scroll-to-top animate speed
jQuery('.backtotop').click(function(){
    jQuery("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });
})
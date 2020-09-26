//custom js
(function($) {
    "use strict";
    new WOW().init();
	//preloader
    jQuery(window).on('load', function() {
        var pre = $("#preloader");
        var lre = $("#load");
        pre.delay(50).fadeOut("slow");
        lre.delay(50).fadeOut("slow");
    });
	
    // HIDE MOBILE MENU AFTER CLIKING ON A LINK
    var nav = $(".navbar-collapse a");
    var coll = $(".navbar-collapse");
    nav.on('click', function() {
        coll.collapse('hide');
    });

    //jQuery for page scrolling feature - requires jQuery Easing plugin
    $(function() {
        var nli = $(".navbar-nav li a");
        var scrl = $(".page-scroll a");


        nli.on('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });

        scrl.on('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });

})(jQuery);
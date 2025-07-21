$(document).ready(function() {

    $('.slideToRegisterMenu').click(function() {
        $('html, body').animate({
          scrollTop: $("#registerContainer").offset().top
        }, 1000);
    });

    $('.slideToRegisterMenuMobile').click(function() {
        $(".sliding-menu-in").css("left", "-100%");
        $('.sliding-menu').fadeOut();
        setTimeout(function() {
            $('html, body').animate({
              scrollTop: $("#registerContainer").offset().top
            }, 1000);
        }, 400);
    });



    $('.menu-icon').click(function() {
        $('.sliding-menu').fadeIn();
        setTimeout(function() {
            $(".sliding-menu-in").css("left", "0");
        }, 200);
    });

    $('.back-icon').click(function(e) {
        e.preventDefault();
        $(".sliding-menu-in").css("left", "-100%");
        $('.sliding-menu').fadeOut();
    });
});


$(window).on('load', function() {
    var currentURL = window.location.href;
    if (currentURL.includes("#register")) {
        $('html, body').animate({
          scrollTop: $("#registerContainer").offset().top
        }, 1000);
    }
});
$(document).ready(function() {

    $('.slideToRegisterMenu').click(function() {
        $('html, body').animate({
          scrollTop: $("#registerContainer").offset().top
        }, 1000);
    });

    $('.slideToRegisterMenuMobile').click(function() {
        $(".sliding-menu-in").css("right", "-100%");
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
            $(".sliding-menu-in").css("right", "0");
        }, 200);
    });

    $('.back-icon').click(function(e) {
        e.preventDefault();
        $(".sliding-menu-in").css("right", "-100%");
        $('.sliding-menu').fadeOut();
    });
    // on scroll fix the header
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.header-content').addClass('fixed-header');
        } else {
            $('.header-content').removeClass('fixed-header');
        }
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
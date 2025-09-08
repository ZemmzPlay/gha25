$(document).ready(function() {

    // Register menu functionality removed - now links to separate register page



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

    // Close mobile menu when clicking outside the menu panel
    $('.sliding-menu').click(function(e) {
        // Only close if clicking on the overlay, not on the menu panel itself
        if (e.target === this) {
            $(".sliding-menu-in").css("right", "-100%");
            $('.sliding-menu').fadeOut();
        }
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

// Select2 dropdowns are now handled in the master template
var $portfolio;
var $masonry_block;
var $portfolio_selectors;
var $blog;

$(document).ready(function () {

    // Show Animated Counters
    animatecounters();
    /*==============================================================*/
    //Smooth Scroll - START CODE
    /*==============================================================*/
    jQuery('.inner-top').smoothScroll({
        speed: 900,
        offset: -68
    });
    /*==============================================================*/
    //Smooth Scroll - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Set Resize Header Menu - START CODE
    /*==============================================================*/
    SetResizeHeaderMenu();
    /*==============================================================*/
    //Set Resize Header Menu - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //For shopping cart- START CODE
    /*==============================================================*/
    var isMobile = false;
    var isiPhoneiPad = false;

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        isMobile = true;
    }
    if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
        isiPhoneiPad = true;
    }
    if (!isMobile) {
        jQuery(".top-cart a.shopping-cart, .cart-content").hover(function () {
            jQuery(".cart-content").css('opacity', '1');
            jQuery(".cart-content").css('visibility', 'visible');
        }, function () {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');
        });
    }
    if (isiPhoneiPad) {
        jQuery(".video-wrapper").css('display', 'none');
    }

    jQuery(".top-cart a.shopping-cart").click(function () {
        //$('.navbar-collapse').collapse('hide');

        if ($('.cart-content').css('visibility') == 'visible') {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');
        }
        else {
            jQuery(".cart-content").css('opacity', '1');
            jQuery(".cart-content").css('visibility', 'visible');

        }
    });

    /*==============================================================*/
    //Shrink nav on scroll - START CODE
    /*==============================================================*/

    if ($(window).scrollTop() > 10) {
        $('nav').addClass('shrink-nav');
    } else {
        $('nav').removeClass('shrink-nav');
    }
    /*==============================================================*/
    //Shrink nav on scroll - END CODE
    /*==============================================================*/


    /*==============================================================*/
    //Portfolio - START CODE
    /*==============================================================*/
    if (Modernizr.touch) {
        // show the close overlay button
        $(".close-overlay").removeClass("hidden");
        // handle the adding of hover class when clicked
        $(".porfilio-item").click(function (e) {
            if (!$(this).hasClass("hover")) {
                $(this).addClass("hover");
            }
        });
        // handle the closing of the overlay
        $(".close-overlay").click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            if ($(this).closest(".porfilio-item").hasClass("hover")) {
                $(this).closest(".porfilio-item").removeClass("hover");
            }
        });
    } else {
        // handle the mouseenter functionality
        $(".porfilio-item").mouseenter(function () {
            $(this).addClass("hover");
        })
        // handle the mouseleave functionality
        .mouseleave(function () {
            $(this).removeClass("hover");
        });
    }

    // use for portfolio sotring with masonry

    $portfolio = $('.masonry-items');
    $portfolio.imagesLoaded(function () {
    });

    // use for simple masonry ( for example home-photography.html page )

    $masonry_block = $('.masonry-block-items');
    $masonry_block.imagesLoaded(function () {

    });

    $portfolio_selectors = $('.portfolio-filter > li > a');
    $portfolio_selectors.on('click', function () {
        $portfolio_selectors.parent().removeClass('active');
        $(this).parent().addClass('active');
        var selector = $(this).attr('data-filter');
        $portfolio.isotope({ filter: selector });
        return false;
    });
    $blog = $('.blog-masonry');
    $blog.imagesLoaded(function () {

    });
    /*==============================================================*/
    //Portfolio - END CODE
    /*==============================================================*/


    /*==============================================================*/
    //Stop Closing magnificPopup on selected elements - START CODE
    /*==============================================================*/

    $(".owl-pagination > .owl-page").click(function (e) {
        if ($(e.target).is('.mfp-close'))
            return;
        return false;
    });
    $(".owl-buttons > .owl-prev").click(function (e) {
        if ($(e.target).is('.mfp-close'))
            return;
        return false;
    });
    $(".owl-buttons > .owl-next").click(function (e) {
        if ($(e.target).is('.mfp-close'))
            return;
        return false;
    });
    /*==============================================================*/
    //Stop Closing magnificPopup on selected elements - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //WOW Animation  - START CODE
    /*==============================================================*/

    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 90,
        mobile: false,
        live: true
    });
    wow.init();
    /*==============================================================*/
    //WOW Animation  - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //accordion  - START CODE
    /*==============================================================*/

    $('.collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
    });
    $('.collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
    });
    $('.nav.navbar-nav a.inner-link').click(function () {
        $(this).parents('ul.navbar-nav').find('a.inner-link').removeClass('active');
        $(this).addClass('active');
        if ($('.navbar-header .navbar-toggle').is(':visible'))
            $(this).parents('.navbar-collapse').collapse('hide');
    });
    $('.accordion-style2 .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
    });
    $('.accordion-style2 .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
    });
    $('.accordion-style3 .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
    });
    $('.accordion-style3 .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
    });
    /*==============================================================*/
    //accordion - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //toggles  - START CODE
    /*==============================================================*/

    $('toggles .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
    });
    $('toggles .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
    });
    $('.toggles-style2 .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
    });
    $('.toggles-style2 .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
    });
    /*==============================================================*/
    //toggles  - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //fit video  - START CODE
    /*==============================================================*/
    // Target your .container, .wrapper, .post, etc.
    try {
        $(".fit-videos").fitVids();
    }
    catch (err) {

    }


    /*==============================================================*/
    //fit video  - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //google map - mouse scrolling wheel behavior - START CODE
    /*==============================================================*/
    // you want to enable the pointer events only on click;

    $('#map_canvas1').addClass('scrolloff'); // set the pointer events to none on doc ready
    $('#canvas1').on('click', function () {
        $('#map_canvas1').removeClass('scrolloff'); // set the pointer events true on click
    });
    // you want to disable pointer events when the mouse leave the canvas area;

    $("#map_canvas1").mouseleave(function () {
        $('#map_canvas1').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
    });
    /*==============================================================*/
    //google map - mouse scrolling wheel behavior - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Search - START CODE
    /*==============================================================*/
    $("input.search-input").bind("keypress", function (event) {
        if (event.which == 13 && !isMobile) {
            $("button.search-button").click();
            event.preventDefault();
        }
    });
    $("input.search-input").bind("keyup", function (event) {
        if ($(this).val() == null || $(this).val() == "") {
            $(this).css({ "border": "none", "border-bottom": "2px solid red" });
        }
        else {
            $(this).css({ "border": "none", "border-bottom": "2px solid #000" });
        }
    });
    function validationSearchForm() {
        var error = true;
        $('#search-header input[type=text]').each(function (index) {
            if (index == 0) {
                if ($(this).val() == null || $(this).val() == "") {
                    $("#search-header").find("input:eq(" + index + ")").css({ "border": "none", "border-bottom": "2px solid red" });
                    error = false;
                }
                else {
                    $("#search-header").find("input:eq(" + index + ")").css({ "border": "none", "border-bottom": "2px solid #000" });
                }
            }
        });
        return error;
    }
    $("form.search-form, form.search-form-result").submit(function (event) {
        var error = validationSearchForm();
        if (error) {
            var action = $(this).attr('action');
            action = action == '#' || action == '' ? 'blog-grid-3columns.html' : action;
            action = action + '?' + $(this).serialize();
            window.location = action;
        }

        event.preventDefault();
    });
    $('.navbar .navbar-collapse a.dropdown-toggle, .accordion-style1 .panel-heading a, .accordion-style2 .panel-heading a, .accordion-style3 .panel-heading a, .toggles .panel-heading a, .toggles-style2 .panel-heading a, .toggles-style3 .panel-heading a, a.carousel-control, .nav-tabs a[data-toggle="tab"], a.shopping-cart').click(function (e) {
        e.preventDefault();
    });
    $('body').on('touchstart click', function (e) {
        if ($(window).width() < 992) {
            if (!$('.navbar-collapse').has(e.target).is('.navbar-collapse') && $('.navbar-collapse').hasClass('in') && !$(e.target).hasClass('navbar-toggle')) {
                $('.navbar-collapse').collapse('hide');
            }
        }
        else {
            if (!$('.navbar-collapse').has(e.target).is('.navbar-collapse') && $('.navbar-collapse ul').hasClass('in')) {
                console.log(this);
                $('.navbar-collapse').find('a.dropdown-toggle').addClass('collapsed');
                $('.navbar-collapse').find('ul.dropdown-menu').removeClass('in');
                $('.navbar-collapse a.dropdown-toggle').removeClass('active');
            }
        }
    });
    $('.navbar-collapse a.dropdown-toggle').on('touchstart', function (e) {
        $('.navbar-collapse a.dropdown-toggle').not(this).removeClass('active');
        if ($(this).hasClass('active'))
            $(this).removeClass('active');
        else
            $(this).addClass('active');
    });

    $("button.navbar-toggle").click(function () {
        if (isMobile) {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');

        }
    });
    $("a.dropdown-toggle").click(function () {
        if (isMobile) {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');

        }
    });



    /*==============================================================*/
    //Search - END CODE
    /*==============================================================*/



    /*==============================================================*/
    //FORM TO EMAIL - START CODE
    /*==============================================================*/
    $("#success").hide();

    $("#contact-us-button").click(function () {
        var error = validationContactUsForm();
        if (error) {
            $.ajax({
                type: "POST",
                url: "contact.php",
                data: $("#contactusform").serialize(),
                success: function (result) {
                    $('input[type=text],textarea').each(function () {
                        $(this).val('');
                    })
                    $("#success").html(result);
                    $("#success").fadeIn("slow");
                    $('#success').delay(4000).fadeOut("slow");
                }
            });
        }
    });
    function validationContactUsForm() {
        var error = true;
        $('#contactusform input[type=text]').each(function (index) {

            if (index == 1) {
                if (!(/(.+)@(.+){2,}\.(.+){2,}/.test($(this).val()))) {
                    $("#contactusform").find("input:eq(" + index + ")").css({ "border": "1px solid red" });
                    error = false;
                } else {
                    $("#contactusform").find("input:eq(" + index + ")").css({ "border": "1px solid #dfdfdf" });
                }
            }
            else if (index == 0) {
                if ($(this).val() == null || $(this).val() == "") {
                    $("#contactusform").find("input:eq(" + index + ")").css({ "border": "1px solid red" });
                    error = false;
                }
                else {
                    $("#contactusform").find("input:eq(" + index + ")").css({ "border": "1px solid #dfdfdf" });
                }
            }
        });
        return error;
    }

    $("#notifyme-button").click(function () {
        var error = validationnotifymeForm();
        if (error) {
            $.ajax({
                type: "POST",
                url: "notifyme.php",
                data: $("#notifymeform").serialize(),
                success: function (result) {
                    $('input[type=text],textarea').each(function () {
                        $(this).val('');
                    })

                    $("#success").html(result);
                    $("#success").fadeIn("slow");
                    $('#success').delay(4000).fadeOut("slow");
                }
            });
        }
    });
    function validationnotifymeForm() {
        var error = true;
        $('#notifymeform input[type=text]').each(function (index) {

            if (index == 0) {
                if (!(/(.+)@(.+){2,}\.(.+){2,}/.test($(this).val()))) {
                    $("#notifymeform").find("input:eq(" + index + ")").css({ "border": "1px solid red" });
                    error = false;
                } else {
                    $("#notifymeform").find("input:eq(" + index + ")").css({ "border": "1px solid #dfdfdf" });
                }
            }

        });
        return error;
    }

    $("#success-free30daytrial").hide();
    $("#free30daytrial-button").click(function () {
        var error = validationfree30daytrialForm();
        if (error) {
            $.ajax({
                type: "POST",
                url: "free30daytrial.php",
                data: $("#free30daytrialform").serialize(),
                success: function (result) {
                    $('input[type=text],textarea').each(function () {
                        $(this).val('');
                    })
                    $("#success-free30daytrial").html(result);
                    $("#success-free30daytrial").fadeIn("slow");
                    $('#success-free30daytrial').delay(4000).fadeOut("slow");
                }
            });
        }
    });
    function validationfree30daytrialForm() {
        var error = true;
        $('#free30daytrialform input[type=text]').each(function (index) {

            if (index == 1) {
                if (!(/(.+)@(.+){2,}\.(.+){2,}/.test($(this).val()))) {
                    $("#free30daytrialform").find("input:eq(" + index + ")").css({ "border": "1px solid red" });
                    error = false;
                } else {
                    $("#free30daytrialform").find("input:eq(" + index + ")").css({ "border": "1px solid #dfdfdf" });
                }
            }
            else if (index == 0) {
                if ($(this).val() == null || $(this).val() == "") {
                    $("#free30daytrialform").find("input:eq(" + index + ")").css({ "border": "1px solid red" });
                    error = false;
                }
                else {
                    $("#free30daytrialform").find("input:eq(" + index + ")").css({ "border": "1px solid #dfdfdf" });
                }
            }
        });
        return error;
    }


    $("#event-button").click(function () {
        var error = validationeventForm();
        if (error) {
            $.ajax({
                type: "POST",
                url: "rsvp.php",
                data: $("#eventform").serialize(),
                success: function (result) {
                    $('input[type=text],textarea').each(function () {
                        $(this).val('');
                    })
                    $("#success").html(result);
                    $("#success").fadeIn("slow");
                    $('#success').delay(4000).fadeOut("slow");
                }
            });
        }
    });
    function validationeventForm() {
        var error = true;
        $('#eventform input[type=text]').each(function (index) {

            if (index == 0) {
                if ($(this).val() == null || $(this).val() == "") {
                    $("#eventform").find("input:eq(" + index + ")").css({ "border": "1px solid red" });
                    error = false;
                }
                else {
                    $("#eventform").find("input:eq(" + index + ")").css({ "border": "1px solid #dfdfdf" });
                }
            }
        });
        return error;
    }

    $("#careers-button").click(function () {
        var error = validationcareersForm();
        if (error) {
            $.ajax({
                type: "POST",
                url: "careers.php",
                data: $("#careersform").serialize(),
                success: function (result) {
                    $('input[type=text],textarea').each(function () {
                        $(this).val('');
                    })
                    $("#success").html(result);
                    $("#success").fadeIn("slow");
                    $('#success').delay(4000).fadeOut("slow");
                }
            });
        }
    });
    function validationcareersForm() {
        var error = true;
        $('#careersform input[type=text]').each(function (index) {

            if (index == 1) {
                if (!(/(.+)@(.+){2,}\.(.+){2,}/.test($(this).val()))) {
                    $("#careersform").find("input:eq(" + index + ")").css({ "border": "1px solid red" });
                    error = false;
                } else {
                    $("#careersform").find("input:eq(" + index + ")").css({ "border": "1px solid #dfdfdf" });
                }
            }
            else if (index == 0) {
                if ($(this).val() == null || $(this).val() == "") {
                    $("#careersform").find("input:eq(" + index + ")").css({ "border": "1px solid red" });
                    error = false;
                }
                else {
                    $("#careersform").find("input:eq(" + index + ")").css({ "border": "1px solid #dfdfdf" });
                }
            }
            else if (index == 2) {
                if ($(this).val() == null || $(this).val() == "") {
                    $("#careersform").find("input:eq(" + index + ")").css({ "border": "1px solid red" });
                    error = false;
                }
                else {
                    $("#careersform").find("input:eq(" + index + ")").css({ "border": "1px solid #dfdfdf" });
                }
            }
        });
        return error;
    }
    /*==============================================================*/
    //FORM TO EMAIL - END CODE
    /*==============================================================*/


    /* Start of map code */

    var sites = [['Salwa Sabah Al-Ahmad Theater & Hall', 29.3426737, 48.0673742, 1]];
    var map;
    var marker=[];
    var image = new google.maps.MarkerImage('images/blank.png',
        new google.maps.Size(100, 39),
        new google.maps.Point(0,0),
        new google.maps.Point(50, 39));

    var bounds = new google.maps.LatLngBounds();
    var infowindow = null;
    var bounceTimer;
    google.maps.visualRefresh = true;
    var mapOptions = {
        mapTypeControl: false,
        streetViewControl: false,
        backgroundColor : "#ffffff",
        scrollwheel : false,
        zoom: 17,
        center: new google.maps.LatLng(29.3426737, 48.0673742),
        disableDoubleClickZoom : true,
        panControl: false,
        zoomControl: false,
        scaleControl: false,
        size: (0, 0, 'px', 'px'),
        draggable: false
    };

    var mapStyles = [
        {
            featureType: "water",
            elementType: "all",
            stylers: [
                //{ color: '#a62642' },
                { visibility: "on" }
            ]
        },
        {
            featureType: "road",
            stylers: [
                {
                    //color: '#e94467',
                    "visibility": "on"
                }
            ]
        },
        {
            featureType: "landscape",
            elementType: "all",
            stylers: [
                //{ "color": "#c42c4c" }
            ]
        },
        {
            featureType: "poi",
            stylers: [
                //{ "color": "#c42c4c" }

            ]
        },
        {
            featureType: "poi",
            elementType: "labels.text.fill",
            stylers: [
                //{ "color": "#000000" }

            ]
        },
    ];

// Define the overlay, derived from google.maps.OverlayView
    function Label(opt_options) {
        // Initialization
        this.setValues(opt_options);

        // Here go the label styles
        var div = this.div_ = document.createElement('div');
        div.className = 'maps-label-container';

        var span = this.span_ = document.createElement('span');
        span.className = 'pin bounce';
        div.appendChild(span);

        span = this.span_ = document.createElement('span');
        span.className = 'pulse';
        div.appendChild(span);

        span = this.span_ = document.createElement('span');
        span.className = 'maps-label';
        span.style.cssText = 'margin-left: -70%; padding-top: 20px; white-space: nowrap;';
        div.appendChild(span);
    }

    Label.prototype = new google.maps.OverlayView;

    Label.prototype.onAdd = function() {
        var pane = this.getPanes().overlayImage;
        pane.appendChild(this.div_);

        // Ensures the label is redrawn if the text or position is changed.
        var me = this;
        this.listeners_ = [
            google.maps.event.addListener(this, 'position_changed',
                function() { me.draw(); }),
            google.maps.event.addListener(this, 'text_changed',
                function() { me.draw(); }),
            google.maps.event.addListener(this, 'zindex_changed',
                function() { me.draw(); })
        ];
    };

// Implement onRemove
    Label.prototype.onRemove = function() {
        this.div_.parentNode.removeChild(this.div_);

        // Label is removed from the map, stop updating its position/text.
        for (var i = 0, I = this.listeners_.length; i < I; ++i) {
            google.maps.event.removeListener(this.listeners_[i]);
        }
    };

// Implement draw
    Label.prototype.draw = function() {
        var projection = this.getProjection();
        var position = projection.fromLatLngToDivPixel(this.get('position'));
        var div = this.div_;
        div.style.left = position.x + 'px';
        div.style.top = position.y + 'px';
        div.style.display = 'block';
        div.style.zIndex = this.get('zIndex'); //ALLOW LABEL TO OVERLAY MARKER
    };

    function initNewMap() {
        if ($('#map').length === 0) {
            return false;
        }

        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        if(!isMobile) {
            //map.panBy(0, $(window).height() * -0.3);
        }

        map.setOptions({styles: mapStyles});

        function setMarkers(map, markers) {
            for (var i = 0; i < markers.length; i++) {
                var sites = markers[i];
                var siteLatLng = new google.maps.LatLng(sites[1], sites[2]);

                var marker = new google.maps.Marker({
                    position: siteLatLng,
                    map: map,
                    icon: image,
                    title: sites[0],
                    optimized: false,
                    draggable: false,
                    animation: google.maps.Animation.DROP,
                    html: sites[4]
                });

                var label = new Label({
                    map: map
                });
                label.set('zIndex', 1234);
                label.bindTo('position', marker, 'position');
            }
        }


        setMarkers(map, sites);

        infowindow = new google.maps.InfoWindow({content: "loading..."});

        //Instantiate Map

    }
    initNewMap();
    /* End of map code */




});

function animatecounters() {
    /*==============================================================*/
    //Counter Number - START CODE
    /*==============================================================*/
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 312 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {

            $("#anim-number-pizza").text(Math.ceil(this.ValuerHbcO));
        }
    });
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 980 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {
            $("#anim-number-client").text(Math.ceil(this.ValuerHbcO));
        }
    });
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 810 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {
            $("#anim-number-projects").text(Math.ceil(this.ValuerHbcO));
        }
    });
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 600 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {
            $("#anim-number-comments").text(Math.ceil(this.ValuerHbcO));
        }
    });
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 450 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {
            $("#counter1").text(Math.ceil(this.ValuerHbcO));
        }
    });
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 687 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {
            $("#counter2").text(Math.ceil(this.ValuerHbcO));
        }
    });
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 835 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {
            $("#counter3").text(Math.ceil(this.ValuerHbcO));
        }
    });
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 450 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {
            $("#counter4").text(Math.ceil(this.ValuerHbcO));
        }
    });
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 875 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {
            $("#counter5").text(Math.ceil(this.ValuerHbcO));
        }
    });
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 458 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {
            $("#counter6").text(Math.ceil(this.ValuerHbcO));
        }
    });
    jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: 696 },
    {
        duration: 2000,
        easing: "swing",
        step: function () {
            $("#counter7").text(Math.ceil(this.ValuerHbcO));
        }
    });
    /*==============================================================*/
    //Counter Number - END CODE
    /*==============================================================*/
}

var inViewchart = false;
var inViewanimnumberpizza = false;
var inViewanimnumberclient = false;
var inViewanimnumberprojects = false;
var inViewanimnumbercomments = false;
var inViewcounter1 = false;
var inViewcounter2 = false;
var inViewcounter3 = false;
var inViewcounter4 = false;
var inViewcounter5 = false;
var inViewcounter6 = false;
var inViewcounter7 = false;

function isScrolledIntoView(elem) {
    try {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $(elem).offset().top;
        var elemBottom = elemTop + $(elem).height();

        return ((elemTop <= docViewBottom) && (elemBottom >= docViewTop));
    }
    catch (ex) {
        return false;
    }


}



/*==============================================================*/
//Navigation - START CODE
/*==============================================================*/
// Shrink nav on scroll
$(window).scroll(function () {
    if ($(window).scrollTop() > 10) {
        $('nav').addClass('shrink-nav');
    } else {
        $('nav').removeClass('shrink-nav');
    }

    //Animate Elements in view position
    if (isScrolledIntoView('.chart')) {
        if (inViewchart == false) {
            inViewchart = true;

        }
    }


    if (isScrolledIntoView('#anim-number-pizza')) {
        if (inViewanimnumberpizza == false) {
            inViewanimnumberpizza = true;
            animatecounters();
        }

    }

    if (isScrolledIntoView('#anim-number-projects')) {
        if (inViewanimnumberprojects == false) {
            inViewanimnumberprojects = true;

            animatecounters();
        }

    }

    if (isScrolledIntoView('#anim-number-comments')) {
        if (inViewanimnumbercomments == false) {
            inViewanimnumbercomments = true;

            animatecounters();
        }
    }

    if (isScrolledIntoView('#counter1')) {
        if (inViewcounter1 == false) {
            inViewcounter1 = true;

            animatecounters();
        }
    }

    if (isScrolledIntoView('#counter2')) {
        if (inViewcounter2 == false) {
            inViewcounter2 = true;

            animatecounters();
        }
    }

    if (isScrolledIntoView('#counter3')) {
        if (inViewcounter3 == false) {
            inViewcounter3 = true;

            animatecounters();
        }
    }

    if (isScrolledIntoView('#counter4')) {
        if (inViewcounter4 == false) {
            inViewcounter4 = true;

            animatecounters();
        }
    }

    if (isScrolledIntoView('#counter5')) {
        if (inViewcounter5 == false) {
            inViewcounter5 = true;
            animatecounters();
        }
    }

    if (isScrolledIntoView('#counter6')) {
        if (inViewcounter6 == false) {
            inViewcounter6 = true;
            animatecounters();
        }
    }
    if (isScrolledIntoView('#counter7')) {
        if (inViewcounter7 == false) {
            inViewcounter7 = true;
            animatecounters();
        }
    }



});
// Resize Header Menu
function SetResizeHeaderMenu() {
    var width = jQuery('nav.navbar').children('div.container').width();
    $("ul.mega-menu-full").each(function () {
        jQuery(this).css('width', width + 'px');
    });
}
/*==============================================================*/
//Navigation - END CODE
/*==============================================================*/


/*==============================================================*/
//Mobile Toggle Control - START CODE
/*==============================================================*/

$('.mobile-toggle').click(function () {
    $('nav').toggleClass('open-nav');
});
$('.dropdown-arrow').click(function () {
    if ($('.mobile-toggle').is(":visible")) {
        if ($(this).children('.dropdown').hasClass('open-nav')) {
            $(this).children('.dropdown').removeClass('open-nav');
        } else {
            $('.dropdown').removeClass('open-nav');
            $(this).children('.dropdown').addClass('open-nav');
        }
    }
});
/*==============================================================*/
//Mobile Toggle Control - END CODE
/*==============================================================*/

/*==============================================================*/
//Position Fullwidth Subnavs fullwidth correctly - START CODE
/*==============================================================*/
$('.dropdown-fullwidth').each(function () {
    $(this).css('width', $('.row').width());
    var subNavOffset = -($('nav .row').innerWidth() - $('.menu').innerWidth() - 15);
    $(this).css('left', subNavOffset);
});
/*==============================================================*/
//Position Fullwidth Subnavs fullwidth correctly - END CODE
/*==============================================================*/

/*==============================================================*/
//Smooth Scroll - START CODE
/*==============================================================*/
var scrollAnimationTime = 1200,
        scrollAnimation = 'easeInOutExpo';
$('a.scrollto').bind('click.smoothscroll', function (event) {
    event.preventDefault();
    var target = this.hash;
    $('html, body').stop()
            .animate({
                'scrollTop': $(target)
                        .offset()
                        .top
            }, scrollAnimationTime, scrollAnimation, function () {
                window.location.hash = target;
            });
});
// Inner links
$('.inner-link').smoothScroll({
    speed: 900,
    offset: -120
});
// Scroll To Down
function scrollToDown() {
    var target = $('#features');
    $('html, body').animate({ scrollTop: $(target).offset().top }, 800);
}
function scrollToDownSection() {
    var target = $('#about');
    $('html, body').animate({ scrollTop: $(target).offset().top }, 800);
}
/*==============================================================*/
//Smooth Scroll - END CODE
/*==============================================================*/

/*==============================================================*/
//Full Screen Header - START CODE
/*==============================================================*/

function SetResizeContent() {
    var minheight = $(window).height();
    $(".full-screen").css('min-height', minheight);
}

SetResizeContent();
/*==============================================================*/
//Full Screen Header - END CODE
/*==============================================================*/


/*==============================================================*/
//Window Resize Events - START CODE
/*==============================================================*/
$(window).resize(function () {
    //Position Fullwidth Subnavs fullwidth correctly
    $('.dropdown-fullwidth').each(function () {
        $(this).css('width', $('.row').width());
        var subNavOffset = -($('nav .row').innerWidth() - $('.menu').innerWidth() - 15);
        $(this).css('left', subNavOffset);
    });
    SetResizeContent();
    setTimeout(function () {
        SetResizeHeaderMenu();
    }, 200);
    if ($(window).width() >= 992 && $('.navbar-collapse').hasClass('in')) {
        $('.navbar-collapse').removeClass('in');
        //$('.navbar-collapse').removeClass('in').find('ul.dropdown-menu').removeClass('in').parent('li.dropdown').addClass('open');
        $('.navbar-collapse ul.dropdown-menu').each(function () {
            if ($(this).hasClass('in')) {
                $(this).removeClass('in'); //.parent('li.dropdown').addClass('open');
            }
        });
        $('ul.navbar-nav > li.dropdown > a.dropdown-toggle').addClass('collapsed');
        $('.logo').focus();
        $('.navbar-collapse a.dropdown-toggle').removeClass('active');
    }

});
/*==============================================================*/
//Window Resize Events - END CODE
/*==============================================================*/



/*==============================================================*/
//Scroll To Top - START CODE
/*==============================================================*/
$(window).scroll(function () {
    if ($(this)
            .scrollTop() > 100) {
        $('.scrollToTop')
                .fadeIn();
    } else {
        $('.scrollToTop')
                .fadeOut();
    }
});
//Click event to scroll to top
$('.scrollToTop').click(function () {
    $('html, body').animate({
        scrollTop: 0
    }, 1000);
    return false;
});
/*==============================================================*/
//Scroll To Top - END CODE
/*==============================================================*/


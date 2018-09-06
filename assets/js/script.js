jQuery( document ).ready(function($) {
    // Cookies
    function setCookie(name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        }
        else var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
    }
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    //Validate cookie
    var myCookie = getCookie("MyCookie");
    if (myCookie == null) {

        // LOADING HAMBURGER
        $('#loading_screen').show();
        $(window).load(function(){
            setTimeout(function(){
                $('.loading_wrapper, .loaded_wrapper').addClass('loaded');
            }, 2500);
            setTimeout(function(){
                $('html').removeClass('loading');
                $('html').addClass('loaded');
            }, 4000);
            setTimeout(function(){
                $('#loading_screen').hide();
            }, 6000);
        });

        setCookie("MyCookie", "foo", 7);
    }
    else {
        $('html').removeClass('loading');
        $('html').addClass('loaded');
    }

    //VIDEO SOUNDS
    // document.getElementById("bgvid").play();
    $('.sounds').on('click', function(){
        $(this).toggleClass('on');
        $('#bgvid').prop('muted', !$('#bgvid').prop('muted'));
    });

    $(window).on('load resize', function(){
        if($(this).width() <= 991 ) {
            $('.header .wrapper video').hide();
        } else {
            $('.header .wrapper video').show();
        }
    });

    //POPUP
    var popVid = document.getElementById("popup-vid");
    $('.watch__video').on('click', function(){
        $('.popup').addClass('active');
        $('html').addClass('no-scroll');
        $('#popup-vid').get(0).play();
    });
    $('.icon-cross').on('click', function(){
        $('.popup').removeClass('active');
        $('html').removeClass('no-scroll');
        $('#popup-vid').get(0).pause();
    });


    //HAMBURGER MENU
    $('.hamburger_menu_open, .hamburger_menu_close').click(function(){
        $('.hamburger').toggleClass('active');
        $('.menu_overlay').toggleClass('active');
        $('html').toggleClass('no-scroll');
    });

    //SLIDER
    $('.main-carousel').flickity({
        cellAlign: 'left',
        contain: true,
        wrapAround: true,
        prevNextButtons: false,
        autoPlay: 2000,
        pageDots: false,
        pauseAutoPlayOnHover: false
    });

    var $headerSlider = $('.header__slider').flickity({
        cellAlign: 'left',
        contain: true,
        wrapAround: true,
        autoPlay: 4000,
        pageDots: false,
        pauseAutoPlayOnHover: false
    });

    var flkty = $headerSlider.data('flickity');

    $headerSlider.on( 'scroll.flickity', function( event, index ) {
        flkty.stopPlayer();
        flkty.playPlayer();
    });


    //FILTER PROJECT DROPDOWN
    $('.toggle-filter').click(function(){
        $('.filter-wrapper').toggleClass('active');
        $(this).toggleClass('active');
    });

    $('.filter-wrapper label').click(function(){
        $('.filter-wrapper, .toggle-filter').removeClass('active');
    });

    //VACANCIE
    $('.vacancie').click(function(){
        $(this).toggleClass('active');
    });

    $('#accordion').collapse();

    //ANIMATIONS
    AOS.init({
        offset: 200,
        duration: 800,
        easing: 'ease',
        delay: 0,
        once: true,
        disable: window.innerWidth < 1100
    });

    //APPEND DIV TO MENU ITEM
    $( ".round_black" ).appendTo( $( ".menu-item-495" ) );

    //SOCIAL FEED HTML CLASS
    $(document.body).on('hidden.bs.modal', function () {
        $('html').removeClass('no-scroll');
    });
    $(document.body).on('show.bs.modal', function () {
        $('html').addClass('no-scroll');
    });

    //BODY FADE OUT
    $('.fade-out a, nav a').click(function() {
       event.preventDefault();
       newLocation = this.href;
       $('body').animate({duration:0}).fadeOut(500, newpage);
    });
    function newpage() {
       window.location = newLocation;
    }
});

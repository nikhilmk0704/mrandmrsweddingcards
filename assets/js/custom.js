$(document).ready(function () {
    'use strict';
    
    /*======================================
    Top Selector
    ======================================*/
    $('.top-selector').on('click', function (tsr) {
        tsr.stopPropagation();
        $('.top-select').not($(this).children('.top-select')).slideUp();
        $(this).children('.top-select').slideToggle();
    });
    
    function mobileSelect(){
        if($(window).width() < 768){
            $('.mobile-selector').on('click', function () {
                $(this).children('.mobile-select').slideToggle();
            });
        }
    }
    
    mobileSelect();
    
    /*======================================
    Banner Slider
    ======================================*/
    $('#banner-slider').owlCarousel({
        items: 1,
        loop: true,
        dots: true,
        lazyLoad: true,
        autoplay: true,
        autoplayTimeout: 10000,
        autoplaySpeed: 2000,
        navSpeed: 2000,
    });
    
    /*======================================
    Product Default Carousel
    ======================================*/
    $('.product-carousel').owlCarousel({
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        },
        margin: 30,
        nav: true,
        dots: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        lazyLoad: true,
        navSpeed: 500,
    });
    
    /*======================================
    Deal Carousel
    ======================================*/
    $('#deal-carousel').owlCarousel({
        responsive: {
            0: {
                items: 1
            },
            540: {
                items: 2,  
            },
            768: {
                items: 1,  
            },
            1200: {
                items: 2
            },
        },
        margin: 30,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false,
        lazyLoad: true,
        navSpeed: 500,
    });
    
    /*======================================
    Deal Carousel 2
    ======================================*/
    $('#deal-carousel-2').owlCarousel({
        responsive: {
            0: {
                items: 1
            },
            992: {
                items: 2
            },
            1200: {
                items: 3
            },
        },
        margin: 30,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false,
        lazyLoad: true,
        navSpeed: 500,
    });
    
    /*======================================
    Testimonial Carousel
    ======================================*/
    $('#testimonial-carousel').owlCarousel({
        items: 1,
        nav: false,
        loop: true,
        dots: true,
        lazyLoad: true,
        autoplay: true,
        autoplayTimeout: 10000,
        autoplaySpeed: 2000,
        navSpeed: 2000,
    });
    
    /*======================================
    Category Carousel
    ======================================*/
    $('.cat-carousel').owlCarousel({
        responsive: {
            0: {
                items: 2
            },
            520: {
                items: 1
            },
        },
        margin: 10,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false,
        lazyLoad: true,
        navSpeed: 500,
    });
    
    /*======================================
    Category Carousel
    ======================================*/
    $('.cat-carousel-2').owlCarousel({
        responsive: {
            0: {
                items: 1
            },
            400: {
                items: 2
            },
            992: {
                items: 3
            },
        },
        margin: 10,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false,
        lazyLoad: true,
        navSpeed: 500,
    });
    
    /*======================================
    Brand Carousel
    ======================================*/
    $('#brand-carousel').owlCarousel({
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        },
        margin: 30,
        nav: false,
        dots: false,
        lazyLoad: true,
        autoplay: true,
        autoplayTimeout: 10000,
        autoplaySpeed: 2000,
        navSpeed: 2000,
    });
    
    /*======================================
    Thumb Carousel
    ======================================*/
    $('#small-thumb-carousel').owlCarousel({
        items: 3,
        margin: 15,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false,
        lazyLoad: true,
        navSpeed: 1000,
    });
    
    /*======================================
    Countdown
    ======================================*/
    $('.countdown-time').each(function () {
        var endTime = $(this).data('time');
        $(this).countdown(endTime, function (tm) {
            $(this).html(tm.strftime('<span class="section_count"><span class="tcount days">%D </span><span class="text">Days</span></span><span class="section_count"><span class="tcount hours">%H</span><span class="text">Hours</span></span><span class="section_count"><span class="tcount minutes">%M</span><span class="text">Mins</span></span><span class="section_count"><span class="tcount seconds">%S</span><span class="text">Secs</span></span>'));
        });
    });
    
    /*============================================
		Sidebar Navigation
	============================================*/
    $('.grower').on('click', function () {
        $(this).siblings('.sub-menu').stop().slideToggle();
        $(this).toggleClass('opened');
    });
    
    /*---------------------------------------------------------
    Ecommerce filter
    ---------------------------------------------------------*/
    $('.view-mode').on('click', function (e) {
        e.preventDefault();
        $('.view-mode').removeClass('active');
        var cls = $(this).attr('class').split(' ')[0];
        $(this).addClass('active');
        $('.' + cls).addClass('active');
        $('#product-wrap').removeClass();
        $('#product-wrap').addClass($(this).data('mode'));
    });
    
    $('.input-rule select').on('change', function () {
        $(this).siblings('.input-style').text($(this).children('option:selected').text());
    });
    
    $('.input-rule input[type=checkbox]').on('change', function () {
        if ($(this).is(':checked')) {
            $(this).parent().addClass('selected');
        } else {
            $(this).parent().removeClass('selected');
        }
    });
    
    $('.input-rule input[type=radio]').on('change', function () {
        if ($(this).is(':checked')) {
            $(this).parent().siblings().removeClass('selected');
            $(this).parent().addClass('selected');
        }
    });
    
    $('input[name=color]').on('click', function () {
        $(this).toggleClass('on');
    });
    
    $('input[name=color_order]').on('click', function () {
        $('input[name=color_order]').removeClass('on');
        $(this).addClass('on');
        $('#color_order_input').val($(this).val());
    });
    
    $('.ui-ranger').each(function () {
        var slideDiv = $(this);
        var rupee = String.fromCharCode('8377')+" ";
        $(this).slider({
            range: true,
            min: slideDiv.data('min'),
            max: slideDiv.data('max'),
            step: 0.01,
            values: [slideDiv.data('min'), slideDiv.data('max')],
            slide: function (event, ui) {
                $(this).siblings('input').val(rupee + ui.values[0] + ' - '+ rupee + ui.values[1]);
            }
        });
        $(this).siblings('input').val(rupee + $(this).slider("values", 0) + ".00 - "+ rupee + $(this).slider("values", 1) + ".00");
    });
    
    /*---------------------------------------------------------
    Single Page Thumb
    ---------------------------------------------------------*/
    $('.small-thumb a').on('click', function(sth) {
        sth.preventDefault();
        var imgSrc = $(this).attr('href');
        $('.small-thumb a').removeClass('active');
        $(this).addClass('active');
        $('#main-thumb img').attr('src', imgSrc);
    });
    
    /*---------------------------------------------------------
    Carousel Nav Fix
    ---------------------------------------------------------*/
    function carouselFix(){
        $('.product-carousel').each(function () {
            var offSet = $(this).offset();
            if(offSet.left < 22){
                $(this).addClass('nav-fix');
            } else {
                $(this).removeClass('nav-fix');
            }
        });
        
        if($('#deal-carousel').length > 0){
            var dealNav = $('.deal-carousel .owl-nav > div').offset();
            if(dealNav.left < 0){
                $('.deal-carousel').addClass('deal-fix');
            } else {
                $('.deal-carousel').removeClass('deal-fix');
            }        
        }
    }
    
    carouselFix();
    
    $(window).on('resize orientationchange', function () {
        carouselFix();
    })

});
;
(function ($) {
    "use strict";
    $(document).on('ready', function () {

        var mY = 0;
        $('body').mousemove(function(e) {
            // moving upward
            if (e.pageX < mY) {
                $('.primary-menu ul.nav > li > a').addClass('left-go');
                $('.primary-menu ul.nav > li > a').removeClass('right-go');
            // moving downward
            } else {
                $('.primary-menu ul.nav > li > a').addClass('right-go');
                $('.primary-menu ul.nav > li > a').removeClass('left-go');
            }
            // set new mY after doing test above
            mY = e.pageX;
        });

        $('.header-search').each(function () {
            $('.search-popup-button').on('click', function () {
                $(this).siblings('.popup-search-form').fadeIn();
            });
            $('.popup-search-form .close-form').on('click', function () {
                $(this).parents('.popup-search-form').fadeOut();
            });
        });
        
        $('#mainmenu').slicknav({
            label: '',
            duration: 500,
            prependTo: '',
            closedSymbol: '<i class="flaticon-right-arrow"></i>',
            openedSymbol: '<i class="flaticon-right-arrow"></i>',
            appendTo: '.mainmenu-area',
            menuButton: '#mobile-toggle',
            closeOnClick: 'true' // Close menu when a link is clicked.
        });

        if (typeof imagesLoaded == 'function') {
            $('.masonrys > div').addClass('masonry-item');
            var $boxes = $('.masonry-item');
            $boxes.hide();
            var $container = $('.masonrys');
            $container.imagesLoaded(function () {
                $boxes.fadeIn();
                $container.masonry({
                    itemSelector: '.masonry-item',
                });
            });
        }

        $('.mainmenu-area .primary-menu a[href*="#"]').on('click', function (event) {
            var id = $(this).attr("href");
            var offset = 0;
            var target = $(id).offset().top - offset;
            $('html, body').animate({
                scrollTop: target
            }, 1000 );
            event.preventDefault();
        });

    });
    /* Preloader Js
    ===================*/
    $('.preloader .load-close').on('click',function(){
        $('.preloader').fadeOut(500);
    });
    $(window).on("load", function () {
        $('.preloader').fadeOut(500);
        $('#mainmenu .sub-menu').parent('li').children('a').append('<i class="plus"></i>');
        $(".post-single").fitVids();

        /*-- Drop-Down-Menu--*/
        function dropdown_menu() {            
            var sub_menu = $('.toggle-menu .sub-menu'),
                menu_a = $('.toggle-menu ul li a');
            sub_menu.hide();
            sub_menu.siblings('a').on('click', function () {
                $(this).parent('li').siblings('li').find('.sub-menu').slideUp();
                $(this).siblings('.sub-menu').find('.sub-menu').slideUp();
                $(this).siblings('.sub-menu').slideToggle();
                $(this).parents('li').siblings('li').removeClass('open');
                $(this).siblings('.sub-menu').find('li.open').removeClass('open');
                $(this).parent('li').toggleClass('open');
                return false;
            });
        }
        dropdown_menu();        
        $('.menu-toggle-button.button-active').on( 'click',function(){
            $(this).toggleClass('active');
            $('.toggle-menu').toggleClass('active');
            return false;
        });

    });
})(jQuery);
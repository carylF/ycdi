(function($) {

    var $wn = $(window);

    // USE STRICT
    "use strict";
    $(window).on('load', function() {

        // PRELOADER
        $('#preloader').fadeOut('slow', function() {
            $(this).remove();
        });

        /* ------------------------------------------------------------------------- *
             * TOGGLE HEADER CLASS ON SCROLL
             * ------------------------------------------------------------------------- */
            var tClass = function( pos, $el, value, height ) {
                if ( $wn.scrollTop() > height ) {
                    $el.addClass( value );
                    $( '.static-header' )
                        .css( 'height', height );
                }
                else {
                    $el.removeClass( value );
                    $( '.static-header' )
                        .css( 'height', height );
                }
            };
            /* ------------------------------------------------------------------------- *
             * HEADER STICKY
             * ------------------------------------------------------------------------- */
            var $hEl = $( '.sticky-header' );
            var header_height = $hEl.outerHeight()
            tClass( $hEl.outerHeight(), $hEl, 'sticky', header_height );
            $wn.on( 'scroll', function() {
                /* HEADER STICKY */
                tClass( $hEl.outerHeight(), $hEl, 'sticky', header_height ); // TOGGLE CLASS ON SCROLL
            } );




        // PORTFOLIO
        var $grid = $('.grid');
        $grid.imagesLoaded(function() {
            $grid.isotope({
                itemSelector: '.portfolio-item',
                percentPosition: true,
                masonry: {
                    // use outer width of grid-sizer for columnWidth
                    columnWidth: '.portfolio-item'
                }
            })
        });

        // filter items on button click
        $('.portfolio-menu').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });


        /* for active class in filter menu  */
        $('.portfolio-menu button').on('click', function(event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });

        // RESPONSIVE MENU

        jQuery('.menu nav').meanmenu({
            meanMenuContainer: '.menu',
            meanScreenWidth: "767",
        });

        // TESTIMONIALS SLIDER

        $('.testimonial-active').owlCarousel({
            loop: true,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })


        // CLIENTS SLIDER

        $('.client-active').owlCarousel({
            loop: true,
            nav: false,
            dots: false,
            animateOut: 'fadeOut',
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });

        // CONATCT FORM 

        var $contactForm = $('#form'),
            $contactFormStatus = $('.contact-form-message');

        if ($contactForm.length) {
            $contactForm.validate({
                rules: {
                    u_name: {
                        required: true
                    },
                    u_email: {
                        required: true,
                        minlength: 5,
                        email: true
                    },
                    u_subject: {
                        required: true
                    },
                    message: {
                        required: true
                    }
                },
                submitHandler: function(e) {
                    var $t = $(e);

                    $.ajax({
                        type: 'POST',
                        url: $t.attr('action'),
                        data: $t.serialize(),
                        success: function(res) {
                            $contactFormStatus.show().html(res).delay(1000).fadeOut("slow");
                        }
                    });
                }
            });
        }

        // LIGHTBOX
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })


        // PROJECT TIMER
        var timer = $('.timer');
        if (timer.length) {
            timer.appear(function() {
                timer.countTo();
            })
        }


        // HOME SLIDER
        var owl = $('#slider');

        // Carousel initialization
        owl.owlCarousel({
            loop: true,
            margin: 0,
            navSpeed: 50,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            nav: false,
            items: 1,
            autoplay: true
        });


        // ONEPAGE EASY SCROLL
        $(window).scroll(function(event) {
            Scroll();
        });

        $('.menu-onepage li a').click(function() {
            $('html, body').animate({
                scrollTop: $(this.hash).offset().top - header_height
            }, 1000);
            return false;
        });

        // User define function
        function Scroll() {
            var contentTop = [];
            var contentBottom = [];
            var winTop = $(window).scrollTop();
            var rangeTop = 200;
            var rangeBottom = 500;
            $('.menu').find('.scroll a').each(function() {
                contentTop.push($($(this).attr('href')).offset().top);
                contentBottom.push($($(this).attr('href')).offset().top + $($(this).attr('href')).height());
            })
            $.each(contentTop, function(i) {
                if (winTop > contentTop[i] - rangeTop) {
                    $('.menu li.scroll')
                        .removeClass('active')
                        .eq(i).addClass('active');
                }
            })

        };



    });
})(jQuery);
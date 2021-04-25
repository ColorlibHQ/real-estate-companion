(function ($) {
    'use strict';

    if ($.fn.owlCarousel) {
        $(".hero-slides").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 0,
            dots: false,
            nav: true,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>']
        });
    }

    if ($.fn.owlCarousel) {
        $(".real_estate-service-slides").owlCarousel({
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 30,
            center: true,
            dots: false,
            nav: true,
            startPosition: 1,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
    }

    if ($.fn.owlCarousel) {
        $(".real_estate-workflow-slides").owlCarousel({
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 30,
            center: true,
            dots: true,
            startPosition: 1,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
    }

    if ($.fn.owlCarousel) {
        $(".real_estate-team-slides").owlCarousel({
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 50,
            center: true,
            nav: true,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
    }

    if ($.fn.owlCarousel) {
        $(".testimonials-slides").owlCarousel({
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 1500,
            margin: 0,
            center: true,
            nav: true,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
    }

    if ($.fn.barfiller) {

        $('.bar').each(  function(){
            var $this = $(this),
                $color = $this.data('color');
                 
            $this.barfiller({
                tooltip: true,
                duration: 1000,
                barColor: $color,
                animateOnResize: true
            });


        })

    }
    if ($.fn.imagesLoaded) {
        $('.real_estate-portfolio').imagesLoaded(function () {
            // filter items on button click
            $('.portfolio-menu').on('click', 'p', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });
            // init Isotope
            var $grid = $('.real_estate-portfolio').isotope({
                itemSelector: '.single_gallery_item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.single_gallery_item'
                }
            });
        });
    }

    $('.portfolio-menu button.btn').on('click', function () {
        $('.portfolio-menu button.btn').removeClass('active');
        $(this).addClass('active');
    })
    if ($.fn.scrollUp) {
        $.scrollUp({
            scrollSpeed: 1500,
            scrollText: '<i class="fa fa-angle-up"></i>'
        });
    }

    if ($.fn.counterUp) {
        $('.counter').counterUp({
            delay: 10,
            time: 2000
        });
    }


    if ( $('#clock').length > 0 ) {
        var clock = $('#clock');
        var eventTime = clock.data('event-time');
        clock.countdown(eventTime, function (event) {
            $(this).html(event.strftime(
                '<div class="countdown_wrap d-flex"><div  class="single_countdown"><h3>%D</h3><span>Days</span></div><div class="single_countdown"><h3>%H</h3><span>Hours</span></div><div class="single_countdown"><h3>%M</h3><span>Minutes</span></div><div class="single_countdown"><h3>%S</h3><span>Seconds</span></div></div>'
            ));
        });
    }

    // Background video
    var $selector = $('[data-videoid]');

    if( $selector.length ){
        $selector.each( function(){
            var $this = $(this);
            $this.YTPlayer({
                fitToBackground: true,
                videoId: $this.data('videoid')
            });
        });
    }
    
    // MC Scripts
    var $subscribe = $( '.real_estate-subscribe-newsletter-area' );
    if( $subscribe.length ){
        window.fnames = new Array();
        window.ftypes = new Array();
        fnames[0]='EMAIL';
        ftypes[0]='email';
        fnames[1]='FNAME';
        ftypes[1]='text';
        fnames[2]='LNAME';
        ftypes[2]='text';
        fnames[3]='ADDRESS';
        ftypes[3]='address';
        fnames[4]='PHONE';
        ftypes[4]='phone';
        fnames[5]='BIRTHDAY';
        ftypes[5]='birthday';
    }


    // Search properties
    var $form = $( '.search-properties-form' );
    if( $form.length ){
        var searchBtn = $( '.search-properties-form .serach_icon > a' );
        searchBtn.click(function(event){
            event.preventDefault();
            var target_heading_tag = $('.popular_property .section_title h4');
            var prop_loc = $('.search-properties-form .prop-loc .nice-select .current').text();
            var prop_type = $('.search-properties-form .prop-type .nice-select .current').text();
            var price_min = $('.search-properties-form .range_slider .price-range-min').text();
            var price_max = $('.search-properties-form .range_slider .price-range-max').text();
            var bed_room = $('.search-properties-form .bed-room .nice-select .current').text();
            var bath_room = $('.search-properties-form .bath-room .nice-select .current').text();

            target_heading_tag.text( 'Loading...' );
            // Custom function for displaying message
            function add_message(message, type){
                var html = "<div class='alert alert-"+type+"'>" + message + "</div>";
                $(".jam-confirmation-message").empty().append(html);
                $(".jam-confirmation-message").fadeIn();
            }
             
            // Getting values from the form
            var nonce       = $("#_wpnonce").val();
            var prop_loc    = prop_loc;
            var prop_type   = prop_type;
            var price_min   = price_min;
            var price_max   = price_max;
            var bed_room    = bed_room;
            var bath_room   = bath_room;
            var data        = new FormData();
            data.append('action', 'prop_datas' );
            data.append('nonce', nonce );
            data.append('prop_loc', prop_loc );
            data.append('prop_type', prop_type );
            data.append('price_min', price_min );
            data.append('price_max', price_max );
            data.append('bed_room', bed_room );
            data.append('bath_room', bath_room );
            $.ajax({ 
                url: prop_datas.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: data,
                nonce: nonce,
                processData: false,
                contentType: false, 
                cache: false,
                success: function(data) {                   
                    $( '.popular_property .our-contents' ).html( data );
                    var search_result_count = $('.popular_property .our-contents .total-search-count').data('total-search-count');
                    // console.log(search_result_count);
                    if ( search_result_count > 0 ) {
                        target_heading_tag.text( search_result_count + ' Properties found' );
                    } else {
                        target_heading_tag.text('');
                    }
                }
            })
            
            // Error 
            .fail( function() {
                add_message(data.message ? data.message: 'Sorry! Something went wrong.', 'danger');
            })

            // Reset all fields
            // .always( function() {
            //     event.target.reset();
            // });
        
        });
    }


})(jQuery);
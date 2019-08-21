/**
 * Trid Carousel
 * Pages: home-1
 * Path: resources/assets/scripts/carousel/carousel-home-trid.js
 */
jQuery(document).ready(function($) {
    var owl = $("#carousel-home-third .owl-carousel");
    $(window).bind("vc_js", function() {
        owl.trigger('refresh.owl.carousel')
    });
    var options = {
        rtl: $('body').hasClass('rtl'),
        items: 4,
        responsive: {
            979: {
                items: 4
            },
            768: {
                items: 3
            },
            479: {
                items: 3
            },
            0: {
                items: 2
            }
        },
        autoplay: !1,
        autoplayTimeout: 5000,
        dots: !1,
        nav: !0,
        autoheight: !0,
        slideBy: 'page',
        center: !1,
        navText: !1,
        loop: !1,
        onRefreshed: function() {
            $(window).resize()
        }
    };
    owl.owlCarousel(options)
});
jQuery(document).ready(function() {
    var scrollMenu = function() {
        var scrollMenu = jQuery('.dropdown-scroll > .sub-menu-dropdown');

        scrollMenu.each(function() {
            var $this = jQuery(this);
            var innerContent = $this.find('> .container');

            $this.on('mousemove', function(e) {
                var parentOffset = $this.offset();
                //or $(this).offset(); if you really just want the current element's offset
                var relY = e.pageY - parentOffset.top;

                var deltaHeight = innerContent.outerHeight() - $this.height();

                if( deltaHeight < 0 ) return;

                var percentY = relY / $this.height();

                var margin = 0;

                if( percentY <= 0 ) {
                    margin = 0;
                } else if( percentY >= 1 ) {
                    margin = - deltaHeight;
                } else {
                    margin = - percentY * deltaHeight;
                }

                margin = parseInt(margin);

                innerContent.css({
                    'position': 'relative',
                    'top': margin
                });
            });
        });

    }

    setTimeout(function() {
        scrollMenu();
    }, 1000);

    scrollMenu();

    function lazyload(){
        var lazy = jQuery( '.basel-lasy-image' );

        lazy.each( function() {
            var _this = jQuery( this ),
                ImageSrc = _this.data( 'blazy-src' );

            if ( !_this.parent().hasClass( 'blazy-image-loaded' ) ) {
                _this.attr( 'src', ImageSrc );
                _this.parent().addClass('blazy-image-loading');
                _this.on('load', function() {
                    _this.parent().removeClass('blazy-image-loading');
                    _this.parent().addClass( 'blazy-image-loaded' );
                })
            }
        })

    }
    jQuery( document ).on( 'mouseenter mouseleave mousemove','.dropdown-scroll', function( e ) {
        lazyload();
    });

    var onePageMenuFix = function() {

        var scrollToRow = function(hash) {
            var row = jQuery('#' + hash);

            if( row.length < 1 ) return;

            var position = row.offset().top;

            jQuery('html, body').stop().animate({
                scrollTop: position - basel_settings.one_page_menu_offset
            }, 800, function() {
                activeMenuItem(hash);
            });
        };

        var activeMenuItem = function(hash) {
            var itemHash;
            jQuery('.onepage-link').each(function() {
                itemHash = jQuery(this).find('> a').attr('href').split('#')[1];

                if( itemHash == hash ) {
                    jQuery('.onepage-link').removeClass('current-menu-item');
                    jQuery(this).addClass('current-menu-item');
                }

            });
        };

        jQuery('body').on('click', '.onepage-link > a', function(e) {
            var jQuerythis = jQuery(this),
                hash = jQuerythis.attr('href').split('#')[1];

            if( jQuery('#' + hash).length < 1 ) return;

            e.preventDefault();

            scrollToRow(hash);

            // close mobile menu
            jQuery('.basel-close-side').trigger('click');
        });

        if( jQuery('.onepage-link').length > 0 ) {
            jQuery('.entry-content > .vc_section, .entry-content > .vc_row').waypoint(function () {
                var hash = jQuery(this).attr('id');
                activeMenuItem(hash);
            }, { offset: 0 });

            // jQuery('.onepage-link').removeClass('current-menu-item');


            // URL contains hash
            var locationHash = window.location.hash.split('#')[1];

            if(window.location.hash.length > 1) {
                setTimeout(function(){
                    scrollToRow(locationHash);
                }, 500);
            }

        }
    };
    onePageMenuFix();
});
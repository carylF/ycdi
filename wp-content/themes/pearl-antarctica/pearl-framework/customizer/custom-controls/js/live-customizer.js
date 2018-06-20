(function( $ ) {
    "use strict";


    /**
     * Banner Settings - Blog Single Page
     */

    // banner space top
    wp.customize( 'pearl_blog_banner_padding', function( value ) {
        value.bind( function( newVal ) {
            var $body_width = $( 'body.customize-partial-edit-shortcuts-shown' ).width();
            if ( $body_width > 1200 ) {
                $( '.single-post .sub-header' ).css( {
                    'padding-top': newVal + 'px'
                } );
            }
        } );
    });

    // banner space bottom
    wp.customize( 'pearl_blog_banner_padding_bottom', function( value ) {
        value.bind( function( newVal ) {
            var $body_width = $( 'body.customize-partial-edit-shortcuts-shown' ).width();
            if ( $body_width > 1200 ) {
                $( '.single-post .sub-header' ).css( {
                    'padding-bottom': newVal + 'px'
                } );
            }
        } );
    });

    // banner overlay opacity
    wp.customize( 'pearl_blog_banner_overlay', function( value ) {
        value.bind( function( newVal ) {
            newVal = ( newVal * 100 ) / 100;
            if ( newVal > 99 ) {
                newVal = 1;
            } else {
                newVal = '0.' + newVal;
            }
           $('.single-post .sub-header .bg-overlay').css('background', 'rgba(23, 32, 37, ' + newVal + ')' );
        } );
    });

    /**
     * Banner Settings - Portfolio Single Page
     */

    // banner space top
    wp.customize( 'pearl_portfolio_banner_padding', function( value ) {
        value.bind( function( newVal ) {
            var $body_width = $( 'body.customize-partial-edit-shortcuts-shown' ).width();
            if ( $body_width > 1200 ) {
                $( '.single-portfolio .sub-header' ).css( {
                    'padding-top': newVal + 'px'
                } );
            }
        } );
    });

    // banner space bottom
    wp.customize( 'pearl_portfolio_banner_padding_bottom', function( value ) {
        value.bind( function( newVal ) {
            var $body_width = $( 'body.customize-partial-edit-shortcuts-shown' ).width();
            if ( $body_width > 1200 ) {
                $( '.single-portfolio .sub-header' ).css( {
                    'padding-bottom': newVal + 'px'
                } );
            }
        } );
    });

    // banner overlay opacity
    wp.customize( 'pearl_portfolio_banner_overlay', function( value ) {
        value.bind( function( newVal ) {
            newVal = ( newVal * 100 ) / 100;
            if ( newVal > 99 ) {
                newVal = 1;
            } else {
                newVal = '0.' + newVal;
            }
            $('.single-portfolio .sub-header .bg-overlay').css('background', 'rgba(23, 32, 37, ' + newVal + ')' );
        } );
    });


    /**
     * Footer Settings
     */

    // call to action text
    wp.customize( 'pearl_footer_call_action_text', function( value ) {
        value.bind( function( newVal ) {
            $( '.call-to-action p' ).text(newVal);
        } );
    });

})( jQuery );
define(['jquery'], function( $ ) {

	var fixElements = {};

	fixElements.init = function() {
		fixElements.fixScroll();
		fixElements.fixHeader();

		$( 'nav.main .top li a' ).on( 'click', function() {
			var target = $( this ).attr( 'href' );
			var navHeight = $( "nav .top" ).height() - 1;
			// fix scroll offset if the link is triggered from the top of the page
			if ( $( window ).scrollTop() < 150 ) navHeight = 136;

			if ( $( target ).length > 0 ) {
				$( 'html, body' ).animate({
					scrollTop: $( target ).offset().top - navHeight
				}, 600 );
			}

			return false;
		});

		/*
		 *	Watch Scroll
		*/
		$( window ).scroll( function() {
			fixElements.fixScroll();
		});

		$( window ).resize( function() {
			fixElements.fixHeader();
		});

		// console.log('fixScroll ready');
	};

	fixElements.fixScroll = function() {
		var scroll = $( window ).scrollTop();

		// Navbar
		if ( scroll > 150 ) {
			if ( !( $( 'body' ).hasClass( 'fixed' ) ) ) {
				$( 'body' ).addClass( 'fixed' );
			}
		}
		else {
			if ( $( 'body' ).hasClass( 'fixed' ) ) {
				$( 'body' ).removeClass( 'fixed' );
			}
		}
		// ScrollTop
		if ( scroll > 350 ) {
			if ( !( $( '#scrollToTop' ).is( ':visible' ) ) ) {
				$( '#scrollToTop' ).fadeIn();
			}
		}
		else {
			if ( $( '#scrollToTop' ).is( ':visible' ) ) {
				$( '#scrollToTop' ).fadeOut();
			}
		}
	};

	fixElements.fixHeader = function() {
		var windowWidth = $( window ).width();

		if ( windowWidth < 992 ) {
			if ( windowWidth < 600 ) {
				$( 'body' ).addClass( 'mobile' );
				$( 'body' ).removeClass( 'tablet' );
			}
			else {
				$( 'body' ).addClass( 'tablet' );
				$( 'body' ).removeClass( 'mobile' );
			}
		}
		else {
			$( 'body' ).removeClass( 'tablet' );
			$( 'body' ).removeClass( 'mobile' );
			$( 'body' ).removeClass( 'menu-open' );
		}
	};

	return fixElements;
});

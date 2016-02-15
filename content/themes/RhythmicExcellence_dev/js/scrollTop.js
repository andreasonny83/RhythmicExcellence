define(['jquery'], function($) {

	var scrollTop = {};

	scrollTop.init = function() {
		//BackToTop
		$( '#scrollToTop' ).on( 'click', function() {
			$( 'html, body' ).animate({
				scrollTop: 0
			}, 600 );

			return false;
		});

		// console.log('scrollTop ready');
	};

	return scrollTop;
});

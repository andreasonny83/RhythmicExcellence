define( ['jquery'], function( $ ) {

	var responsiveMenu = {};

	responsiveMenu.init = function() {

		$( '#responsive-menu' ).click( function() {
			$( 'body' ).toggleClass( 'menu-open' );

			return false;
		});

		// console.log('responsiveMenu ready');
	};

	return responsiveMenu;
});

// Filename: app.js
define([
	'jquery',
	'fixImages',
	'readMore',
	'fixScroll',
	'responsiveMenu',
	'scrollTop',
	'submitForm',
	'maps'
],
function( $, fixImages, readMore, fixScroll, responsiveMenu, scrollTop, submitForm, gMap ) {

	var initialize = function() {
		fixImages.init();
		readMore.init();
		fixScroll.init();
		responsiveMenu.init();
		scrollTop.init();
		submitForm.init();

		// GoogleMap
		if ( $( '#map-canvas' ).length ) {
			gMap.init();
		}

		console.log('app initialised');
	};

	return {
		initialize: initialize
	};
});

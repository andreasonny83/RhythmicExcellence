var fixImages = {};

fixImages.init = function() {
	// Add caption to images
	$( 'img' ).each( function() {
		if ( $( this ).attr( 'alt' ) ) {
			var caption =  $( this ).attr( 'alt' );
			$( this ).wrap( '<div class="caption-image"></div>');
			$( this ).after(
				'<span class="caption">' +
				caption +
				'</span>');
		}
	});
};

define( ['jquery'], function( $ ) {

	var readMore = {};

	readMore.init = function() {
		// Expand the box when a Team member is clicked
		$( '#aboutus .boxed:not(.popupBox)' ).on( 'click', function() {
			$box = $( this ).parent().clone();
			$box.addClass( 'openFull' );
			$( '#aboutus' ).append( $box );
			$box.find( '.boxed' ).addClass( 'popupBox' ).append( '<div class="closeBox">X</div>' );
			$( 'body' ).css( 'overflow', 'hidden' );

			return false;
		});

		$( 'body' ).on( 'click', '.popupBox', function() {
			return false;
		});

		// close the pop up box when click the X
		$( 'body' ).on( 'click', '.closeBox', function() {
			$( '.openFull .popupBox' ).addClass( 'die' );
			setTimeout(function() {
				$( '.openFull' ).remove();
			}, 1500 );
			$( 'body' ).css( 'overflow', 'initial' );

			return false;
		});

		// close the pop up box when click on the gray background
		$( 'body' ).on( 'click', '.openFull', function() {
			$( this ).find( '.popupBox' ).addClass( 'die' );
			setTimeout(function() {
				$( '.openFull' ).remove();
			}, 1500 );
			$( 'body' ).css( 'overflow', 'initial' );
		});

		// console.log('readMore ready');
	};

	return readMore;
});

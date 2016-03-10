var responsiveMenu = {};

responsiveMenu.init = function() {

  $( '#responsive-menu' ).click( function() {
    $( 'body' ).toggleClass( 'menu-open' );

    return false;
  });
};

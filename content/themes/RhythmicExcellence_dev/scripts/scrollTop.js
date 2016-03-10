/**
* scrollTop
* @type {Object}
*/

var scrollTop = (function() {
  'use strict';

  return {
    init: init
  };

  function init() {
    $( '#scrollToTop' ).on( 'click', function() {
      $( 'html, body' ).animate({
        scrollTop: 0
      }, 600 );

      return false;
    });
  }

}());

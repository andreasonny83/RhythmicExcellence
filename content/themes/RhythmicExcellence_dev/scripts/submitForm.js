var submitForm = {};

submitForm.init = function() {
  this.watchToast();
  this.watchForm();
  this.fireToast();
};

submitForm.fireToast = function() {
  // If a new toas is detected on the page
  // Show the message on screen
  $( '.message_result' ).each( function() {
    setTimeout( function() {
      $( '.message_result' ).fadeOut(function() {
        this.remove();
      });
    }, 3000 );
  });
};

submitForm.watchToast = function() {
  // If a toast is present in the DOM,
  // show the toast message for 3 seconds
  $( 'body ').on( 'DOMNodeInserted', function ( e ) {
    var target = e.target;

    if ( $( target ).hasClass( 'message_result' ) ) {
      submitForm.fireToast();
    }
  });
};

submitForm.formValidation = function() {
  // Perform some form validation
  // Before sending the information across
  var name    = $( '#contact_form #name' ).val();
  var mail    = $( '#contact_form #email' ).val();
  var message = $( '#contact_form #message' ).val();

  var nameReg = /^[A-Za-z]+$/;
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

  if( name === "" ) {
    submitForm.generateToast( 'You must enter your name before sending a message.', 'info' );
    $( '#contact_form #name' ).focus();
    $( '#contact_form #name' ).addClass( 'error' );

    return false;
  }
  else if( mail === "" ) {
    submitForm.generateToast( 'You must enter your e-mail before sending a message.', 'info' );
    $( '#contact_form #email' ).focus();
    $( '#contact_form #email' ).addClass( 'error' );

    return false;
  }
  else if( message === "" ) {
    submitForm.generateToast( 'You must enter a message.', 'info' );
    $( '#contact_form #message' ).focus();
    $( '#contact_form #message' ).addClass( 'error' );

    return false;
  }
  else if( !nameReg.test( name ) ) {
    submitForm.generateToast( 'Your name should be letters only.', 'error' );
    $( '#contact_form #name' ).focus();
    $( '#contact_form #name' ).addClass( 'error' );

    return false;
  }
  else if( !emailReg.test( mail ) ) {
    submitForm.generateToast( 'Your email address is not valid. Please try again.', 'error' );
    $( '#contact_form #email' ).focus();
    $( '#contact_form #email' ).addClass( 'error' );

    return false;
  }

  else {
    return true;
  }
};

submitForm.watchForm = function() {
  // Watch the Contact Form
  $( '#contact_form .textarea' ).keyup( function() {
    if( $( this ).hasClass( 'error' ) ) {
      $( this ).removeClass( 'error' );
    }
  });

  $( '#contact_form' ).on( 'submit', function( event ) {
    if ( submitForm.formValidation() === false ) {
      event.preventDefault();
    }
  });
};

submitForm.generateToast = function( message, level ) {
  // Attach a Toast to the DOM
  var toast = '<div class="message_result ' + level + '">' + message + '</div>';
  $( 'body' ).append( toast );
};

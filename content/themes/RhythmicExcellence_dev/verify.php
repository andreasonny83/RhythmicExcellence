<?php
if ( !empty( $_POST ) ) {
	$email_response = validate_and_send();

	echo '<div class="message_result ' . $email_response['status'] . '">' . $email_response['message'] . '</div>';
}

function validate_and_send() {
	$validation = validate_informations();

	if ( $validation && $validation['validate'] === true ) {
		send_email( $validation );
		return array (
			'status'  => 'positive',
			'message' => 'Message delivered.',
		);
	}

	else {
		return array (
			'status'  => 'error',
			'message' => 'The message has not been delivered, please try again or contact the website admin.',
		);
	}
}

function test_input( $input ) {
	$input = htmlspecialchars( $input );
	$input = htmlspecialchars( $input );
	$input = trim( $input );
	$input = stripslashes( $input );
	return $input;
}

function validate_informations() {
	$data = array();
	$data['validate'] = false;
	$data['now'] = date( 'F j, Y, g:i a' );

	if ( isset( $_POST['form_contact_submit'] ) ) {

		if ( empty( $_POST['form_name'] ) ) {
			return 0;
		}
		if ( empty( $_POST['form_email'] ) ) {
			return 0;
		}
		if ( empty( $_POST['form_message'] ) ) {
			return 0;
		}

		$data['name']    = test_input( $_POST['form_name'] );
		$data['email']   = test_input( $_POST['form_email'] );
		$data['message'] = test_input( $_POST['form_message'] );

		// Only letters and white space allowed
		if ( !preg_match( '/^[a-zA-Z ]*$/', $data['name'] ) ) {
			return 0;
		}
		// Test email address
		if ( !filter_var( $data['email'], FILTER_VALIDATE_EMAIL ) ) {
			return 0;
		}
		// reCaptcha validation
		$recaptchaResponse = $_POST['g-recaptcha-response'];
		$request  = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret=' . G_RE_CAPTCHA_SECRET_KEY . '&response=' . $recaptchaResponse );
		$response = json_decode( $request ); // This will decode JSON to object
		if ( !$response->success ) {
			return 0;
		}

		$data['validate'] = true;
		return $data;
	}

	return 0;
}

function send_email( $data ) {
	$message = '
	<html>
	<head>
	<title>RhythmicExcellence.london</title>
	</head>
	<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
	<center>
	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
	<tr>
	<td align="center" valign="top" style="padding-bottom:40px;">
	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
	<tr>
	<td align="center" valign="top" style="padding-bottom:20px;">
	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templatePreheader">
	</table>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top">
	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader">
	<tr>
	<td align="center" valign="top" style="padding-top:20px; padding-bottom:20px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td class="headerContent" mc:edit="header_content"><h1>Hi RhythmicExcellence,<br>
	<span style="font-size:30px">' . $data['name'] . ' has just left you a message:</span></h1>
	<br>
	Date: ' . $data['now'] . '<br>
	From: ' . $data['email'] . '</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top">
	<table border="0" cellpadding="40" cellspacing="0" width="600" id="templateBody">
	<tr>
	<td align="center" valign="top" style="padding-top:20px; padding-bottom:20px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td valign="top" class="upperBodyContent" mc:edit="body_content01">' . $data['message'] . '</td>
	</tr>

	</table>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top">
	<table border="0" cellpadding="20" cellspacing="0" width="600" id="templateFooter">
	<tr>
	<td align="center" valign="top" style="padding-right:40px; padding-left:40px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td valign="top" class="footerContent" style="border-top:1px solid #BBBBBB; padding-top:20px;" mc:edit="footer_social"></td>
	</tr>
	<tr>
	<td valign="top" class="footerContent" style="padding-top:20px;" mc:edit="footer_utility">E-mail sent from <a href="http://www.rhythmicexcellence.london" target="_blank">www.rhythmicexcellence.london</a><br>
	If you do not wish to continue receiving this messages or for other queries, plase contact your web admin at: <a href="mailto:andreasonny83@gmail.com" target="_blank">andreasonny83@gmail.com</a></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</center>
	</body>
	</html>
	';

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: RhythmicExcellence.london' . "\r\n";
	$subject  = 'RhythmicExcellence.london';
	$to       = 'rhythmicexcellence@gmail.com';
	// $admin    = 'andreasonny83@gmail.com';

	$send_contact = mail( $to, $subject, $message, $headers );
	// send to admin a copy
	// if ( isset( $admin ) ) {
	// 	mail( $admin, $subject, $message, $headers );
	// }
}

?>

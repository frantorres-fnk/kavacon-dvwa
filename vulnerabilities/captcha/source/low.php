<?php

if( isset( $_POST[ 'Change' ] ) && ( ( $_POST[ 'step' ] ?? '' ) == '1' ) ) {
	// Hide the CAPTCHA form
	$hide_form = true;

	// Get input
	$pass_new  = $_POST[ 'password_new' ] ?? '';
	$pass_conf = $_POST[ 'password_conf' ] ?? '';

	// Check CAPTCHA from 3rd party
	$resp = recaptcha_check_answer(
		$_DVWA[ 'recaptcha_private_key' ],
		$_POST[ 'g-recaptcha-response' ] ?? ''
	);

	// Did the CAPTCHA fail?
	if( !$resp ) {
		// What happens when the CAPTCHA was entered incorrectly
		$html     .= "<pre><br />The CAPTCHA was incorrect. Please try again.</pre>";
		$hide_form = false;
		return;
	}
	else {
		// CAPTCHA was correct. Do both new passwords match?
		if( $pass_new == $pass_conf ) {
			// Remember on the server, not in the form, that this session passed the CAPTCHA for this password
			$_SESSION[ 'captcha_passed_password' ] = md5( $pass_new );

			// Show next stage for the user
			$html .= "
				<pre><br />You passed the CAPTCHA! Click the button to confirm your changes.<br /></pre>
				<form action=\"#\" method=\"POST\">
					<input type=\"hidden\" name=\"step\" value=\"2\" />
					<input type=\"submit\" name=\"Change\" value=\"Change\" />
				</form>";
		}
		else {
			// Both new passwords do not match.
			$html     .= "<pre>Both passwords must match.</pre>";
			$hide_form = false;
		}
	}
}

if( isset( $_POST[ 'Change' ] ) && ( ( $_POST[ 'step' ] ?? '' ) == '2' ) ) {
	// Hide the CAPTCHA form
	$hide_form = true;

	// Only a session that passed the CAPTCHA in step 1 can confirm, once, the password chosen there
	if( !isset( $_SESSION[ 'captcha_passed_password' ] ) ) {
		$html     .= "<pre><br />You have not passed the CAPTCHA.</pre>";
		$hide_form = false;
		return;
	}
	$pass_new = $_SESSION[ 'captcha_passed_password' ];
	unset( $_SESSION[ 'captcha_passed_password' ] );

	// Update database
	$current_user = dvwaCurrentUser();
	$data = $db->prepare( 'UPDATE users SET password = (:password) WHERE user = (:user);' );
	$data->bindParam( ':password', $pass_new, PDO::PARAM_STR );
	$data->bindParam( ':user', $current_user, PDO::PARAM_STR );
	$data->execute();

	// Feedback for the end user
	$html .= "<pre>Password Changed.</pre>";
}

?>

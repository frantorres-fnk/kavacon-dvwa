<?php

if( isset( $_GET[ 'Login' ] ) ) {
	// Get input
	$user = $_GET[ 'username' ] ?? '';
	$pass = $_GET[ 'password' ] ?? '';

	// Bound parameters, and a per-account lockout after repeated failures
	$row = dvwaBruteForceLogin( $user, $pass );
	if( $row !== false ) {
		// Get users details
		$name   = htmlspecialchars( $row[ 'user' ] );
		$avatar = htmlspecialchars( $row[ 'avatar' ] );

		// Login successful
		$html .= "<p>Welcome to the password protected area {$name}</p>";
		$html .= "<img src=\"{$avatar}\" />";
	}
	else {
		// Login failed (also while the account is locked, so the lockout does not reveal valid usernames)
		sleep( 2 );
		$html .= "<pre><br />Username and/or password incorrect.</pre>";
	}

	((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
}

?>

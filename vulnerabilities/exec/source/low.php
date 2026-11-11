<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
	// Get input
	$target = $_REQUEST[ 'ip' ];

	// Only a literal IP address is accepted, and ping runs without a shell.
	$cmd = dvwaPing( $target );

	// Feedback for the end user
	if( $cmd === false ) {
		$html .= '<pre>ERROR: You have entered an invalid IP.</pre>';
	}
	else {
		$html .= '<pre>' . htmlspecialchars( $cmd ) . '</pre>';
	}
}

?>

<?php

header ("X-XSS-Protection: 0");

// Is there any input?
if( array_key_exists( "name", $_GET ) && is_string( $_GET[ 'name' ] ) && $_GET[ 'name' ] != NULL ) {
	// Feedback for end user
	$html .= '<pre>Hello ' . htmlspecialchars( $_GET[ 'name' ], ENT_QUOTES ) . '</pre>';
}

?>

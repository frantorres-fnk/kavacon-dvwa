<?php

if( isset( $_GET[ 'Submit' ] ) ) {
	// Get input
	$id = $_GET[ 'id' ];

	// The id is bound as an integer parameter, so it can never change the query
	$exists = count( dvwaUserLookup( $id ) ) > 0;
	if( $_DVWA[ 'SQLI_DB' ] == MYSQL ) {
		mysqli_close( $GLOBALS[ "___mysqli_ston" ] );
	}

	if( $exists ) {
		// Feedback for end user
		$html .= '<pre>User ID exists in the database.</pre>';
	}
	else {
		// User wasn't found, so the page wasn't!
		header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 404 Not Found' );

		// Feedback for end user
		$html .= '<pre>User ID is MISSING from the database.</pre>';
	}
}

?>

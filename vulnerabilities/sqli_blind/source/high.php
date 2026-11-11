<?php

if( isset( $_COOKIE[ 'id' ] ) ) {
	// Get input
	$id = $_COOKIE[ 'id' ];

	// The id is bound as an integer parameter, so it can never change the query
	$exists = count( dvwaUserLookup( $id, true ) ) > 0;
	if( $_DVWA[ 'SQLI_DB' ] == MYSQL ) {
		mysqli_close( $GLOBALS[ "___mysqli_ston" ] );
	}

	if( $exists ) {
		// Feedback for end user
		$html .= '<pre>User ID exists in the database.</pre>';
	}
	else {
		// Might sleep a random amount
		if( rand( 0, 5 ) == 3 ) {
			sleep( rand( 2, 4 ) );
		}

		// User wasn't found, so the page wasn't!
		header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 404 Not Found' );

		// Feedback for end user
		$html .= '<pre>User ID is MISSING from the database.</pre>';
	}
}

?>

<?php

if( isset( $_REQUEST[ 'Submit' ] ) ) {
	// Get input
	$id = $_REQUEST[ 'id' ];

	// The id is bound as an integer parameter, so it can never change the query
	foreach( dvwaUserLookup( $id ) as $row ) {
		// Get values
		$first = htmlspecialchars( $row[ 'first_name' ] );
		$last  = htmlspecialchars( $row[ 'last_name' ] );

		// Feedback for end user
		$html .= '<pre>ID: ' . htmlspecialchars( $id ) . "<br />First name: {$first}<br />Surname: {$last}</pre>";
	}

	if( $_DVWA[ 'SQLI_DB' ] == MYSQL ) {
		mysqli_close( $GLOBALS[ "___mysqli_ston" ] );
	}
}

?>

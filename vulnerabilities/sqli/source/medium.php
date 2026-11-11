<?php

if( isset( $_POST[ 'Submit' ] ) ) {
	// Get input
	$id = $_POST[ 'id' ];

	// The id is bound as an integer parameter, so it can never change the query
	foreach( dvwaUserLookup( $id ) as $row ) {
		// Get values
		$first = htmlspecialchars( $row[ 'first_name' ] );
		$last  = htmlspecialchars( $row[ 'last_name' ] );

		// Feedback for end user
		$html .= '<pre>ID: ' . htmlspecialchars( $id ) . "<br />First name: {$first}<br />Surname: {$last}</pre>";
	}
}

// This is used later on in the index.php page
// Setting it here so we can close the database connection in here like in the rest of the source scripts
$query  = "SELECT COUNT(*) FROM users;";
$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );
$number_of_rows = mysqli_fetch_row( $result )[0];

mysqli_close($GLOBALS["___mysqli_ston"]);
?>

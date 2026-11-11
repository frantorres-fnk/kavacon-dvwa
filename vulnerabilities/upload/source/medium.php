<?php

if( isset( $_POST[ 'Upload' ] ) ) {
	// Check the real image type, re-encode it and store it under a random name
	$target_path = dvwaStoreUploadedImage( $_FILES[ 'uploaded' ] ?? null );

	if( $target_path === false ) {
		// Invalid file
		$html .= '<pre>Your image was not uploaded. We can only accept JPEG or PNG images under 100 kB.</pre>';
	}
	else {
		// Yes!
		$html .= '<pre>' . htmlspecialchars( $target_path ) . ' succesfully uploaded!</pre>';
	}
}

?>

<?php

if (array_key_exists ("redirect", $_GET) && $_GET['redirect'] != "") {
	// Only the module's own quote pages are valid targets; anything else, absolute or relative, is refused.
	if (is_string ($_GET['redirect']) && preg_match ('/^info\.php\?id=([0-9]+)\z/', $_GET['redirect'], $matches)) {
		header ("location: info.php?id=" . intval ($matches[1]));
		exit;
	}
	http_response_code (500);
	?>
	<p>Redirect target not allowed.</p>
	<?php
	exit;
}

http_response_code (500);
?>

<p>Missing redirect target.</p>

<?php
exit;
?>

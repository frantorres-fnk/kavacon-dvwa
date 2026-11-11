<?php

$html = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// 160 random bits from a CSPRNG: not a counter, a timestamp or a hash of either
	$cookie_value = bin2hex(random_bytes(20));
	setcookie("dvwaSession", $cookie_value, array('expires' => time()+3600, 'path' => '/vulnerabilities/weak_id/', 'httponly' => true, 'samesite' => 'Lax'));
}
?>

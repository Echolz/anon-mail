<?php

require 'database.php';

define("SUBJECT", "subject");
define("TO", "to");
define("DELIVERY_TYPE", "deliveryType");
define("CONTENT", "content");

if ($_POST) {

    $subject = $_POST[SUBJECT];
    $to = $_POST[TO];
	
	if (userExists($to)) {
		
		$currentUser = "ikbal";
		$content = $_POST[CONTENT];
		$deliveryType = $_POST[DELIVERY_TYPE];
		
		if ($deliveryType == anonymous) {
			$currentUser = getAnonName($currentUser);
		}

		insertEmail($currentUser, $to, $subject, $content);
	} else {
		// To be implemented
	}
}

header('Location: newEmail.html');

?>
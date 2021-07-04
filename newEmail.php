<?php

require 'database.php';

define("SUBJECT", "subject");
define("TO", "to");
define("DELIVERY_TYPE", "deliveryType");
define("CONTENT", "content");

if ($_POST) {

    $subject = $_POST[SUBJECT];
    $to = $_POST[TO];
    $deliveryType = $_POST[DELIVERY_TYPE];
    $content = $_POST[CONTENT];

    insertEmail("ikbal", $to, $subject, $content);
}

header('Location: newEmail.html');

function getSendEmails() {
	$emails = getEmailsFrom("ikbal");
	
	return $emails;
}

function getEmailById($id) {
	$email = getEmail($id);
	return $email;
}
?>
<?php

require 'database.php';


function getSendEmails($user) {
	$emails = getEmailsFrom($user);
	
	return $emails;
}

function getEmailById($id) {
	$email = getEmail($id);
	return $email;
}
?>
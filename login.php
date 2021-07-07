<?php
session_start();

require 'database.php';
require 'session.php';

define("USERNAME", "username");
define("PASSWORD", "password");

if ($_POST) {
    $username = $_POST[USERNAME];

	if (userExists($username)) {
		
		
		setSessionValue($username);
		
		header('Location: sendEmailsView.php');
		
	} else {
		header('Location: login.html');
	}
}


?>

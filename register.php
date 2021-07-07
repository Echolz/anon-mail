<?php
session_start();

require 'database.php';
require 'session.php';

define("USERNAME", "username");
define("PASSWORD", "password");
define("FN", "fn");
define("NAME", "name");
define("SURNAME", "surname");
define("PHONE", "phone");


if ($_POST) {
    $username = $_POST[USERNAME];

	if (!userExists($username)) {
		
		setSessionValue($username);
		
		$password = $_POST[USERNAME];
		$name = $_POST[NAME];
		$surname = $_POST[SURNAME];
		$fn = $_POST["fn"];
		$randomNumber = rand(100,1000);
		
		insertUser($username, $randomNumber, $password, $fn, $name, $surname);
		
		header('Location: sendEmailsView.php');
		
	} else {
		header('Location: register.html');
	}
}


?>

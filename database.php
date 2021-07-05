<?php

require 'db_configuration.php';

$configs = getConfigurations();
$table_email_user = $configs['table_email_user'];
$table_email = $configs['table_email'];

function insertUser($username, $anonym_username, $password, $fn, $name, $surname) {
    global $table_email_user;

	$errorMessage = "Error inserting new user with username $username!";
    $connection = getDatabaseConnection();
    $query = "INSERT INTO $table_email_user (username, anonym_username, password, fn, name, surname) 
					VALUES (:username, :anonym_username, :password, :fn, :name, :surname)";

    $preparedSql = $connection->prepare($query) or die($errorMessage);
    $preparedSql->bindParam(':username', $username);
    $preparedSql->bindParam(':anonym_username', $anonym_username);
    $preparedSql->bindParam(':password', $password);
    $preparedSql->bindParam(':fn', $fn);
    $preparedSql->bindParam(':name', $name);
    $preparedSql->bindParam(':surname', $surname);

    $preparedSql->execute() or die($errorMessage);

    echo("Successfully inserted new user!");
}

function updateUser($id, $username, $anonym_username, $password, $fn, $name, $surname) {
    global $table_email_user;
	
	$errorMessage = "Error updating user with id $id!";
    $connection = getDatabaseConnection();
    $query = "UPDATE $table_email_user 
				SET
					username = :username,
					anonym_username = :anonym_username,
					password = :password,
					fn = :fn,
					name = :name,
					surname = :surname
				WHERE
					id = :id";
	
    $preparedSql = $connection->prepare($query) or die($errorMessage);
    $preparedSql->bindParam(':productId', $productId);
    $preparedSql->bindParam(':quantity', $quantity);

    $preparedSql->execute() or die($errorMessage);

    echo("Successfully updated user!");
}

// TODO To be implemented
function getUser($username) {

}

function userExists($username) {
    global $table_name;
	
	$errorMessage = "Error checking if user with username $username exists!";
    $connection = getDatabaseConnection();
    $query = "Select * FROM $table_email_user
							WHERE username = :username";

    $preparedSql = $connection->prepare($query) or die($errorMessage);
    $preparedSql->bindParam(':username', $username);

    $preparedSql->execute() or die($errorMessage);
	$row = $preparedSql->fetch(PDO::FETCH_ASSOC);
	
	if (!$row) {
		return false;
	}

    echo("User exists check successful!");
	return true;
}

function insertEmail($from, $to, $subject, $content) {
    global $table_email;

	$errorMessage = "Error inserting new email with subject $subject!";
    $connection = getDatabaseConnection();
    $query = "INSERT INTO $table_email (from_, to_, subject, content) 
					VALUES (:from, :to, :subject, :content)";

    $preparedSql = $connection->prepare($query) or die($errorMessage);
    $preparedSql->bindParam(':from', $from);
    $preparedSql->bindParam(':to', $to);
    $preparedSql->bindParam(':subject', $subject);
    $preparedSql->bindParam(':content', $content);
    $preparedSql->execute() or die($errorMessage);
}

function getEmail($id) {
	global $table_email;
    $connection = getDatabaseConnection();
    $query = "SELECT * FROM $table_email 
							WHERE id = :id";

    $preparedSql = $connection->prepare($query) or die("Error getting email!");
    $preparedSql->bindParam(':id', $id);

    $preparedSql->execute() or die("Error getting email!");
	$row = $preparedSql->fetch(PDO::FETCH_ASSOC);
	
	return $row;	
}

function getSendEmailsFrom($user) {
	global $table_email;

	$anonUsername = getAnonName($user);
	
    $connection = getDatabaseConnection();
    $query = "SELECT * FROM $table_email 
							WHERE from_ IN (:user, :anonUsername)";

    $preparedSql = $connection->prepare($query) or die("Error getting emails!");
    $preparedSql->bindParam(':user', $user);
    $preparedSql->bindParam(':anonUsername', $anonUsername);

    $preparedSql->execute() or die("Error getting emails!");
	$result = $preparedSql->fetchAll(PDO::FETCH_ASSOC);

	return $result;
}

function getAnonEmailsTo($to) {
	global $table_email;
	global $table_email_user;

	$toAnon = getAnonName($to);

    $connection = getDatabaseConnection();
    $query = "SELECT * FROM $table_email 
							WHERE to_ IN (:to, :toAnon)
								AND from_ IN (SELECT anonym_username from $table_email_user)";
								
    $preparedSql = $connection->prepare($query) or die("Error getting emails!");
    $preparedSql->bindParam(':to', $to);
    $preparedSql->bindParam(':toAnon', $toAnon);

    $preparedSql->execute() or die("Error getting emails!");
	$result = $preparedSql->fetchAll(PDO::FETCH_ASSOC);

	return $result;
}

function getAnonName($username) {
	global $table_email_user;

    $connection = getDatabaseConnection();
    $query = "SELECT * FROM $table_email_user 
							WHERE username = :username";

    $preparedSql = $connection->prepare($query) or die("Error getting user anon name!");
    $preparedSql->bindParam(':username', $username);

    $preparedSql->execute() or die("Error getting user anon name!");
	$result = $preparedSql->fetch(PDO::FETCH_ASSOC);

	return $result['anonym_username'];
}

function getEmailsTo($to) {
	global $table_email;
	global $table_email_user;

	$toAnon = getAnonName($to);

    $connection = getDatabaseConnection();
    $query = "SELECT * FROM $table_email 
							WHERE to_ IN (:to, :toAnon)
								AND from_ IN (SELECT username from $table_email_user)";

    $preparedSql = $connection->prepare($query) or die("Error getting emails!");
    $preparedSql->bindParam(':to', $to);
    $preparedSql->bindParam(':toAnon', $toAnon);

    $preparedSql->execute() or die("Error getting emails!");
	$result = $preparedSql->fetchAll(PDO::FETCH_ASSOC);
	
	return $result;	
}

function getDatabaseConnection() {
    global $configs;
    $host = $configs['host'];
    $dbname = $configs['database_name'];
    $username = $configs['username'];
    $password = $configs['password'];

    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password) or die("Error connecting to the database!");
   
    return $connection;
}
?>
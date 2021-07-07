<?php

require 'database.php';
require 'session.php';

define("USERNAME", "username");
define("PASSWORD", "password");

if ($_POST) {

    $username = $_POST[USERNAME];
    $password = $_POST[PASSWORD];

    $sessionID = getSessionID($username, $password);
    setSessionValue("something");
}

header('Location: newEmail.html');


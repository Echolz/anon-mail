<?php

require 'database.php';
require 'session.php';

define("USERNAME", "username");
define("PASSWORD", "password");

if ($_POST) {

    $username = $_POST[USERNAME];
    $password = $_POST[PASSWORD];

    $sessionID = getSessionID($username, $password);
    echo getSessionValue();
    setSessionValue("something");
    echo getSessionValue();
}

header('Location: newEmail.html');


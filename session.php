<?php
function setSessionValue($value){
    $_SESSION["session"]=$value;
}

function getSessionValue() {
    return $_SESSION["session"];
}


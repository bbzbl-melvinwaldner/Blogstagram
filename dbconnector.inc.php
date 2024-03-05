<?php

// Variabeln deklarieren
$host = 'localhost'; // host
$username = 'blogstagram'; // username
$password = 'afiadm20*'; // password
$database = '151_users'; // database



// mit der Datenbank verbinden
$mysqli = new mysqli($host, $username, $password, $database);



// Fehlermeldung, falls Verbindung fehl schlägt.
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
}

?>
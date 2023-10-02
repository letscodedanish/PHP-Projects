<?php

$host = "localhost";
$dbname = "bevx";
$password = "";
$username = "root";

define("DEFAULT_CURRENCY", "£");

$db = new mysqli($host, $username, $password, $dbname);

session_start();

if (!$db) {
    echo "Database not connected";
}

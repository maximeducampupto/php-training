<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "reunion_island";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
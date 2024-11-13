<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "math_quiz";
$port = "3306";

$conn = new mysqli($host, $user, $pass, $db_name, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>

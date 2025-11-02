<?php
$host = "localhost";
$user = "project2_user";
$pass = "password123";
$dbname = "dolphin_crm";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

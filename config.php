<?php
$host = "localhost";
$user = "project2_user";
$pass = "password123";
$dbname = "dolphin_crm";

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

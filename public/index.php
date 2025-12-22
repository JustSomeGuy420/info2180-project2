<?php
session_start();
require_once "../includes/auth.php";

if (is_logged_in()) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dolphin CRM - Login</title>
    <script src="../assets/js/login.js" defer></script>
</head>
<body>

<h2>Login</h2>

<form id="loginForm">
    <input type="email" name="email" placeholder="Email address" required>
    <br><br>
    <input type="password" name="password" placeholder="Password" required>
    <br><br>
    <button type="submit">Login</button>
</form>

<p id="error" style="color:red;"></p>

</body>
</html>

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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
<div class="loginBox">
    <h2>Login</h2>

    <form id="loginForm">
        <div class="container">
            <label for="email"><b>Email</b></label>
            <input type="email" name="email" placeholder="Email address" required>

            <label for="password"><b>Password</b></label>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>
        </div>
    </form>

    <p id="error" style="color:red;"></p>
</div>

</body>
</html>

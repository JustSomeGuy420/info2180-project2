<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<h2>Login</h2>
<form id="loginForm">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

<div id="loginMessage"></div>

<script src="assets/js/app.js"></script>
</body>
</html>

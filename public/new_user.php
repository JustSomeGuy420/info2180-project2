<?php
require_once "../includes/auth.php";
require_login();
require_admin();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <script src="../assets/js/new_user.js" defer></script>
</head>
<body>

<?php include "../includes/sidebar.php" ?>

<h2>Add New User</h2>

<form id="userForm">
    <input type="text" name="firstname" placeholder="First Name" required>
    <br><br>
    <input type="text" name="lastname" placeholder="Last Name" required>
    <br><br>
    <input type="email" name="email" placeholder="Email" required>
    <br><br>
    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <select name="role">
        <option value="Member">Member</option>
        <option value="Admin">Admin</option>
    </select>

    <br><br>
    <button type="submit">Save</button>
</form>

<p id="message"></p>

</body>
</html>

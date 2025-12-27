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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/new_user.css">
</head>
<body>

<?php include "../includes/sidebar.php" ?>

<div class="contentBox">
    <h2>Add New User</h2>
    <form id="userForm">
        <div id="formContainer">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <select name="role">
                <option value="Member">Member</option>
                <option value="Admin">Admin</option>
            </select>
        </div>

        <button type="submit">Save</button>
    </form>


    <p id="message"></p>
</div>

</body>
</html>

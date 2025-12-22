<?php
require_once "../includes/auth.php";
require_login();
require_admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <script src="../assets/js/users.js" defer></script>
</head>
<body>

<?php include '../includes/sidebar.php'; ?>

<h2>Users</h2>

<button id="add">+ Add User</button>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date Created</th>
        </tr>
    </thead>
    <tbody id="usersTable">
        <tr>
            <td colspan="4">Loading...</td>
        </tr>
    </tbody>
</table>

</body>
</html>

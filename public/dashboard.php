<?php
require_once "../includes/auth.php";
require_login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="../assets/js/dashboard.js" defer></script>
</head>
<body>

<?php include '../includes/sidebar.php'; ?>

<h1>Dashboard</h1>

<button id="add">+ Add Contact</button>

<!-- Filters -->
<div>
    <button data-filter="all">All</button>
    <button data-filter="Sales Lead">Sales Leads</button>
    <button data-filter="Support">Support</button>
    <button data-filter="mine">Assigned to me</button>
</div>

<br>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Type</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="contactsTable">
        <tr>
            <td colspan="4">Loading...</td>
        </tr>
    </tbody>
</table>

</body>
</html>

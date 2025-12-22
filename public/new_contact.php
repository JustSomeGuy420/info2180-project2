<?php
require_once "../includes/auth.php";
require_login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact</title>
    <script src="../assets/js/new_contact.js" defer></script>
</head>
<body>

<?php include '../includes/sidebar.php'; ?>

<h2>Add New Contact</h2>

<form id="contactForm">
    <select name="title" required>
        <option value="">Title</option>
        <option>Mr</option>
        <option>Mrs</option>
        <option>Ms</option>
        <option>Dr</option>
    </select><br><br>

    <input type="text" name="firstname" placeholder="First Name" required><br><br>
    <input type="text" name="lastname" placeholder="Last Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="text" name="telephone" placeholder="Telephone"><br><br>
    <input type="text" name="company" placeholder="Company"><br><br>

    <select name="type" required>
        <option value="">Type</option>
        <option>Sales Lead</option>
        <option>Support</option>
    </select><br><br>

    <label>Assigned To</label><br>
    <select name="assigned_to" id="assignedTo" required>
        <option value="">Loading users...</option>
    </select><br><br>

    <button type="submit">Save</button>
</form>

<p id="message"></p>

</body>
</html>

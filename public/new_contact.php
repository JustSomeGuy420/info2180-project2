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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/new_contact.css">
</head>
<body>

<?php include '../includes/sidebar.php'; ?>

<div class="contentBox">
    <h2>Add New Contact</h2>

    <form id="contactForm">
        <div id="formContainer">
            <select name="title" required>
                <option value="">Title</option>
                <option>Mr</option>
                <option>Mrs</option>
                <option>Ms</option>
                <option>Dr</option>
            </select>

            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="telephone" placeholder="Telephone">
            <input type="text" name="company" placeholder="Company">

            <select name="type" required>
                <option value="">Type</option>
                <option>Sales Lead</option>
                <option>Support</option>
            </select>

            <div id="assigned">
                <label>Assigned To</label><br>
                <select name="assigned_to" id="assignedTo" required>
                    <option value="">Loading users...</option>
                </select>
            </div>
        </div>
        

        <button type="submit">Save</button>
    </form>

    <p id="message"></p>
</div>

</body>
</html>

<?php
require_once "../includes/auth.php";
require_login();

$contactId = $_GET['id'] ?? null;
if (!$contactId) {
    die("Invalid contact");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Details</title>
    <script src="../assets/js/contact.js" defer></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
</head>
<body>

<?php include '../includes/sidebar.php'; ?>

<div class="contentBox">
    <div id="head">
        <h2 id="headTag">Contact Details</h2>

        <div>
            <button id="assignBtn" style="display:none;">Assign to me</button>
            <button id="typeBtn" style="display:none;">Switch Type</button>
        </div>
    </div>

    <div id="contactDetails">Loading...</div>

    <hr>

    <h3>Notes</h3>

    <div id="notesList">Loading notes...</div>

    <form id="noteForm">
        <textarea name="comment" placeholder="Add a note..." required></textarea>
        <br><br>
        <button type="submit">Add Note</button>
    </form>
</div>

<script src="../assets/js/notes.js" defer></script>

<script>
    const CONTACT_ID = <?= (int)$contactId ?>;
    const USER_ID = <?= (int)$_SESSION['user_id'] ?>;
</script>

</body>
</html>

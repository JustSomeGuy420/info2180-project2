<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<?php include 'config.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div id="content-area">
    <!-- Page loads here via AJAX -->
</div>

<?php include 'includes/footer.php'; ?>

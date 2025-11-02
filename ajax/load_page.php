<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$page = "../content/" . $_POST['page'];
if (file_exists($page)) {
    include $page;
} else {
    echo "Page not found.";
}
?>
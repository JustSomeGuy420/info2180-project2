<?php
session_start();
require_once '../config.php';

$user_id = $_SESSION['user_id'];
$contact_id = $_POST['contact_id'];
$comment = $_POST['comment'];

$stmt = $conn->prepare("INSERT INTO notes(contact_id, comment, created_by) VALUES (?, ?, ?)");
$stmt->bind_param("isi", $contact_id, $comment, $user_id);
$stmt->execute();

echo "Note added successfully.";

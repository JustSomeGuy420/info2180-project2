<?php
session_start();
require_once '../config.php';

$user_id = $_SESSION['user_id'];
$contact_id = $_POST['contact_id'];

$stmt = $conn->prepare("UPDATE contacts SET assigned_to = ?, updated_at = NOW() WHERE id = ?");
$stmt->bind_param("ii", $user_id, $contact_id);
$stmt->execute();

echo "Assigned";

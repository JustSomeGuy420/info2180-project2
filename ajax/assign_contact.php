<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login();
header("Content-Type: application/json");

$contactId = $_POST['id'] ?? null;
$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    UPDATE contacts
    SET assigned_to = ?
    WHERE id = ?
");
$stmt->execute([$userId, $contactId]);

echo json_encode(["success" => true]);

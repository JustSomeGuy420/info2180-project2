<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login();
header("Content-Type: application/json");

$contactId = $_POST['contact_id'] ?? null;
$comment   = trim($_POST['comment'] ?? '');
$userId    = $_SESSION['user_id'];

if ($comment === '') {
    echo json_encode(["success" => false, "message" => "Note cannot be empty."]);
    exit;
}

$stmt = $pdo->prepare("
    INSERT INTO notes (contact_id, comment, created_by)
    VALUES (?, ?, ?)
");

$stmt->execute([$contactId, $comment, $userId]);

echo json_encode([
    "success" => true,
    "message" => "Note added."
]);

<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login();
header("Content-Type: application/json");

$contactId = $_GET['contact_id'] ?? null;

$stmt = $pdo->prepare("
    SELECT n.comment, n.created_at,
           u.firstname, u.lastname
    FROM notes n
    JOIN users u ON n.created_by = u.id
    WHERE n.contact_id = ?
    ORDER BY n.created_at DESC
");

$stmt->execute([$contactId]);

$notes = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $notes[] = [
        "comment" => htmlspecialchars($row['comment']),
        "author" => htmlspecialchars($row['firstname'] . " " . $row['lastname']),
        "created_at" => $row['created_at']
    ];
}

echo json_encode([
    "success" => true,
    "notes" => $notes
]);

<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login();
header("Content-Type: application/json");

$contactId = $_GET['id'] ?? null;

$stmt = $pdo->prepare("
    SELECT c.*, 
           u1.firstname AS assigned_first, u1.lastname AS assigned_last,
           u2.firstname AS creator_first, u2.lastname AS creator_last
    FROM contacts c
    LEFT JOIN users u1 ON c.assigned_to = u1.id
    JOIN users u2 ON c.created_by = u2.id
    WHERE c.id = ?
");

$stmt->execute([$contactId]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    echo json_encode(["success" => false]);
    exit;
}

echo json_encode([
    "success" => true,
    "contact" => [
        "name" => htmlspecialchars($contact['title'] . " " . $contact['firstname'] . " " . $contact['lastname']),
        "email" => htmlspecialchars($contact['email']),
        "telephone" => htmlspecialchars($contact['telephone']),
        "company" => htmlspecialchars($contact['company']),
        "type" => htmlspecialchars($contact['type']),
        "assigned_to" => $contact['assigned_to'],
        "assigned_name" => $contact['assigned_first']
            ? htmlspecialchars($contact['assigned_first'] . " " . $contact['assigned_last'])
            : "Unassigned",
        "created_by" => htmlspecialchars($contact['creator_first'] . " " . $contact['creator_last']),
        "created_at" => $contact['created_at'],
        "updated_at" => $contact['updated_at']
    ]
]);

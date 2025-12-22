<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login();
require_admin();

header("Content-Type: application/json");

$stmt = $pdo->query("
    SELECT firstname, lastname, email, role, created_at
    FROM users
    ORDER BY created_at DESC
");

$users = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $users[] = [
        "name" => htmlspecialchars($row['firstname'] . " " . $row['lastname']),
        "email" => htmlspecialchars($row['email']),
        "role" => htmlspecialchars($row['role']),
        "created_at" => $row['created_at']
    ];
}

echo json_encode([
    "success" => true,
    "users" => $users
]);

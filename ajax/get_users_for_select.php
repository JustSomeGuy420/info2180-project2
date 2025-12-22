<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login();
header("Content-Type: application/json");

$stmt = $pdo->query("
    SELECT id, firstname, lastname
    FROM users
    ORDER BY firstname, lastname
");

$users = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $users[] = [
        "id" => $row['id'],
        "name" => htmlspecialchars($row['firstname'] . " " . $row['lastname'])
    ];
}

echo json_encode([
    "success" => true,
    "users" => $users
]);

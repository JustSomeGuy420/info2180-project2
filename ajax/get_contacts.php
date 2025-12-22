<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login();

header("Content-Type: application/json");

$filter = $_GET['filter'] ?? 'all';
$userId = $_SESSION['user_id'];

$sql = "
    SELECT c.id, c.firstname, c.lastname, c.email, c.company, c.type
    FROM contacts c
";

$params = [];

if ($filter === "Sales Lead" || $filter === "Support") {
    $sql .= " WHERE c.type = ?";
    $params[] = $filter;
}
elseif ($filter === "mine") {
    $sql .= " WHERE c.assigned_to = ?";
    $params[] = $userId;
}

$sql .= " ORDER BY c.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$contacts = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $contacts[] = [
        "id" => htmlspecialchars($row['id']),
        "name" => htmlspecialchars($row['firstname'] . " " . $row['lastname']),
        "email" => htmlspecialchars($row['email']),
        "company" => htmlspecialchars($row['company']),
        "type" => htmlspecialchars($row['type'])
    ];
}

echo json_encode([
    "success" => true,
    "contacts" => $contacts
]);

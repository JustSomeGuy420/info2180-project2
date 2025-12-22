<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login();
header("Content-Type: application/json");

$contactId = $_POST['id'] ?? null;

$stmt = $pdo->prepare("
    UPDATE contacts
    SET type = IF(type='Sales Lead','Support','Sales Lead')
    WHERE id = ?
");
$stmt->execute([$contactId]);

echo json_encode(["success" => true]);

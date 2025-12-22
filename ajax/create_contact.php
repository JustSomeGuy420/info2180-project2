<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login();
header("Content-Type: application/json");

$title       = $_POST['title'] ?? '';
$firstname   = trim($_POST['firstname'] ?? '');
$lastname    = trim($_POST['lastname'] ?? '');
$email       = trim($_POST['email'] ?? '');
$telephone   = trim($_POST['telephone'] ?? '');
$company     = trim($_POST['company'] ?? '');
$type        = $_POST['type'] ?? '';
$assigned_to = $_POST['assigned_to'] ?? null;
$created_by  = $_SESSION['user_id'];

if (
    $title === '' || $firstname === '' || $lastname === '' ||
    $email === '' || $type === '' || $assigned_to === ''
) {
    echo json_encode(["success" => false, "message" => "All required fields must be filled."]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Invalid email address."]);
    exit;
}

if (!in_array($type, ["Sales Lead", "Support"])) {
    echo json_encode(["success" => false, "message" => "Invalid contact type."]);
    exit;
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO contacts
        (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $title,
        $firstname,
        $lastname,
        $email,
        $telephone,
        $company,
        $type,
        $assigned_to,
        $created_by
    ]);

    echo json_encode([
        "success" => true,
        "message" => "Contact created successfully."
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Email already exists or database error."
    ]);
}

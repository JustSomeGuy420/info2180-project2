<?php
require_once "../includes/db.php";
session_start();

header("Content-Type: application/json");

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    echo json_encode([
        "success" => false,
        "message" => "Email and password are required."
    ]);
    exit;
}

$stmt = $pdo->prepare("
    SELECT id, firstname, lastname, password, role
    FROM users
    WHERE email = ?
");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid email or password."
    ]);
    exit;
}

// Login successful
$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['firstname'] . " " . $user['lastname'];
$_SESSION['role'] = $user['role'];

echo json_encode([
    "success" => true
]);

<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login();
require_admin();

header("Content-Type: application/json");

$firstname = trim($_POST['firstname'] ?? '');
$lastname  = trim($_POST['lastname'] ?? '');
$email     = trim($_POST['email'] ?? '');
$password  = $_POST['password'] ?? '';
$role      = $_POST['role'] ?? 'Member';

if ($firstname === '' || $lastname === '' || $email === '' || $password === '') {
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Invalid email format."]);
    exit;
}

/*
Password rules:
- ≥ 8 chars
- At least 1 uppercase
- At least 1 lowercase
- At least 1 number
*/
if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
    echo json_encode([
        "success" => false,
        "message" => "Password must be at least 8 characters and include upper, lower and number."
    ]);
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("
        INSERT INTO users (firstname, lastname, email, password, role)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$firstname, $lastname, $email, $hash, $role]);

    echo json_encode(["success" => true, "message" => "User created successfully."]);

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Email already exists."]);
}

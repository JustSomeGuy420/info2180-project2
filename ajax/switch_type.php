<?php
session_start();
require_once '../config.php';

$contact_id = $_POST['contact_id'];
$current_type = $_POST['current_type'];

$newType = ($current_type === "sales lead") ? "support" : "sales lead";

$stmt = $conn->prepare("UPDATE contacts SET type = ? WHERE id = ?");
$stmt->bind_param("si", $newType, $contact_id);
$stmt->execute();

echo $newType;

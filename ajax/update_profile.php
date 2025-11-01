<?php
include '../config.php';

$name = $_POST['name'];
$sql = "UPDATE users SET name='$name' WHERE id=1"; // example user

if ($conn->query($sql)) {
    echo "Profile updated!";
} else {
    echo "Error updating.";
}

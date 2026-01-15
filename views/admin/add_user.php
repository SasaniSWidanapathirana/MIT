<?php
require_once '../../config/db.php';
require_once '../../models/user.php';

$db = new Database();
$conn = $db->connect(); // $conn is PDO
$userObj = new User($conn); // create User class instance

$userNIC      = $_POST['userNIC'] ?? '';
$userEmail    = $_POST['userEmail'] ?? '';
$userRole     = $_POST['userRole'] ?? '';
$field        = $_POST['field'] ?? '';
$userPassword = $_POST['userPassword'] ?? '';

if (empty($userNIC) || empty($userEmail) || empty($userRole) || empty($field) || empty($userPassword)) {
    die("All fields are required.");
}

// Convert role and field
$userRole = ($userRole === "admin") ? 1 : 2;
$field    = ($field === "field1") ? 1 : 2;

// Hash password
$hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

// Insert using method inside User class
if ($userObj->insertUser($userNIC, $userEmail, $hashedPassword, $userRole, $field, 1)) {
    header("Location: user_page.php?success=1"); // redirect to the page with table
    exit;
} else {
    header("Location: user_page.php?error=1");
    exit;
}
?>

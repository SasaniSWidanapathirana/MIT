<?php
require_once '../../config/db.php';
require_once '../../models/user.php';

$db = new Database();
$conn = $db->connect(); // $conn is PDO
$userObj = new User($conn); // create User class instance


$userName     = $_POST['userName'] ?? 'abc';
$userNIC      = $_POST['userNIC'] ?? '13456789';
$userEmail    = $_POST['userEmail'] ?? 'abc@gmail.com';
$userRole     = $_POST['userRole'] ?? '1';
$userPassword = $_POST['userPassword'] ?? '1234@';
$userStatus   = $_POST['userStatus'] ?? '1'; // default 1 (Available)

// Validate required fields
if (empty($userName) || empty($userNIC) || empty($userEmail) || empty($userRole) || empty($userPassword) || empty($userStatus)) {
    die("All required fields must be filled.");
}

// Convert role and status to numeric values
$userRole = ($userRole === "admin") ? 1 : 2;
$userStatus = (int)$userStatus;

// Hash password
// $hashedPassword = password_hash($hashedPassword, PASSWORD_DEFAULT);

// Insert using method inside User class
if ($userObj->insertUser($userName, $userNIC, $userEmail, $userPassword, $userRole, $userStatus)) {
    header("Location: members.php?success=1"); // redirect to the page with table
    exit;
} else {
    header("Location: members.php?error=1");
    exit;
}
?>
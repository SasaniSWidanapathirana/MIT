<?php
require_once '../../config/db.php';
require_once '../../models/user.php';

$db = new Database();
$conn = $db->connect(); // $conn is PDO
$userObj = new User($conn); // create User class instance


$userName     = $_POST['userName'] ?? '';
$userNIC      = $_POST['userNIC'] ?? '';
$userEmail    = $_POST['userEmail'] ?? '';
$userRole     = $_POST['userRole'] ?? '';
$userPassword = $_POST['userPassword'] ?? '';
$userStatus   = $_POST['userStatus'] ?? '1'; // default 1 (Available)

// Validate required fields
if (empty($userName) || empty($userNIC) || empty($userEmail) || empty($userRole) || empty($userPassword) || empty($userStatus)) {
    die("All required fields must be filled.");
}

// Convert role and status to numeric values
$userRole = ($userRole === "admin") ? 1 : 2;
$userStatus = (int)$userStatus;

// Hash password
$hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

// Insert using method inside User class
if ($userObj->insertUser($userName, $userNIC, $userEmail, $hashedPassword, $userRole, $userStatus)) {
    header("Location: members.php?success=1"); // redirect to the page with table
    exit;
} else {
    header("Location: members.php?error=1");
    exit;
}
?>

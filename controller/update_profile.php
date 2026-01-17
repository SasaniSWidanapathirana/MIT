<?php
session_start();
require_once '../config/db.php';
require_once '../models/user.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
    exit;
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/common/profile.php");
    exit;
}

$db = (new Database())->connect();
$userObj = new User($db);

$userId = $_SESSION['user_id'];

// Get form data with validation
$name  = isset($_POST['name']) ? trim($_POST['name']) : '';
$nic   = isset($_POST['nic']) ? trim($_POST['nic']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validate required fields
if (empty($name) || empty($nic) || empty($email)) {
    header("Location: ../views/common/profile.php?error=missing_fields");
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../views/common/profile.php?error=invalid_email");
    exit;
}

// Check if email is already taken by another user
if ($userObj->emailExists($email, $userId)) {
    header("Location: ../views/common/profile.php?error=email_exists");
    exit;
}

// Validate password strength if provided
if (!empty($password) && strlen($password) < 6) {
    header("Location: ../views/common/profile.php?error=weak_password");
    exit;
}

// Update profile
// Only pass password if it's not empty (user wants to change it)
if (!empty($password)) {
    $result = $userObj->updateProfile($userId, $name, $nic, $email, $password);
} else {
    $result = $userObj->updateProfile($userId, $name, $nic, $email);
}

// Check if update was successful
if ($result) {
    // Update session data
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    
    header("Location: ../views/common/profile.php?success=1");
} else {
    header("Location: ../views/common/profile.php?error=update_failed");
}
exit;
?>
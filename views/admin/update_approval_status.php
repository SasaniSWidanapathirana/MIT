<?php
// Load DB + Model
require_once '../../config/db.php';
require_once '../../models/user.php';

// Check if POST data exists
if (!isset($_POST['user_id'], $_POST['role'])) {
    echo 'error: missing data';
    exit;
}

$userId = (int) $_POST['user_id'];
$newRole = (int) $_POST['role'];

// Only allow 1 or 11
if (!in_array($newRole, [1, 11])) {
    echo 'error: invalid role';
    exit;
}

// Connect to DB
$database = new Database();
$db = $database->connect();

// Create User object
$userObj = new User($db);

// Call toggleApproval method
$success = $userObj->toggleApproval($userId, $newRole);

echo $success ? 'success' : 'error';
?>